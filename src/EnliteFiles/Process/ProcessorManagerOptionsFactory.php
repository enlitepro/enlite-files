<?php
/**
 * The factory for options processor manager
 *
 * @category   Factory
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles\Process;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProcessorManagerOptionsFactory implements FactoryInterface
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
        return new ProcessorManagerOptions(
            isset($config['enlite_files']) && isset($config['enlite_files']['processor_manager'])
                ? $config['enlite_files']['processor_manager']
                : []
        );
    }
}