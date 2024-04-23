<?php

namespace App;

class Question{
    protected $anser;
    protected $correct;
    public function __construct(protected $question, protected $solution)
    {
        $this->question = $question;
        $this->answer = $solution;
        
    }

    public function answer($answer)
    {
        $this->answer = $answer;
        return $this->correct = $answer === $this->solution;
    }

    public function correctAnswer()
    {
        return $this->correct;

    }

}