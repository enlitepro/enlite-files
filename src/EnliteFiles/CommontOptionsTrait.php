<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 31.10.13
 * Time: 12:08
 */

namespace EnliteFiles;

trait CommontOptionsTrait {

    /**
     * @var CommonOptions
     */
    protected $commonOptions = null;

    /**
     * @param CommonOptions $commonOptions
     */
    public function setCommonOptions(CommonOptions $commonOptions)
    {
        $this->commonOptions = $commonOptions;
    }

    /**
     * @return CommonOptions
     * @throws RuntimeException
     */
    public function getCommonOptions()
    {
        if (null === $this->commonOptions) {
            if ($this instanceof ServiceLocatorAwareInterface || method_exists($this, 'getServiceLocator')) {
                $this->commonOptions = $this->getServiceLocator()->get('EnliteFilesCommonOptions');
            } else {
                if (property_exists($this, 'serviceLocator')
                    && $this->serviceLocator instanceof ServiceLocatorInterface
                ) {
                    $this->commonOptions = $this->serviceLocator->get('EnliteFilesCommonOptions');
                } else {
                    throw new RuntimeException('Service locator not found');
                }
            }
        }
        return $this->commonOptions;
    }
    
} 