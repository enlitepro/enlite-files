<?php
/**
 * The factory for processor manager
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

class ProcessorManagerFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ProcessorManagerOptions $config */
        $config = $serviceLocator->get('EnliteFilesProcessorManagerOptions');
//        if (isset($config['enlite_files']) && isset($config['enlite_files']['processors'])) {
//            $config = $config['enlite_files']['processor_manager'];
//        } else {
//            $config = null;
//        }

        $manager = new ProcessorManager($config->getHandlers());
        $manager->setConfig($config);
        return $manager;
    }
}