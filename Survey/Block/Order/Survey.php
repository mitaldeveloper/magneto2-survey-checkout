<?php

namespace Mital\Survey\Block\Order;

use Mital\Survey\Model\Data\OrderSurvey;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context as TemplateContext;
use Magento\Sales\Model\Order;

class Survey extends \Magento\Framework\View\Element\Template
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;

    public function __construct(
        TemplateContext $context,
        Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->_isScopePrivate = true;
        $this->_template = 'order/view/survey.phtml';
        parent::__construct($context, $data);
    }

    public function getOrder() : Order
    {
        return $this->coreRegistry->registry('current_order');
    }

    public function getSurveyAnswer(): string
    {
        return trim($this->getOrder()->getData(OrderSurvey::SURVEY_ANSWER_NAME));
    }

     public function getSurveyQuestion(): string
    {
        return trim($this->getOrder()->getData(OrderSurvey::SURVEY_QUESTION_NAME));
    }

}
