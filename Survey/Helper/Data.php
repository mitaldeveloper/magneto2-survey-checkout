<?php 
namespace Mital\Survey\Helper;

use Exception;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\ObjectManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Json\Helper\Data as JsonHelper;

class Data extends AbstractHelper
{   
  
    public function __construct(
        Context $context,
        ObjectManagerInterface $objectManager,
        StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->objectManager = $objectManager;
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;

        parent::__construct($context);
    }

    public function getConfigSurveyOptionsValue()
    {
        return  $this->scopeConfig->getValue('survey/general/survey_option', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getConfigTitleValue()
    {
        return  $this->scopeConfig->getValue('survey/general/survey_text', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function isEnableOtherOption()
    {
        return  $this->scopeConfig->getValue('survey/general/other_option', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Survey will be hided if this function return 'false'
     *
     * @param null $store
     *
     * @return mixed
    */
    public function isEnableSurvey()
    {
        return  $this->scopeConfig->getValue('survey/general/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @param null $stores
     *
     * @return array
     * @throws Zend_Serializer_Exception
     */
    public function getSurveyOptions($stores = null)
    {
        return $this->unserialize($this->getConfigSurveyOptionsValue());
    }   

    /**
     * @param $ver
     * @param string $operator
     *
     * @return mixed
     */
    public function versionCompare($ver, $operator = '>=')
    {
        $productMetadata = $this->objectManager->get(ProductMetadataInterface::class);
        $version = $productMetadata->getVersion(); //will return the magento version

        return version_compare($version, $ver, $operator);
    }

     /**
     * @param $data
     *
     * @return string
     */
    public function serialize($data)
    {
        if ($this->versionCompare('2.2.0')) {
            return self::jsonEncode($data);
        }

        return $this->getSerializeClass()->serialize($data);
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    public function unserialize($string)
    {
        if ($this->versionCompare('2.2.0')) {
            return self::jsonDecode($string);
        }

        return $this->getSerializeClass()->unserialize($string);
    }

    /**
     * @return JsonHelper|mixed
     */
    public static function getJsonHelper()
    {
        return ObjectManager::getInstance()->get(JsonHelper::class);
    }

     /**
     * Decodes the given $encodedValue string which is
     * encoded in the JSON format
     *
     * @param string $encodedValue
     *
     * @return mixed
     */
    public static function jsonDecode($encodedValue)
    {
        try {
            $decodeValue = self::getJsonHelper()->jsonDecode($encodedValue);
        } catch (Exception $e) {
            $decodeValue = [];
        }

        return $decodeValue;
    }

   /**
     * @return mixed
     */
    protected function getSerializeClass()
    {
        return $this->objectManager->get('Zend_Serializer_Adapter_PhpSerialize');
    }
}