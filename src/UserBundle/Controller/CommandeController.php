<?php


namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Commande;
use UserBundle\Entity\Produit;
use UserBundle\Form\CommandeType;

class CommandeController extends Controller
{
    public function ajoutCommandeAction(Request $request,$id)
    {

        $commande = new commande();
        $produit=$this->getDoctrine()->getRepository(Produit::class)->find($id);
        $product=$this->getDoctrine()->getRepository(Produit::class)->findAll();
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $commande->setUser($currentUser);
        $commande->setProduit($produit);

        $form = $this->createForm(CommandeType::class, $commande);
        $form = $form->handleRequest($request);


        if ($form->isSubmitted()) {
            $prixtotal=$produit->getPrix()*$commande->getQuantite();
            $commande->setPrixtotal($prixtotal);
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();
            return $this->redirectToRoute('panier');
        }
        var_dump($commande->getQuantite());
        return $this->render('@User/Produit/produitchasse.html.twig',array('form' => $form->createView(),"produit"=>$product));
    }


    public function page_commandeAction(Request $request,$id){

        $produit=$this->getDoctrine()->getRepository(Produit::class)->findBy(array('id'=>$id));
        $commande = new commande();
        $product=$this->getDoctrine()->getRepository(Produit::class)->find($id);

        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $commande->setUser($currentUser);
        $commande->setProduit($product);

        $form = $this->createForm(CommandeType::class, $commande);
        $form = $form->handleRequest($request);


        if ($form->isSubmitted()) {

            $prixtotal=$product->getPrix()*$commande->getQuantite();
            $commande->setPrixtotal($prixtotal);
            $commande->setEtat('Non Validé');

            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();
            return $this->redirectToRoute('panier');
        }


        return $this->render('@User/Commande/addcommandechasse.html.twig',array("produit"=>$produit,'form' => $form->createView()));


    }
    public function page_commande2Action(Request $request,$id){

        $produit=$this->getDoctrine()->getRepository(Produit::class)->findBy(array('id'=>$id));
        $commande = new commande();
        $product=$this->getDoctrine()->getRepository(Produit::class)->find($id);

        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $commande->setUser($currentUser);
        $commande->setProduit($product);
        $commande->setEtat('Non Validé');
        $form = $this->createForm(CommandeType::class, $commande);
        $form = $form->handleRequest($request);


        if ($form->isSubmitted()) {

            $prixtotal=$product->getPrix()*$commande->getQuantite();
            $commande->setPrixtotal($prixtotal);
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();
            return $this->redirectToRoute('panier');
        }


        return $this->render('@User/Commande/addcommandepeche.html.twig',array("produit"=>$produit,'form' => $form->createView()));


    }

    public function afficher_panierAction()
{
    $produit=$this->getDoctrine()->getRepository(Commande::class)->findAll();
    $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
    return $this->render('@User/panier/panier.html.twig',array("commandes"=>$produit,"user"=> $currentUser));
}
    public function afficher_commande_backAction()
    {
        $produit=$this->getDoctrine()->getRepository(Commande::class)->findAll();
        return $this->render('@User/Produit/commandeback.html.twig',array("commandes"=>$produit));
    }

    public function supprimercommandeAction($id){
        $em=$this->getDoctrine()->getManager();
        $com=$em->getRepository(Commande::class)->find($id);
        $em->remove($com);
        $em->flush();
        return $this->redirectToRoute( "panier");
    }
    public function ValiderCommandeAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $p= $em->getRepository('UserBundle:Commande')->find($id);
        $p->setetat("Validé");
            $em= $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush(); //commit càd l'execution
            return $this->redirectToRoute('commande_back');


    }

}



