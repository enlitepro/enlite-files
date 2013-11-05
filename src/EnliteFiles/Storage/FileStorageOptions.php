<?php
/**
 * The options for file storage
 *
 * @category   Options
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       05.11.13
 */

namespace EnliteFiles\Storage;


use Zend\Stdlib\AbstractOptions;

class FileStorageOptions extends AbstractOptions{

    /**
     * The publicPath
     *
     * @var string
     */
    protected $publicPath = 'public/files';
    
    /**
     * The publicWebPath
     *
     * @var string
     */
    protected $publicWebPath = 'files';

    /**
     * The privatePath
     *
     * @var string
     */
    protected $privatePath = 'data/files';

    /**
     * @param string $privatePath
     */
    public function setPrivatePath($privatePath)
    {
        $this->privatePath = $privatePath;
    }

    /**
     * @return string
     */
    public function getPrivatePath()
    {
        return $this->privatePath;
    }

    /**
     * @param string $publicPath
     */
    public function setPublicPath($publicPath)
    {
        $this->publicPath = $publicPath;
    }

    /**
     * @return string
     */
    public function getPublicPath()
    {
        return $this->publicPath;
    }

    /**
     * @param string $publicWebPath
     */
    public function setPublicWebPath($publicWebPath)
    {
        $this->publicWebPath = $publicWebPath;
    }

    /**
     * @return string
     */
    public function getPublicWebPath()
    {
        return $this->publicWebPath;
    }
    
} 