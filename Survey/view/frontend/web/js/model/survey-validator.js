define(
    [
        'jquery',
        'Magento_Customer/js/model/customer',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/url-builder',
        'mage/url',
        'Magento_Checkout/js/model/error-processor',
        'Magento_Ui/js/model/messageList',
        'mage/translate'
    ],
    function ($, customer, quote, urlBuilder, urlFormatter, errorProcessor, messageContainer, __) {
        'use strict';

        return {

            /**
             * Make an ajax PUT request to store the order comment in the quote.
             *
             * @returns {Boolean}
             */
            validate: function () {
                var isCustomer = customer.isLoggedIn();
                var form = this.getForm();

                var question = window.checkoutConfig.survey_title;
                var answer = form.find('.select.survey-option').val();
                /*if (answer == "") {
                    messageContainer.addErrorMessage({ message: __("Please select option") });
                    return false;
                }*/
                if(answer == "Other"){
                     answer = form.find('.survey-other').val();
                }

                var quoteId = quote.getQuoteId();

                var url;
                if (isCustomer) {
                    url = urlBuilder.createUrl('/carts/mine/set-survey-answer', {})
                } else {
                    url = urlBuilder.createUrl('/guest-carts/:cartId/set-survey-answer', {cartId: quoteId});
                }

                var payload = {
                    cartId: quoteId,
                    survey: {                        
                        answer: answer,
                        question: question
                    }
                };

                /*if (!payload.survey.answer) {
                    return true;
                }*/

                var result = true;                
                $.ajax({
                    url: urlFormatter.build(url),
                    data: JSON.stringify(payload),
                    global: false,
                    contentType: 'application/json',
                    type: 'PUT',
                    async: false
                }).done(
                    function (response) {
                        result = true;
                    }
                ).fail(
                    function (response) {
                        result = false;
                        errorProcessor.process(response);
                    }
                );

                return result;
            },
            getForm: function () {
                var form =  $('form.mital-survey-form');                
                return form;
            },
            
        };
    }
);
