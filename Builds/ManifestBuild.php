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


use Phact\Exceptions\InvalidConfigException;
use Phact\Helpers\SmartProperties;

class ManifestBuild extends Build
{
    use SmartProperties;

    /**
     * @var string
     */
    protected $_manifestFile = '';

    /**
     * @var
     */
    protected $_manifest;

    public function buildPublicPath($path)
    {
        $manifest = $this->getManifest();
        $path = ltrim($path, '/');
        if (array_key_exists($path, $manifest)) {
            $path = $manifest[$path];
        }
        return $this->getPublicPath() . '/' . $path;
    }

    /**
     * @return string
     */
    public function getManifestFile()
    {
        return $this->_manifestFile;
    }

    /**
     * @param string $manifestFile
     */
    public function setManifestFile($manifestFile)
    {
        $this->_manifestFile = $manifestFile;
    }

    /**
     * @return mixed
     * @throws InvalidConfigException
     */
    public function getManifest()
    {
        if (is_null($this->_manifest)) {
            if (!is_file($this->_manifestFile)) {
                throw new InvalidConfigException("Manifest file '{$this->_manifestFile}' not found");
            }
            $data = file_get_contents($this->_manifestFile);
            if (!$data) {
                throw new InvalidConfigException("Manifest file '{$this->_manifestFile}' is empty or incorrect");
            }
            $this->_manifest = json_decode($data, true);
        }
        return $this->_manifest;
    }
}