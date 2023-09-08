<?php
require_once('C:/xamp/htdocs/web3/config.php');
include 'C:/xamp/htdocs/web3/model/quiz.php';

class quizC
{
    public function create($quiz)
    {

        $sql = "INSERT INTO `quiz`(`nom`,`nbrq`) VALUES (:nom,:nbrq)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $quiz->getNom(),
                'nbrq' => $quiz->getNbq(),
            ]);
            header('Location:addquestion.php?q=' . $quiz->getNbq());
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function read()
    {
        $sql = "SELECT * FROM quiz";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function readquestion($id)
    {
        $sql = "SELECT * FROM question where quizid = $id";
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
        $sql = "SELECT * FROM quiz order by $r";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function search($r)
    {
        $sql = "SELECT * FROM quiz where id like '%$r%' or nom like '%$r%'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
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
                $sql = "DELETE FROM `quiz` WHERE `id` = '$id' ";
                $req = $db->prepare($sql);
                try {
                    $req->execute();
                    header("Location:quiz.php");
                } catch (Exception $e) {
                    die('Erreur:' . $e->getMessage());
                }
            }
        }
    }

    public function update($quiz, $id)
    {
        $sql = "UPDATE `quiz` SET `nom`=:nom WHERE `id`=:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $quiz->getNom(),
                'id' => $id,
            ]);
            header('Location:updatequestion.php?quizid=' . $id . '&&i=' . $quiz->getNbq());
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function findone($id)
    {
        $sql = "SELECT * FROM quiz WHERE `id` = '$id'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $t = $liste->fetch();
            return $t;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
}
