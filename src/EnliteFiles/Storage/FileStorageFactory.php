<?php
/**
 * The factory for a file storage
 *
 * @category   Storage
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       05.11.13
 */

namespace EnliteFiles\Storage;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FileStorageFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('EnliteFilesFileStorageOptions');
        $storage = new FileStorage();
        $storage->setOptions($options);
        return $storage;
    }
}