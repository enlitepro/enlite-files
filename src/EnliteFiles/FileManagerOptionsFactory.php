<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 30.10.13
 * Time: 15:51
 */

namespace EnliteFiles;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FileManagerOptionsFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        return new FileManagerOptions(
            isset($config['enlite_files']) && isset($config['enlite_files']['manager'])
                ? $config['enlite_files']['manager']
                : []
        );
    }
}