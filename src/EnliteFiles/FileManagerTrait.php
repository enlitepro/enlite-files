<?php
/**
 * The trait for file manager
 *
 * @category   Trait
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles;

use EnliteFiles\FileManager;

trait FileManagerTrait {

    /**
     * @var FileManager
     */
    protected $fileManager = null;

    /**
     * @param FileManager $fileManager
     */
    public function setFileManager(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    /**
     * @return FileManager
     * @throws RuntimeException
     */
    public function getFileManager()
    {
        if (null === $this->fileManager) {
            if ($this instanceof ServiceLocatorAwareInterface || method_exists($this, 'getServiceLocator')) {
                $this->fileManager = $this->getServiceLocator()->get('FileManager');
            } else {
                if (property_exists($this, 'serviceLocator')
                    && $this->serviceLocator instanceof ServiceLocatorInterface
                ) {
                    $this->fileManager = $this->serviceLocator->get('FileManager');
                } else {
                    throw new RuntimeException('Service locator not found');
                }
            }
        }
        return $this->fileManager;
    }
    
} 