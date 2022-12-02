<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Testimonial\Block\Adminhtml\Testimonial\Edit;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Store\Model\System\Store;
use Tigren\Testimonial\Model\Testimonial;

/**
 * Class Form
 * @package Tigren\Testimonial\Block\Adminhtml\Testimonial\Edit
 */
class Form extends Generic
{
    /**
     * @var Store
     */
    protected $_systemStore;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Store $systemStore
     * @param array $data
     */
    public function __construct(
        Context     $context,
        Registry    $registry,
        FormFactory $formFactory,
        Store       $systemStore,
        array       $data = []
    )
    {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('testimonial_form');
        $this->setTitle(__('Testimonial Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     * @throws LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var Testimonial $model */
        $model = $this->_coreRegistry->registry('testimonial_testimonial');

        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('testimonial_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Form Testimonial'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        }

        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'label' => __('Name'), 'title' => __('Name'), 'required' => true]
        );

        $fieldset->addField(
            'email',
            'text',
            ['name' => 'email', 'label' => __('Email'), 'title' => __('Email'), 'required' => true]
        );

        $fieldset->addField(
            'message',
            'text',
            ['name' => 'message', 'label' => __('Message'), 'title' => __('Message'), 'required' => true]
        );

        $fieldset->addField(
            'company',
            'text',
            ['name' => 'company', 'label' => __('Company'), 'title' => __('Company'), 'required' => true]
        );

        $fieldset->addField(
            'rating',
            'text',
            ['name' => 'rating', 'label' => __('Rating'), 'title' => __('Rating'), 'required' => true]
        );

        $fieldset->addField(
            'status',
            'text',
            ['name' => 'status', 'label' => __('Status'), 'title' => __('Status'), 'required' => true]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
