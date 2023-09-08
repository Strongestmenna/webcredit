<?php
require_once('C:/xamp/htdocs/web3/config.php');
include 'C:/xamp/htdocs/web3/model/question.php';
include 'C:/xamp/htdocs/web3/controller/userC.php';

class questionC
{

    public function create($question)
    {
        if (isset($_GET['q'])) {
            $q = $_GET['q'];
            if ($q != 0) {
                $sql = "INSERT INTO `question`(`question`, `r1`,`r2`,`r3`,`reponse`,`quizid`) VALUES (:question,:r1,:r2,:r3,:reponse,:quizid )";
                $db = config::getConnexion();
                try {
                    $query = $db->prepare($sql);
                    $query->execute([
                        'question' => $question->getQuestion(),
                        'r1' => $question->getReponse1(),
                        'r2' => $question->getReponse2(),
                        'r3' => $question->getReponse3(),
                        'reponse' => $question->getCorrect(),
                        'quizid' => $question->getQuizId(),
                    ]);
                    $q--;
                    header('Location:addquestion.php?q=' . $q);
                } catch (Exception $e) {
                    echo 'Erreur: ' . $e->getMessage();
                }
            } else if ($q == 0) {
                header('Location:quiz.php');
            }
        }
    }
    public function read($id)
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

    public function getquizid()
    {
        $sql = "SELECT id FROM quiz order by dateaj DESC limit 1";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $id = $liste->fetch();
            return $id;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function getnbrq()
    {
        $sql = "SELECT nbrq FROM quiz order by dateaj DESC limit 1";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $nbrq = $liste->fetch();
            return $nbrq;
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
                $sql = "DELETE FROM `question` WHERE `id` = '$id' ";
                $req = $db->prepare($sql);
                try {
                    $req->execute();
                    header("Location:question.php");
                } catch (Exception $e) {
                    die('Erreur:' . $e->getMessage());
                }
            }
        }
    }

    public function update($question)
    {
        if (isset($_GET['i'])) {
            $q = $_GET['i'];
            $id2 = $_GET['quizid'];
            if ($q != 0) {
                $sql = "UPDATE `question` SET `question`=:question,`r1`=:r1,`r2`=:r2,`r3`=:r3,`reponse`=:reponse,`dateaj`= '0000-00-00 00:00:00' WHERE `id`=:id";
                $db = config::getConnexion();
                try {
                    $query = $db->prepare($sql);
                    $query->execute([
                        'question' => $question->getquestion(),
                        'r1' => $question->getReponse1(),
                        'r2' => $question->getReponse2(),
                        'r3' => $question->getReponse3(),
                        'reponse' => $question->getCorrect(),
                        'id' => $question->getId(),
                    ]);
                    if ($q == 1) {
                        $sql = "UPDATE `question` SET `dateaj`= now() WHERE `quizid`=:id";
                        $db = config::getConnexion();
                        try {
                            $query = $db->prepare($sql);
                            $query->execute(
                                [
                                    'id' => $id2,
                                ]
                            );
                        } catch (Exception $e) {
                            echo 'Erreur: ' . $e->getMessage();
                        }
                    }
                    $q--;
                    header('Location:updatequestion.php?quizid=' . $id2 . '&&i=' . $q . '&&id=' . $question->getId());
                } catch (Exception $e) {
                    echo 'Erreur: ' . $e->getMessage();
                }
            }
        }
    }

    public function findone($id)
    {
        $sql = "SELECT * FROM question WHERE `quizid` = '$id' ORDER BY dateaj desc";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $u = $liste->fetch();
            return $u;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
}
