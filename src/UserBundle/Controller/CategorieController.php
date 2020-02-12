<?php


namespace UserBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\Categorie;
use UserBundle\Form\CategorieType;


class CategorieController extends Controller
{
    public function afficher_categorieAction(){
        $categorie=$this->getDoctrine()->getRepository(categorie::class)->findAll();
        return $this->render('@User/Categorie/affichercategorie.html.twig',array("categorie"=>$categorie));


    }

    public function ajoutCategorieAction(Request $request)
    {
        $categorie = new categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('afficher_categorie');

        }
        return $this->render('@User/Categorie/addcategorie.html.twig', array('form' => $form->createView()));
    }

    public function supprimercategorieAction($id){
        $em=$this->getDoctrine()->getManager();
        $categorie=$em->getRepository(categorie::class)->find($id);
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute( "afficher_categorie");
    }


    public function modifiercategorieAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $p= $em->getRepository('UserBundle:Categorie')->find($id);
        $form=$this->createForm(CategorieType::class,$p);
        $form->handleRequest($request);
        if($form->isSubmitted()){

            $em= $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush(); //commit càd l'execution
            return $this->redirectToRoute('afficher_categorie');
        }
        return $this->render('@User/Categorie/modifiercategorie.html.twig', array(
            "form"=> $form->createView()
        ));
    }

}