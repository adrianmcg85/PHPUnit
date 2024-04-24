<?php

namespace App;

class Quiz{
    protected array $questions;

    protected $currentQuestion = 1;

    public function addQuestion(Question $question)
    {
        $this->questions[] = $question;
    }

    public function followingQuestion(){
        if(!isset($this->questions[$this->currentQuestion -1])){
            return false;
        }
        $question =  $this->questions[$this->currentQuestion - 1];
        $this->currentQuestion++;
        return $question;
    }

    public function questions() {
        return $this->questions;
    }

    public function questionsComplete()
    {
        $answered = count(array_filter($this->questions, fn($question) => $question->answered()));
        $total = count($this->questions);

        return $answered === $total;
    }

    public function grade()
    {
        if (!$this->questionsComplete()) {
            throw new \Exception("This quiz has not yet been completed.");
        }
        $correct = count($this->correctQuestions());

        return ($correct / count($this->questions)) * 100;
    }

    protected function correctQuestions()
    {
        return array_filter($this->questions, fn($question) => $question->solved());
    }
}