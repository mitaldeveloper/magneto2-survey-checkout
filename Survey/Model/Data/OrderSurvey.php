<?php
namespace Mital\Survey\Model\Data;

use Mital\Survey\Api\Data\OrderSurveyInterface;
use Magento\Framework\Api\AbstractSimpleObject;

class OrderSurvey extends AbstractSimpleObject implements OrderSurveyInterface
{
    const SURVEY_ANSWER_NAME = 'survey_answer';
    const SURVEY_QUESTION_NAME = 'survey_question';
    
    /**
     * @return string|null
     */
    public function getAnswer()
    {
        return $this->_get(static::SURVEY_ANSWER_NAME);
    }

    /**
     * @param string $answer
     * @return $this
     */
    public function setAnswer($answer)
    {
        return $this->setData(static::SURVEY_ANSWER_NAME, $answer);
    }
    /**
     * @return string|null
     */
    public function getQuestion()
    {
        return $this->_get(static::SURVEY_QUESTION_NAME);
    }

    /**
     * @param string $question
     * @return $this
     */
    public function setQuestion($question)
    {
        return $this->setData(static::SURVEY_QUESTION_NAME, $question);
    }
}
