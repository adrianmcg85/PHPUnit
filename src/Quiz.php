<?php

namespace App;

use Exception;

class Quiz{
    protected Questions $questions;

    protected $currentQuestion = 1;

    public function __construct()
    {
        $this->questions = new Questions();
    }

    public function addQuestion(Question $question)
    {
        $this->questions->add($question);
        // $this->questions[] = $question;
    }

    public function followingQuestion(){
        return $this->questions->next();
        // if(!isset($this->questions[$this->currentQuestion -1])){
        //     return false;
        // }
        // $question =  $this->questions[$this->currentQuestion - 1];
        // $this->currentQuestion++;
        // return $question;
    }

    public function questions() {
        return $this->questions;
    }

    public function questionsComplete()
    {
        // $answered = count(array_filter($this->questions, fn($question) => $question->answered()));
        // $total = count($this->questions);

        return count($this->questions->answered()) === $this->questions->count();
    }

    public function grade()
    {
        if (!$this->questionsComplete()) {
            throw new Exception("This quiz has not yet been completed.");
        }
        $correct = count($this->questions->solved());

        return ($correct / $this->questions->count()) * 100;
    }

}