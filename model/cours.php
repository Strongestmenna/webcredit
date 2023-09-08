<?php
class cours
{
    private $id = null;
    private $nom = null;
    private $cour = null;
    private $matiere = null;
    private $ide = null;

    public function __construct($nom, $cour, $matiere, $ide)
    {
        $this->nom = $nom;
        $this->cour = $cour;
        $this->matiere = $matiere;
        $this->ide = $ide;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getmatiere()
    {
        return $this->matiere;
    }

    public function setmatiere($matiere)
    {
        $this->matiere = $matiere;
    }


    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getcour()
    {
        return $this->cour;
    }

    public function setcour($cour)
    {
        $this->cour = $cour;
    }

    public function getIde()
    {
        return $this->ide;
    }

    public function setIde($ide)
    {
        $this->ide = $ide;
    }
}
