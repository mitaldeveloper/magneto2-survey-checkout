<?php
namespace Mital\Survey\Block\System\Config\Form\Field;
class Active extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray {
    /**
     * Grid columns
     *
     * @var array
     */
    protected $_columns = [];   
    /**
     * Enable the "Add after" button or not
     *
     * @var bool
     */
    protected $_addAfter = true;
     /**
     * Label of add button
     *
     * @var string
     */
    protected $_addButtonLabel;
    /**
     * Check if columns are defined, set template
     *
     * @return void
     */
    protected function _construct() {
        parent::_construct();
        $this->_addButtonLabel = __('Add');
    }
  
    /**
     * Prepare to render
     *
     * @return void
     */
    protected function _prepareToRender() {       
        $this->addColumn('active', array('label' => __('Label')));
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    } 
    /**
     * Render array cell for prototypeJS template
     *
     * @param string $columnName
     * @return string
     * @throws \Exception
     */
    public function renderCellTemplate($columnName)
    {
        if ($columnName == "active") {
            $this->_columns[$columnName]['class'] = 'input-text required-entry';
            $this->_columns[$columnName]['style'] = 'width:300px';
        }
        return parent::renderCellTemplate($columnName);
    }
}
 
 