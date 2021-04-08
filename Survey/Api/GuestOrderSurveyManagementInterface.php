<?php
namespace Mital\Survey\Api;

/**
 * Interface for saving the checkout survey to the quote for guest orders
 */
interface GuestOrderSurveyManagementInterface
{
    /**
     * @param string $cartId
     * @param \Mital\Survey\Api\Data\OrderSurveyInterface $survey
     * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface
     */
    public function saveOrderSurveyAnswer(
        $cartId,
        \Mital\Survey\Api\Data\OrderSurveyInterface $survey
    );
}
