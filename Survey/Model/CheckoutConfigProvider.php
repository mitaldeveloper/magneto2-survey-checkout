<?php 
namespace Mital\Survey\Model;

use Magento\Checkout\Model\Session as CheckoutSession;
use Mital\Survey\Helper\Data as mitalHelper;

class CheckoutConfigProvider implements \Magento\Checkout\Model\ConfigProviderInterface
{
     public function __construct(        
        CheckoutSession $checkoutSession,
        mitalHelper $helper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
       
    )
    {        
        $this->helper = $helper; 
        $this->checkoutSession = $checkoutSession;
        $this->scopeConfig = $scopeConfig;
    }
   public function getConfig()
   {  
        $answers = [];
        foreach ($this->helper->getSurveyOptions() as $key => $item) {
            $answers[] =  $item['active'];
        }
        
        $output['survey_title'] = $this->helper->getConfigTitleValue();
        $output['survey_option'] = $answers;
        $output['isEnabledSurvey'] = $this->helper->isEnableSurvey();
        $output['isEnabledOtherOption'] = $this->helper->isEnableOtherOption();

        return $output;
   }
}