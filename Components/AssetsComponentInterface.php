<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @date 07/10/2018 15:05
 */

namespace Modules\Assets\Components;


interface AssetsComponentInterface
{
    public function makePublicPath($path, $build = null);

    public function addDependencyJS($string, $build = null);

    public function addDependencyCSS($string, $build = null);

    public function getDependenciesJS();

    public function getDependenciesCSS();

    public function getInlineJS();

    public function addInlineJS($inlineJS);

    public function getInlineCSS();

    public function addInlineCSS($inlineCSS);

    public function getDefaultBuild();

    public function setDefaultBuild($defaultBuild);
}