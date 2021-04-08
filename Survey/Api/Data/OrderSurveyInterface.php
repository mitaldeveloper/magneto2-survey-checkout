<?php
namespace Mital\Survey\Api\Data;

interface OrderSurveyInterface
{
    /**
     * @return string|null
     */
    public function getAnswer();

    /**
     * @param string $answer
     * @return null
     */
    public function setAnswer($answer);
    /**
     * @return string|null
     */
    public function getQuestion();

    /**
     * @param string $question
     * @return null
     */
    public function setQuestion($question);
}
