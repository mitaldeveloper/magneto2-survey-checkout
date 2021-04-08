<?php
namespace Mital\Survey\Observer;

use Mital\Survey\Model\Data\OrderSurvey;

class AddSurveyAnswerToOrder implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * transfer the order survey from the quote object to the order object during the
     * sales_model_service_quote_submit_before event
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /* @var $order \Magento\Sales\Model\Order */
        $order = $observer->getEvent()->getOrder();
        
        /** @var $quote \Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getQuote();

        $order->setData(OrderSurvey::SURVEY_ANSWER_NAME, $quote->getData(OrderSurvey::SURVEY_ANSWER_NAME));
        $order->setData(OrderSurvey::SURVEY_QUESTION_NAME, $quote->getData(OrderSurvey::SURVEY_QUESTION_NAME));
    }
}
