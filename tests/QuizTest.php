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
public function test_it_correctly_tracks_the_next_question_in_the_queue(){
    $quiz = new Quiz;

    // When
    $quiz->addQuestion($question1 = new Question('2 + 1', 3));
    $quiz->addQuestion($question2 = new Question('2 + 2', 4));


    $this->assertEquals($question1, $quiz->followingQuestion());
    $this->assertEquals($question2, $quiz->followingQuestion());

}
public function test_it_returns_false_if_no_questions_remain(){
        $quiz = new Quiz;
    
        // When
        $quiz->addQuestion($question1 = new Question('2 + 1', 3));
        
        $quiz->followingQuestion();
        $this->assertFalse($quiz->followingQuestion());
    
}

public function test_it_cannot_be_graded_until_all_questions_have_been_answered()
{
    $quiz = new Quiz;

    // When
    $quiz->addQuestion(
        new Question('2 + 1', 3)
    );

    $this->expectException(\Exception::class);

    $quiz->grade();
}
}