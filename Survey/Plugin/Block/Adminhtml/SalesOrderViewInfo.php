<?php
namespace Mital\Survey\Plugin\Block\Adminhtml;

use Mital\Survey\Model\Data\OrderSurvey;

class SalesOrderViewInfo
{
    /**
     * @param \Magento\Sales\Block\Adminhtml\Order\View\Info $subject
     * @param string $result
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function afterToHtml(
        \Magento\Sales\Block\Adminhtml\Order\View\Info $subject,
        $result
    ) {
        $commentBlock = $subject->getLayout()->getBlock('mital_survey_details');
        if ($commentBlock !== false && $subject->getNameInLayout() == 'order_info') {
            $commentBlock->setSurveyAnswer($subject->getOrder()->getData(OrderSurvey::SURVEY_ANSWER_NAME));
            $commentBlock->setSurveyQuestion($subject->getOrder()->getData(OrderSurvey::SURVEY_QUESTION_NAME));
            $result = $result . $commentBlock->toHtml();
        }
        
        return $result;
    }
}
