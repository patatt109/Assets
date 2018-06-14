<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @date 14/06/18 10:41
 */

namespace Modules\Assets\Builds;


use Phact\Helpers\SmartProperties;

abstract class Build
{
    use SmartProperties;

    protected $_publicPath;

    /**
     * @return mixed
     */
    public function getPublicPath()
    {
        return $this->_publicPath;
    }

    /**
     * @param mixed $publicPath
     */
    public function setPublicPath($publicPath)
    {
        $this->_publicPath = rtrim($publicPath, "/");
    }

    abstract public function buildPublicPath($path);
}