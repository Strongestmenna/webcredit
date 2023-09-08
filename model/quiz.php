<?php
class quiz
{
    private $id = null;
    private $nom = null;
    private $nbq = null;

    public function __construct($nom, $nbq)
    {
        $this->nom = $nom;
        $this->nbq = $nbq;
    }

    // Getter methods
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getNbq()
    {
        return $this->nbq;
    }

    // Setter methods
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setNbq($nbq)
    {
        $this->nbq = $nbq;
    }
}
