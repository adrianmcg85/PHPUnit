<?php

use App\Quiz;
use App\Question;
use PHPUnit\Framework\TestCase;

class QuizTest extends TestCase
{
    protected Quiz $quiz;
    public function setup(): void
    {
        $this->quiz = new Quiz();
    }
    public function test_quiz_has_questions()
    {

        // When
        $this->quiz->addQuestion(
            new Question('2 + 2', 4)
        );

        //Then
        $this->assertCount(1, $this->quiz->questions());
    }

    public function test_it_should_be_graded_as_perfect(){
                
                $this->quiz->addQuestion(
                    new Question('2 + 1', 3)
                );

                $question = $this->quiz->followingQuestion();

                $question->answer(3);
        
                //Then
                $this->assertEquals(100, $this->quiz->grade());
    }

    public function test_it_should_be_graded_as_failed(){

        $this->quiz->addQuestion(
            new Question('2 + 1', 3)
        );

        $question = $this->quiz->followingQuestion();

        $question->answer(0);

        //Then
        $this->assertEquals(0, $this->quiz->grade());
}
public function test_it_correctly_tracks_the_next_question_in_the_queue(){
    

    // When
    $this->quiz->addQuestion($question1 = new Question('2 + 1', 3));
    $this->quiz->addQuestion($question2 = new Question('2 + 2', 4));


    $this->assertEquals($question1, $this->quiz->followingQuestion());
    $this->assertEquals($question2, $this->quiz->followingQuestion());

}
public function test_it_returns_false_if_no_questions_remain(){
        
    
        // When
        $this->quiz->addQuestion($question1 = new Question('2 + 1', 3));
        
        $this->quiz->followingQuestion();
        $this->assertFalse($this->quiz->followingQuestion());
    
}

public function test_it_cannot_be_graded_until_all_questions_have_been_answered()
{
    

    // When
    $this->quiz->addQuestion(
        new Question('2 + 1', 3)
    );

    $this->expectException(\Exception::class);

    $this->quiz->grade();
}

public function test_it_knows_quiz_is_complete()
{
    

    $this->quiz->addQuestion(
        new Question('4 +4', 8)
    );

    $this->assertFalse($this->quiz->questionsComplete());

    $this->quiz->followingQuestion()->answer(8);

    $this->assertTrue($this->quiz->questionsComplete());
}
}