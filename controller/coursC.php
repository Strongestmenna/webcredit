<?php
require_once('C:/xamp/htdocs/web3/config.php');
include 'C:/xamp/htdocs/web3/model/cours.php';
include 'C:/xamp/htdocs/web3/controller/userC.php';

class coursC
{

    public function create($cours)
    {

        $sql = "INSERT INTO `cours`(`nom`, `cour`,`matiere`, `ide`) VALUES (:nom,:cour,:matiere ,:ide )";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $cours->getNom(),
                'cour' => $cours->getcour(),
                'matiere' => $cours->getmatiere(),
                'ide' => $cours->getIde(),
            ]);
            header('Location:cours.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function read()
    {
        $sql = "SELECT * FROM cours";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function deletef()
    {
        if (isset($_GET['del'])) {
            $db = config::getConnexion();
            if (isset($_GET['del'])) {
                $id = $_GET['del'];
                $sql = "DELETE FROM `fav` WHERE `id` = '$id' ";
                $req = $db->prepare($sql);
                try {
                    $req->execute();
                    header("Location:favories.php");
                } catch (Exception $e) {
                    die('Erreur:' . $e->getMessage());
                }
            }
        }
    }

    public function readf($id)
    {
        $sql = "SELECT * FROM fav WHERE `idu` = '$id'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function createfav($u, $c)
    {

        $sql = "INSERT INTO `fav`(`idu`, `idc`) VALUES (:a,:b)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'a' => $u,
                'b' => $c,
            ]);
            header('Location:favories.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function search($r)
    {
        $sql = "SELECT * FROM cours where id like '%$r%' or nom like '%$r%'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function sort($r)
    {
        $sql = "SELECT * FROM cours order by $r";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function findone($id)
    {
        $sql = "SELECT * FROM cours WHERE `id` = '$id'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $f = $liste->fetch();
            return $f;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function delete()
    {
        if (isset($_GET['delete'])) {
            $db = config::getConnexion();
            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $sql = "DELETE FROM `cours` WHERE `id` = '$id' ";
                $req = $db->prepare($sql);
                try {
                    $req->execute();
                    header("Location:cours.php");
                } catch (Exception $e) {
                    die('Erreur:' . $e->getMessage());
                }
            }
        }
    }

    public function update($cours, $id)
    {
        $sql = "UPDATE `cours` SET `nom`=:nom,`cour`=:cour,`matiere`=:matiere WHERE `id`=:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $cours->getNom(),
                'cour' => $cours->getcour(),
                'matiere' => $cours->getmatiere(),
                'id' => $id,
            ]);
            header('Location:cours.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
}
