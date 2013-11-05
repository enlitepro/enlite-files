<?php
/**
 * The processor manager
 *
 * @category   
 * @package    
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles\Process;


use EnliteFiles\Exception\InvalidArgumentException;
use EnliteFiles\Exception\UnexpectedValueException;
use EnliteFiles\File\FileInterface;
use EnliteFiles\FileManagerTrait;
use EnliteFiles\Process\ProcessorManagerOptions;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class ProcessorManager extends AbstractPluginManager
    implements ProcessorManagerInterface, ServiceLocatorAwareInterface
{

    use ServiceLocatorAwareTrait, FileManagerTrait;

    /**
     * The config
     *
     * @var ProcessorManagerOptions
     */
    protected $config;

    /**
     * Process file
     *
     * @param FileInterface $file
     * @param string $handler
     * @return FileInterface Return a new file (after processed)
     */
    public function process(FileInterface $file, $handler)
    {
        $processors = $this->getHandlerArray($handler);
        $processFile = $this->getFileForProcess($file);
        if (count($processors) < 1) {
            return $processFile;
        }

        foreach ($processors as $processorName => $options) {
            $processor = $this->getProcessor($processorName, $options);
            $processFile = $processor->processFile($processFile);

            if ($processor->isBreak()) {
                break;
            }
        }

        return $processFile;
    }

    /**
     * Get processor by name and set options
     *
     * @param string $name
     * @param array $options
     * @return ProcessorInterface
     * @throws UnexpectedValueException
     */
    public function getProcessor($name, $options)
    {
        $processor = $this->get($name);
        return $processor;
    }

    /**
     * Get file file for process
     *
     * @param FileInterface $originalFile
     * @return FileInterface
     */
    protected function getFileForProcess(FileInterface $originalFile)
    {
        $file = $this->getFileManager()->factory();
        $file->setPath($originalFile->getPath());
        return $file;
    }

    /**
     * Get handler config
     *
     * @param string $handler
     * @return array
     * @throws InvalidArgumentException
     */
    protected function getHandlerArray($handler)
    {
        $handlers = $this->getConfig()->getHandlers();
        if (!isset($handlers[$handler])) {
            throw new InvalidArgumentException('Undefined handler "' . $handler . '" for processor manager');
        }

        return $handlers[$handler];
    }

    /**
     * Remove results of process file
     *
     * @param FileInterface $file
     * @param string|null $handler If null then remove results for all handlers
     * @return mixed
     */
    public function remove(FileInterface $file, $handler = null)
    {
        $processors = $this->getHandlerArray($handler);
        $processFile = $this->getFileForProcess($file);
        if (count($processors) < 1) {
            return;
        }

        foreach ($processors as $processorName => $options) {
            $processor = $this->getProcessor($processorName, $options);
            $processFile = $processor->processFile($processFile);
        }
    }

    /**
     * @param ProcessorManagerOptions $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return ProcessorManagerOptions
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Validate the plugin
     *
     * Checks that the filter loaded is either a valid callback or an instance
     * of FilterInterface.
     *
     * @param  mixed $plugin
     * @return void
     * @throws Exception\RuntimeException if invalid
     */
    public function validatePlugin($plugin)
    {
        if (!$plugin instanceof ProcessorInterface) {
            throw new Exception\RuntimeException('Processor must instance Processor\ProcessorInterface');
        }
    }
}