<?php
/**
 * The response builders manger
 *
 * @category   Manager
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       31.10.13
 */

namespace EnliteFiles\ResponseBuilder;


use EnliteFiles\Exception\RuntimeException;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception;

/** @method ResponseBuilderInterface get($name, $options = array(), $usePeeringServiceManagers = true) */
class ResponseBuilderManager extends AbstractPluginManager{

    /**
     * Validate the plugin
     *
     * Checks that the filter loaded is either a valid callback or an instance
     * of FilterInterface.
     *
     * @param  mixed $plugin
     * @throws RuntimeException
     * @return void
     */
    public function validatePlugin($plugin)
    {
        if (!$plugin instanceof ResponseBuilderInterface) {
            throw new RuntimeException('Response builder must instance of ResponseBuilderInterface');
        }
    }
}