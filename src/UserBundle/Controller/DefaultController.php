<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
{

    $user = null;
    if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
        return $this->redirectToRoute('back');
    }
    return $this->render('@User/Default/index.html.twig');
}

    public function backAction()
    {
        return $this->render('@User/Default/back.html.twig');
    }
}
