<?php
/**
 * Copyright © author: Yan Rodrigues Rocha All rights reserved.
 */
declare(strict_types=1);

namespace Hibrido\ChangeButtonColor\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;

class Color extends Field
{

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $html = $element->getElementHtml();
        $value = $element->getData('value');

        $html .= '<script type="text/javascript">
            require(["jquery","jquery/colorpicker/js/colorpicker"], function ($) {
                $(document).ready(function () {
                    var $el = $("#' . $element->getHtmlId() . '");
                    $el.css("backgroundColor", "' . $value . '");

                    // Attach the color picker
                    $el.ColorPicker({
                        color: "' . $value . '",
                        onChange: function (hsb, hex, rgb) {
                            $el.css("backgroundColor", "#" + hex).val(hex);
                        }
                    });
                });
            });
            </script>';
        return $html;
    }

}
