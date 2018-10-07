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

use Modules\Assets\Components\AssetsComponentInterface;
use Phact\Di\ComponentFetcher;
use Phact\Template\RendererInterface;
use Phact\Template\TemplateLibrary;

class AssetsLibrary extends TemplateLibrary
{
    use ComponentFetcher;

    /**
     * @kind accessorFunction
     * @name assets_public_path
     */
    public static function makePublicPath($path, $build = null)
    {
        /** @var AssetsComponentInterface $assetsManager */
        if ($assetsManager = self::fetchComponent(AssetsComponentInterface::class)) {
            return $assetsManager->makePublicPath($path, $build);
        }
    }

    /**
     * @kind accessorFunction
     * @name dependency_js
     */
    public static function dependencyJS($path, $build = null)
    {
        /** @var AssetsComponentInterface $assetsManager */
        if ($assetsManager = self::fetchComponent(AssetsComponentInterface::class)) {
            $assetsManager->addDependencyJS($path, $build);
        }
    }

    /**
     * @kind accessorFunction
     * @name dependency_css
     */
    public static function dependencyCSS($path, $build = null)
    {
        /** @var AssetsComponentInterface $assetsManager */
        if ($assetsManager = self::fetchComponent(AssetsComponentInterface::class)) {
            $assetsManager->addDependencyCSS($path, $build);
        }
    }

    /**
     * @kind blockFunction
     * @name inline_js
     */
    public static function inlineJS($params, $content)
    {
        /** @var AssetsComponentInterface $assetsManager */
        if ($assetsManager = self::fetchComponent(AssetsComponentInterface::class)) {
            $assetsManager->addInlineJS($content);
        }
        return '';
    }

    /**
     * @kind blockFunction
     * @name inline_css
     */
    public static function inlineCSS($params, $content)
    {
        /** @var AssetsComponentInterface $assetsManager */
        if ($assetsManager = self::fetchComponent(AssetsComponentInterface::class)) {
            $assetsManager->addInlineCSS($content);
        }
        return '';
    }

    /**
     * @kind function
     * @name render_dependencies_js
     */
    public static function renderDependenciesJS($params)
    {
        /** @var AssetsComponentInterface $assetsManager */
        /** @var RendererInterface $renderer */
        if (
            ($assetsManager = self::fetchComponent(AssetsComponentInterface::class)) &&
            ($renderer = self::fetchComponent(RendererInterface::class))
        ) {
            $template = isset($params['template']) ? $params['template'] : 'assets/dependencies_js.tpl';
            return $renderer->render($template, [
                'dependencies' => $assetsManager->getDependenciesJS()
            ]);
        }
        return '';
    }

    /**
     * @kind function
     * @name render_inline_js
     */
    public static function renderInlineJS($params)
    {
        /** @var AssetsComponentInterface $assetsManager */
        /** @var RendererInterface $renderer */
        if (
            ($assetsManager = self::fetchComponent(AssetsComponentInterface::class)) &&
            ($renderer = self::fetchComponent(RendererInterface::class))
        ) {
            $template = isset($params['template']) ? $params['template'] : 'assets/inline_js.tpl';
            return $renderer->render($template, [
                'inline' => $assetsManager->getInlineJS()
            ]);
        }
        return '';
    }


    /**
     * @kind function
     * @name render_dependencies_css
     */
    public static function renderDependenciesCSS($params)
    {
        /** @var AssetsComponentInterface $assetsManager */
        /** @var RendererInterface $renderer */
        if (
            ($assetsManager = self::fetchComponent(AssetsComponentInterface::class)) &&
            ($renderer = self::fetchComponent(RendererInterface::class))
        ) {
            $template = isset($params['template']) ? $params['template'] : 'assets/dependencies_css.tpl';
            return $renderer->render($template, [
                'dependencies' => $assetsManager->getDependenciesCSS()
            ]);
        }
        return '';
    }

    /**
     * @kind function
     * @name render_inline_css
     */
    public static function renderInlineCSS($params)
    {
        /** @var AssetsComponentInterface $assetsManager */
        /** @var RendererInterface $renderer */
        if (
            ($assetsManager = self::fetchComponent(AssetsComponentInterface::class)) &&
            ($renderer = self::fetchComponent(RendererInterface::class))
        ) {
            $template = isset($params['template']) ? $params['template'] : 'assets/inline_css.tpl';
            return $renderer->render($template, [
                'inline' => $assetsManager->getInlineCSS()
            ]);
        }
        return '';
    }
}