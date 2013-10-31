<?php
/**
 * The factory for response builder manager
 *
 * @category   Factory
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       31.10.13
 */

namespace EnliteFiles\ResponseBuilder;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ResponseBuilderManagerFactory implements FactoryInterface{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        if (isset($config['enlite_files']) && isset($config['enlite_files']['response_builders'])) {
            $config = $config['enlite_files']['response_builders'];
        } else {
            $config = null;
        }

        return new ResponseBuilderManager($config);
    }
}