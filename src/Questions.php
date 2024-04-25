<?php

namespace App;

use Countable;


class Questions implements Countable
{
    protected array $questions;

    protected $current = 0;

    public function __construct(Array $questions = [])
    {
        $this->questions = $questions;
        
    }

    public function add(Question $question) 
     {
            $this->questions[] = $question;
    }

    public function next()
    {
        if(! isset($this->questions[$this->current])){
            return false;
        }
        $this->current++;
        return $this->questions[$this->current - 1];
    }
    public function answered()
    {
        return array_filter($this->questions, fn($question) => $question->answered());
    }
    
    public function solved(){
        return array_filter($this->questions, fn($question) => $question->solved());
    }

    public function count(): int
    {
        return count($this->questions);
    }
}