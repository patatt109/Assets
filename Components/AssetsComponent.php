<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @date 12/06/18 15:27
 */

namespace Modules\Assets\Components;


use Modules\Assets\Builds\Build;
use Modules\User\Commands\CreateCommand;
use Phact\Helpers\Configurator;
use Phact\Helpers\SmartProperties;

class AssetsComponent
{
    use SmartProperties;

    protected $_defaultBuild = 'default';

    /**
     * @var string[]
     */
    protected $_dependenciesJS = [];

    /**
     * @var string[]
     */
    protected $_dependenciesCSS = [];

    /**
     * @var string[]
     */
    protected $_inlineJS = [];

    /**
     * @var string[]
     */
    protected $_inlineCSS = [];

    /**
     * @var string
     */
    protected $_publicPath = '/static';

    /**
     * @var array
     */
    protected $_builds = [];

    public function setBuilds($builds)
    {
        $this->_builds = [];
        foreach ($builds as $name => $config) {
            $this->_builds[$name] = Configurator::create($config);
        }
    }

    /**
     * @param $name
     * @return Build
     * @throws \Exception
     */
    public function getBuild($name)
    {
        if (!isset($this->_builds[$name])) {
            throw new \Exception("Build '{$name}' does not exists");
        }
        return $this->_builds[$name];
    }

    public function makePublicPath($path, $build = null)
    {
        if (!$build) {
            $build = $this->getDefaultBuild();
        }
        $buildObject = $this->getBuild($build);
        return $buildObject->buildPublicPath($path);
    }

    public function setPublicPath($path)
    {
        $this->_publicPath = rtrim($path, "/");
    }

    public function addDependencyJS($string, $build = null)
    {
        if (!in_array($string, $this->_dependenciesJS)) {
            $this->_dependenciesJS[] = $this->makePublicPath($string, $build);
        }
    }

    public function addDependencyCSS($string, $build = null)
    {
        if (!in_array($string, $this->_dependenciesCSS)) {
            $this->_dependenciesCSS[] = $this->makePublicPath($string, $build);
        }
    }

    /**
     * @return string[]
     */
    public function getDependenciesJS()
    {
        return $this->_dependenciesJS;
    }

    /**
     * @return string[]
     */
    public function getDependenciesCSS()
    {
        return $this->_dependenciesCSS;
    }

    /**
     * @return string[]
     */
    public function getInlineJS()
    {
        return $this->_inlineJS;
    }

    /**
     * @param string[] $inlineJS
     */
    public function addInlineJS($inlineJS)
    {
        $this->_inlineJS[] = $inlineJS;
    }

    /**
     * @return string[]
     */
    public function getInlineCSS()
    {
        return $this->_inlineCSS;
    }

    /**
     * @param string[] $inlineCSS
     */
    public function addInlineCSS($inlineCSS)
    {
        $this->_inlineCSS[] = $inlineCSS;
    }

    /**
     * @return string
     */
    public function getDefaultBuild()
    {
        return $this->_defaultBuild;
    }

    /**
     * @param string $defaultBuild
     */
    public function setDefaultBuild($defaultBuild)
    {
        $this->_defaultBuild = $defaultBuild;
    }
}