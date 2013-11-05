<?php
/**
 * The factory for options of a file storage
 *
 * @category   Factory
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       05.11.13
 */

namespace EnliteFiles\Storage;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FileStorageOptionsFactory implements FactoryInterface{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        if (isset($config['enlite_files']) && isset($config['enlite_files']['file_storage'])) {
            $config = $config['enlite_files']['file_storage'];
        } else {
            $config = [];
        }

        return new FileStorageOptions($config);
    }
}