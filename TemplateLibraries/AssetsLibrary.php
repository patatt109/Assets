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
namespace Modules\Assets\TemplateLibraries;

use DirectoryIterator;
use Modules\Assets\Components\AssetsComponent;
use Phact\Helpers\Paths;
use Phact\Main\Phact;
use Phact\Template\Renderer;
use Phact\Template\TemplateLibrary;

class AssetsLibrary extends TemplateLibrary
{
    use Renderer;

    /**
     * @kind accessorFunction
     * @name assets_public_path
     */
    public static function makePublicPath($path)
    {
        return Phact::app()->assets->makePublicPath($path);
    }

    /**
     * @kind accessorFunction
     * @name dependency_js
     */
    public static function dependencyJS($path)
    {
        Phact::app()->assets->addDependencyJS($path);
    }

    /**
     * @kind accessorFunction
     * @name dependency_css
     */
    public static function dependencyCSS($path)
    {
        Phact::app()->assets->addDependencyCSS($path);
    }

    /**
     * @kind blockFunction
     * @name inline_js
     */
    public static function inlineJS($params, $content)
    {
        /** @var AssetsComponent $assets */
        $assets = Phact::app()->assets;
        $assets->addInlineJS($content);
        return '';
    }

    /**
     * @kind blockFunction
     * @name inline_css
     */
    public static function inlineCSS($params, $content)
    {
        /** @var AssetsComponent $assets */
        $assets = Phact::app()->assets;
        $assets->addInlineCSS($content);
        return '';
    }

    /**
     * @kind function
     * @name render_dependencies_js
     */
    public static function renderDependenciesJS($params)
    {
        $template = isset($params['template']) ? $params['template'] : 'assets/dependencies_js.tpl';
        /** @var AssetsComponent $assets */
        $assets = Phact::app()->assets;
        return self::renderTemplate($template, [
            'dependencies' => $assets->getDependenciesJS()
        ]);
    }

    /**
     * @kind function
     * @name render_inline_js
     */
    public static function renderInlineJS($params)
    {
        $template = isset($params['template']) ? $params['template'] : 'assets/inline_js.tpl';
        /** @var AssetsComponent $assets */
        $assets = Phact::app()->assets;
        return self::renderTemplate($template, [
            'inline' => $assets->getInlineJS()
        ]);
    }


    /**
     * @kind function
     * @name render_dependencies_css
     */
    public static function renderDependenciesCSS($params)
    {
        $template = isset($params['template']) ? $params['template'] : 'assets/dependencies_css.tpl';
        /** @var AssetsComponent $assets */
        $assets = Phact::app()->assets;
        return self::renderTemplate($template, [
            'dependencies' => $assets->getDependenciesCSS()
        ]);
    }

    /**
     * @kind function
     * @name render_inline_css
     */
    public static function renderInlineCSS($params)
    {
        $template = isset($params['template']) ? $params['template'] : 'assets/inline_css.tpl';
        /** @var AssetsComponent $assets */
        $assets = Phact::app()->assets;
        return self::renderTemplate($template, [
            'inline' => $assets->getInlineCSS()
        ]);
    }

    /**
     * @kind accessorFunction
     * @name frontend_css_filename
     * @return string|null
     */
    public static function getFrontendCssFile($name)
    {
        return self::getStaticFile('static.frontend.dist.css', $name);
    }

    /**
     * @kind accessorFunction
     * @name frontend_js_filename
     * @return string|null
     */
    public static function getFrontendJsFile($name)
    {
        return self::getStaticFile('static.frontend.dist.js', $name);
    }

    /**
     * @kind accessorFunction
     * @name backend_css_filename
     * @return string|null
     */
    public static function getBackendCssFile($name)
    {
        return self::getStaticFile('static.backend.dist.css', $name);
    }

    /**
     * @kind accessorFunction
     * @name backend_js_filename
     * @return string|null
     */
    public static function getBackendJsFile($name)
    {
        return self::getStaticFile('static.backend.dist.js', $name);
    }

    /**
     * @kind accessorFunction
     * @name assets_filename
     * @return string|null
     */
    public static function getStaticFile($path, $name)
    {
        return self::getFileName(Paths::get($path), $name);
    }

    /**
     * @kind accessorFunction
     * @name assets_filename_internal
     * @return string|null
     */
    public static function getFileName($dir, $name)
    {
        $dir = new DirectoryIterator($dir);
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $filename = $fileinfo->getFilename();
                $cleanName = mb_substr($filename, 0, mb_strrpos($filename, '-', null, 'UTF-8'), 'UTF-8');
                $rawName = mb_substr($filename, 0, mb_strrpos($filename, '.', null, 'UTF-8'), 'UTF-8');
                if ($cleanName == $name || $rawName == $name) {
                    return $fileinfo->getFilename();
                }
            }
        }
        return null;
    }
}