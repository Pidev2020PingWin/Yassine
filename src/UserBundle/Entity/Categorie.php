<?php


namespace UserBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */


class Categorie
{
    /**
     *@ORM\Column(type ="integer")
     *@ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type ="string", length=255)
     */
    private $nom;
    /**
     * @ORM\Column(type ="string", length=255)
     */
    private $description ;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    /**
     * @return mixed
     */
    public function getIdCat()
    {
        return $this->id_cat;
    }

    /**
     * @param mixed $id_cat
     */
    public function setIdCat($id_cat)
    {
        $this->id_cat = $id_cat;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }


}