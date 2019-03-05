<?php

class CC_Widgetcontacts_Block_Adminhtml_Widgetcontacts_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('cmsBlockGrid');
        $this->setDefaultSort('block_identifier');
        $this->setDefaultDir('ASC');
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection(): Mage_Adminhtml_Block_Widget_Grid
    {
        $collection = Mage::getModel('widgetcontacts/block')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Block_Collection */
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     * @throws Exception
     */
    protected function _prepareColumns(): Mage_Adminhtml_Block_Widget_Grid
    {

        $this->addColumn('name', array(
            'header'    => Mage::helper('widgetcontacts')->__('Company Name'),
            'align'     => 'left',
            'index'     => 'name',
        ));

        $this->addColumn('country', array(
            'header'    => Mage::helper('widgetcontacts')->__('Country'),
            'align'     => 'left',
            'index'     => 'country',
        ));

        $this->addColumn('city', array(
            'header'    => Mage::helper('widgetcontacts')->__('City'),
            'align'     => 'left',
            'index'     => 'city',
        ));

        $this->addColumn('street', array(
            'header'    => Mage::helper('widgetcontacts')->__('Street'),
            'align'     => 'left',
            'index'     => 'street',
        ));

        $this->addColumn('build', array(
            'header'    => Mage::helper('widgetcontacts')->__('Build'),
            'align'     => 'left',
            'index'     => 'build',
        ));

        $this->addColumn('phone', array(
            'header'    => Mage::helper('widgetcontacts')->__('Company Phone Number'),
            'align'     => 'left',
            'index'     => 'phone',
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('widgetcontacts')->__('Created At'),
            'index'     => 'created_at',
            'type'      => 'date',

        ));

        return parent::_prepareColumns();
    }

    /**
     * @return $this|Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareMassaction(): Mage_Adminhtml_Block_Widget_Grid
    {
        $this->setMassactionIdField('contact_id');
        $this->getMassactionBlock()->setIdFieldName('contact_id');
        $this->getMassactionBlock()
            ->addItem('delete',
                array(
                    'label' => Mage::helper('widgetcontacts')->__('Delete'),
                    'url' => $this->getUrl('*/*/massDelete'),
                    'confirm' => Mage::helper('widgetcontacts')->__('Are you sure?')
                )
            );

        return $this;
    }

    /**
     * Row click url
     *
     * @return string
     */
    public function getRowUrl($row): string
    {
        return $this->getUrl('*/*/edit', array('contact_id' => $row->getId()));
    }
}
