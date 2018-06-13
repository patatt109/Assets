<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @date 12/06/18 15:13
 */
namespace Modules\Assets;

use Modules\Assets\Components\AssetsComponent;
use Phact\Main\Phact;
use Phact\Module\Module;
use Modules\Admin\Traits\AdminTrait;

class AssetsModule extends Module
{
    use AdminTrait;

    public static function onApplicationRun()
    {
        $template = Phact::app()->template;
        $renderer = $template->getRenderer();
        /** @var AssetsComponent $assets */
        $assets = Phact::app()->assets;

//        $renderer->addBlockFunction("inline_js", function ($params, $content) use ($assets) {
//            $assets->addInlineJS($content);
//            return '';
//        });
//
//        $renderer->addBlockFunction("inline_css", function ($params, $content) use ($assets) {
//            $assets->addInlineJS($content);
//            return '';
//        });
    }
}
