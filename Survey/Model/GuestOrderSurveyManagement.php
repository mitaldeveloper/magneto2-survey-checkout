<?php
namespace Mital\Survey\Model;

use Magento\Quote\Model\QuoteIdMaskFactory;

class GuestOrderSurveyManagement implements \Mital\Survey\Api\GuestOrderSurveyManagementInterface
{

    /**
     * @var QuoteIdMaskFactory
     */
    protected $quoteIdMaskFactory;

    /**
     * @var \Mital\Survey\Api\OrderSurveyManagementInterface
     */
    protected $orderSurveyManagement;
    
    /**
     * GuestOrderSurveyManagement constructor.
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     * @param \Mital\Survey\Api\OrderSurveyManagementInterfacee $orderSurveyManagement
     */
    public function __construct(
        QuoteIdMaskFactory $quoteIdMaskFactory,
        \Mital\Survey\Api\OrderSurveyManagementInterface $orderSurveyManagement
    ) {
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->orderSurveyManagement = $orderSurveyManagement;
    }

    /**
     * {@inheritDoc}
     */
    public function saveOrderSurveyAnswer(
        $cartId,
        \Mital\Survey\Api\Data\OrderSurveyInterface $survey
    ) {
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->orderSurveyManagement->saveOrderSurveyAnswer($quoteIdMask->getQuoteId(), $survey);
    }
}
