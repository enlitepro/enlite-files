<?php
/**
 * The abstract processor
 *
 * @category   Processor
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles\Process;


use EnliteFiles\File\FileInterface;
use EnliteFiles\FileManagerTrait;
use EnliteFiles\Storage\StorageInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

abstract class ProcessorAbstract implements ProcessorInterface, ServiceLocatorAwareInterface
{

    use ServiceLocatorAwareTrait, FileManagerTrait;

    /**
     * The hash
     *
     * @var string
     */
    protected $hash;

    /**
     * After a process this processor do break a process
     *
     * @return bool
     */
    public function isBreak()
    {
        return false;
    }

    /**
     * @param string $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return StorageInterface
     */
    public function getStorage()
    {
        return $this->getFileManager()->getStorage();
    }

    /**
     * Remove cache file
     *
     * @param FileInterface $file
     * @return FileInterface
     */
    public function remove(FileInterface $file)
    {
        if ($this->getStorage()->hasData($file->getPath(), $this->getHash())) {
            $this->getStorage()->removeData($file->getPath(), $this->getHash());
        }

        $processedFile = $this->getFileManager()->factory();
        $processedFile->setPath($this->getStorage()->getPath(
            $file->getPath(),
            $this->getHash()
        ));

        return $processedFile;
    }

    /**
     * Generation hash from array with options
     *
     * @param array $options
     */
    public function generationHashFromOptions(array $options)
    {
        $this->setHash(
            md5(print_r($options, true))
        );
    }

} 