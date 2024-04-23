<?php

use App\Quiz;
use App\Question;
use PHPUnit\Framework\TestCase;

class QuizTest extends TestCase
{
    public function test_quiz_has_questions()
    {
        //Given
        $quiz = new Quiz;

        // When
        $quiz->addQuestion(
            new Question('2 + 2', 4)
        );

        //Then
        $this->assertCount(1, $quiz->questions());
    }

    public function test_it_should_be_graded_as_perfect(){
                //Given
                $quiz = new Quiz;

                // When
                $quiz->addQuestion(
                    new Question('2 + 1', 3)
                );

                $question = $quiz->followingQuestion();

                $question->answer(3);
        
                //Then
                $this->assertEquals(100, $quiz->grade());
    }

    public function test_it_should_be_graded_as_failed(){
        //Given
        $quiz = new Quiz;

        // When
        $quiz->addQuestion(
            new Question('2 + 1', 3)
        );

        $question = $quiz->followingQuestion();

        $question->answer(0);

        //Then
        $this->assertEquals(0, $quiz->grade());
}
}