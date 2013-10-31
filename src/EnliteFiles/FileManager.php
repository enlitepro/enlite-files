<?php
/**
 * The file manager
 *
 * @category   Manager
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles;


use EnliteFiles\Access\AccessInterface;
use EnliteFiles\Process\ProcessorManagerInterface;
use EnliteFiles\Registry\RegistryInterface;
use EnliteFiles\Storage\StorageInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FileManager implements ServiceLocatorAwareInterface
{

    /**
     * The serviceLocator
     *
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * The storage
     *
     * @var StorageInterface
     */
    protected $storage;

    /**
     * The registry
     *
     * @var RegistryInterface
     */
    protected $registry;

    /**
     * The accessUpload
     *
     * @var AccessInterface
     */
    protected $accessUpload;
    
    /**
     * The accessDelete
     *
     * @var AccessInterface
     */
    protected $accessDelete;
    
    /**
     * The accessDownload
     *
     * @var AccessInterface
     */
    protected $accessDownload;
    
    /**
     * The processorManager
     *
     * @var ProcessorManagerInterface
     */
    protected $processorManager;

    /**
     * The config
     *
     * @var FileManagerOptions
     */
    protected $config;

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * @param RegistryInterface $registry
     */
    public function setRegistry($registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return RegistryInterface
     */
    public function getRegistry()
    {
        if (is_null($this->registry)) {
            $this->registry = $this->getServiceLocator()->get(
                $this->getConfig()->getRegistry()
            );
        }
        return $this->registry;
    }

    /**
     * @param StorageInterface $storage
     */
    public function setStorage($storage)
    {
        $this->storage = $storage;
    }

    /**
     * @return StorageInterface
     */
    public function getStorage()
    {
        if (is_null($this->storage)) {
            $this->storage = $this->getServiceLocator()->get(
                $this->getConfig()->getStorage()
            );
        }
        return $this->storage;
    }

    /**
     * @param \EnliteFiles\Access\AccessInterface $accessUpload
     */
    public function setAccessUpload($accessUpload)
    {
        $this->accessUpload = $accessUpload;
    }

    /**
     * @return \EnliteFiles\Access\AccessInterface
     */
    public function getAccessUpload()
    {
        if (is_null($this->accessUpload)) {
            $this->accessUpload = $this->getServiceLocator()->get(
                $this->getConfig()->getAccessUpload()
            );
        }
        return $this->accessUpload;
    }

    /**
     * @param AccessInterface $accessDelete
     */
    public function setAccessDelete($accessDelete)
    {
        $this->accessDelete = $accessDelete;
    }

    /**
     * @return AccessInterface
     */
    public function getAccessDelete()
    {
        if (is_null($this->accessDelete)) {
            $this->accessDelete = $this->getServiceLocator()->get(
                $this->getConfig()->getAccessDelete()
            );
        }
        return $this->accessDelete;
    }

    /**
     * @param AccessInterface $accessDownload
     */
    public function setAccessDownload($accessDownload)
    {
        $this->accessDownload = $accessDownload;
    }

    /**
     * @return AccessInterface
     */
    public function getAccessDownload()
    {
        if (is_null($this->accessDownload)) {
            $this->accessDownload = $this->getServiceLocator()->get(
                $this->getConfig()->getAccessDownload()
            );
        }
        return $this->accessDownload;
    }

    /**
     * Factory file
     *
     * @return File\FileInterface
     */
    public function factory()
    {
        return $this->getRegistry()->factory();
    }

    /**
     * Save file
     *
     * @param File\FileInterface $file
     */
    public function save(File\FileInterface $file)
    {
        $this->getRegistry()->save($file);
    }

    /**
     * Remove file
     *
     * @param File\FileInterface $file
     */
    public function remove(File\FileInterface $file)
    {
        $this->getRegistry()->remove($file);
        $this->getProcessorManager()->remove($file);
    }

    public function loadById($id)
    {
        return $this->getRegistry()->loadById($id);
    }

    /**
     * Create file from any path
     *
     * @param string $path
     * @param bool $public
     * @return File\FileInterface
     */
    public function createFileFromPath($path, $public = false)
    {
        $pathTo = $this->getStorage()->generationPath($public);
        $pathResult = $this->getStorage()->saveDataFromPath($pathTo, $path);
        return $this->makeFileFromPath($pathResult);
    }

    /**
     * Create file from data
     *
     * @param string $data
     * @param bool $public
     * @return File\FileInterface
     */
    public function createFileFromData($data, $public = false)
    {
        $pathTo = $this->getStorage()->generationPath($public);
        $pathResult = $this->getStorage()->saveData($pathTo, $data);
        return $this->makeFileFromPath($pathResult);
    }

    /**
     * Make file from path (the file must be saved by a storage)
     *
     * @param string $path
     * @return File\FileInterface
     */
    protected function makeFileFromPath($path)
    {
        $file = $this->getRegistry()->factory();
        $file->setPath($path);

        $this->save($file);
        return $file;
    }

    /**
     * @param \EnliteFiles\Process\ProcessorManagerInterface $processorManager
     */
    public function setProcessorManager($processorManager)
    {
        $this->processorManager = $processorManager;
    }

    /**
     * @return \EnliteFiles\Process\ProcessorManagerInterface
     */
    public function getProcessorManager()
    {
        if (is_null($this->processorManager)) {
            $this->processorManager = $this->getServiceLocator()->get(
                $this->getConfig()->getProcessorManager()
            );
        }
        return $this->processorManager;
    }

    /**
     * @param \EnliteFiles\FileManagerOptions $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return \EnliteFiles\FileManagerOptions
     */
    public function getConfig()
    {
        if (is_null($this->config)) {
            $this->config = $this->getServiceLocator()->get('EnliteFilesManagerOptions');
        }
        return $this->config;
    }

}