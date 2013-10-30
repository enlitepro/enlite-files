<?php
/**
 * The file manager options
 *
 * @category   Options
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles;


use Zend\Stdlib\AbstractOptions;

class FileManagerOptions extends  AbstractOptions
{

    /**
     * The storage
     *
     * @var string
     */
    protected $storage = 'EnliteFilesFileStorage';

    /**
     * The registry
     *
     * @var string
     */
    protected $registry = 'EnliteFilesDoctrineRegistry';
    
    /**
     * The processorManager
     *
     * @var string
     */
    protected $processorManager = 'EnliteFilesProcessorManager';
    
    /**
     * The accessDelete
     *
     * @var string
     */
    protected $accessDelete = 'EnliteFilesVoidAccess';

    /**
     * The accessDownload
     *
     * @var string
     */
    protected $accessDownload = 'EnliteFilesVoidAccess';

    /**
     * The accessUpload
     *
     * @var string
     */
    protected $accessUpload = 'EnliteFilesVoidAccess';
    
    /**
     * The handlers
     *
     * @var array
     */
//    protected $handlers = [
//        'original' => [
//
//        ]
//    ];

    /**
     * @param string $registry
     */
    public function setRegistry($registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return string
     */
    public function getRegistry()
    {
        return $this->registry;
    }

    /**
     * @param string $storage
     */
    public function setStorage($storage)
    {
        $this->storage = $storage;
    }

    /**
     * @return string
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param string $processorManager
     */
    public function setProcessorManager($processorManager)
    {
        $this->processorManager = $processorManager;
    }

    /**
     * @return string
     */
    public function getProcessorManager()
    {
        return $this->processorManager;
    }

    /**
     * @param string $accessDelete
     */
    public function setAccessDelete($accessDelete)
    {
        $this->accessDelete = $accessDelete;
    }

    /**
     * @return string
     */
    public function getAccessDelete()
    {
        return $this->accessDelete;
    }

    /**
     * @param string $accessDownload
     */
    public function setAccessDownload($accessDownload)
    {
        $this->accessDownload = $accessDownload;
    }

    /**
     * @return string
     */
    public function getAccessDownload()
    {
        return $this->accessDownload;
    }

    /**
     * @param string $accessUpload
     */
    public function setAccessUpload($accessUpload)
    {
        $this->accessUpload = $accessUpload;
    }

    /**
     * @return string
     */
    public function getAccessUpload()
    {
        return $this->accessUpload;
    }

} 