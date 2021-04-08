<?php
namespace Mital\Survey\Model;

use Mital\Survey\Model\Data\OrderSurvey;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\ValidatorException;

class OrderSurveyManagement implements \Mital\Survey\Api\OrderSurveyManagementInterface
{
    /**
     * Quote repository.
     *
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     *
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository Quote repository.
     */
    public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param int $cartId
     * @param \Mital\Survey\Model\Data\OrderSurveyInterface $survey
     * @return null|string
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function saveOrderSurveyAnswer(
        $cartId,
        \Mital\Survey\Api\Data\OrderSurveyInterface $survey
    ) {
        $quote = $this->quoteRepository->getActive($cartId);
        if (!$quote->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products', $cartId));
        }
        $answer   = $survey->getAnswer();
        $question = $survey->getQuestion();

        $this->validateSurvey($answer);

        try {
            $quote->setData(OrderSurvey::SURVEY_ANSWER_NAME, strip_tags($answer));
            $quote->setData(OrderSurvey::SURVEY_QUESTION_NAME, strip_tags($question));
            $this->quoteRepository->save($quote);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('The survey answer could not be saved'));
        }

        return $answer;
    }

    /**
     * @param string $answer
     * @throws ValidatorException
     */
    protected function validateSurvey($answer)
    {        
        if ($answer == '') {
            throw new ValidatorException(__('Please selcet answer'));
        }
    }
}
