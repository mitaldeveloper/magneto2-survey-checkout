define(
    [
       'jquery',
       'ko',
       'underscore',
       'uiComponent',       
       'Mital_Survey/js/model/survey-information',       
       'Magento_Checkout/js/model/payment/additional-validators',
       'Mital_Survey/js/model/survey-validator',
       'jquery/ui'
            
    ],
    function ($, ko, _, Component, surveyInfromation, additionalValidators, surveyValidator) {
        "use strict";       
        additionalValidators.registerValidator(surveyValidator); 
        var myCustomData = window.checkoutConfig.survey_option;
        var isCustomSave = true; 
        return Component.extend({
            defaults: {
                template: 'Mital_Survey/survey'
            },                           
            surveyOptions: surveyInfromation().surveyOptions,            
            survey: 'mital-surveys',

               initialize: function () {
                this._super();
                var self = this;                                  
                  $.each( myCustomData, function( key, value ) {        
                   self.surveyOptions.push(value);                             
                });                             

                if(window.checkoutConfig.isEnabledOtherOption == 1){
                 var otherOption = 'Other';
                 self.surveyOptions.push(otherOption);
                }
                
                return this;
            },
            getSurveyTitle: function () {                
                return window.checkoutConfig.survey_title;
            },
            showOther: function (element) {
              var selectValue = $('.select.survey-option').val();
                 if(selectValue == 'Other'){
                    $('.survey-other-area').show();
                  }else{
                    $('.survey-other-area').hide();
                  }
             }            
         });
    }
);

