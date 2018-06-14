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


class AssetsComponent
{
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

    public function makePublicPath($path)
    {
        if (preg_match('/^((https?|ftp)\:)?\/\//', $path)) {
            return $path;
        }
        $path = ltrim($path, "/");
        return $this->_publicPath . '/' . $path;
    }

    public function setPublicPath($path)
    {
        $this->_publicPath = rtrim($path, "/");
    }

    public function addDependencyJS($string)
    {
        if (!in_array($string, $this->_dependenciesJS)) {
            $this->_dependenciesJS[] = $this->makePublicPath($string);
        }
    }

    public function addDependencyCSS($string)
    {
        if (!in_array($string, $this->_dependenciesCSS)) {
            $this->_dependenciesCSS[] = $this->makePublicPath($string);
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
}