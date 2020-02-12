<?php


namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\Categorie;
use UserBundle\Entity\Produit;
use UserBundle\Form\CategorieType;


class UserController extends Controller
{
    public function indexAction()
    {
        $user = null;
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('back');
        } else {
            return $this->render('@User/Default/index.html.twig');
        }
    }

    public function backAction()
    {
        return $this->render('@User/Default/indexback.html.twig');
    }
}

