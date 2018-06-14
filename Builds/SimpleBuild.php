<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @date 14/06/18 10:42
 */

namespace Modules\Assets\Builds;


class SimpleBuild extends Build
{
    public function buildPublicPath($path)
    {
        if (preg_match('/^((https?|ftp)\:)?\/\//', $path)) {
            return $path;
        }
        $path = ltrim($path, "/");
        return $this->getPublicPath() . '/' . $path;
    }
}