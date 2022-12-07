<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Testimonial\Block\Adminhtml\Testimonial;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Phrase;
use Magento\Framework\Registry;

class Edit extends Container
{
    /**
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context  $context,
        Registry $registry,
        array    $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'entity_id';
        $this->_blockGroup = 'Tigren_Testimonial';
        $this->_controller = 'adminhtml_testimonial';
        parent::_construct();
        if ($this->_isAllowedAction('Tigren_Testimonial::testimonial_save')) {
            $this->buttonList->update('save', 'label', __('Save Testimonial'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }
    }

    /**
     * @return Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('testimonial_testimonial')->getId()) {
            return __('Edit Testimonial:' . $this->escapeHtml($this->_coreRegistry->registry('testimonial_testimonial')->getName()));
        } else {
            return __('New Testimonial');
        }
    }

    /**
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('testimonial/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}
