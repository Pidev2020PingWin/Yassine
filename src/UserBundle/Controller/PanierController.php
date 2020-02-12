<?php


namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PanierController extends Controller
{
    public function AfficherPanierAction()
    {
        return $this->render('@User/Panier/panier.html.twig' );
    }
}
