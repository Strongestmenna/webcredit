<?php
class question
{
    private $id = null;
    private $quizid = null;
    private $question = null;
    private $reponse1 = null;
    private $reponse2 = null;
    private $reponse3 = null;
    private $correct = null;



    public function __construct($quizid, $question, $reponse1, $reponse2, $reponse3, $correct)
    {
        $this->quizid = $quizid;
        $this->question = $question;
        $this->reponse1 = $reponse1;
        $this->reponse2 = $reponse2;
        $this->reponse3 = $reponse3;
        $this->correct = $correct;
    }

    // Getter methods
    public function getId()
    {
        return $this->id;
    }

    public function getQuizId()
    {
        return $this->quizid;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function getReponse1()
    {
        return $this->reponse1;
    }

    public function getReponse2()
    {
        return $this->reponse2;
    }

    public function getReponse3()
    {
        return $this->reponse3;
    }

    public function getCorrect()
    {
        return $this->correct;
    }

    // Setter methods
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setQuizId($quizid)
    {
        $this->quizid = $quizid;
    }

    public function setQuestion($question)
    {
        $this->question = $question;
    }

    public function setReponse1($reponse1)
    {
        $this->reponse1 = $reponse1;
    }

    public function setReponse2($reponse2)
    {
        $this->reponse2 = $reponse2;
    }

    public function setReponse3($reponse3)
    {
        $this->reponse3 = $reponse3;
    }

    public function setCorrect($correct)
    {
        $this->correct = $correct;
    }
}
