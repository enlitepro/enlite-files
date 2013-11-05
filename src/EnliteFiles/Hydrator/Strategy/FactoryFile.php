<?php
/**
 * The strategy for factory FileInterface after upload file.
 * Warning! Before it using you must use Filter\File\MoveStorage.
 *
 * @category   Strategy
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       05.11.13
 */

namespace EnliteFiles\Hydrator\Strategy;


use EnliteFiles\Exception\UnexpectedValueException;
use EnliteFiles\File\FileNameInterface;
use EnliteFiles\FileManagerTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

class FactoryFile implements StrategyInterface, ServiceLocatorAwareInterface{

    use ServiceLocatorAwareTrait, FileManagerTrait;

    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param mixed $value The original value.
     * @param object $object (optional) The original object for context.
     * @return mixed Returns the value that should be extracted.
     */
    public function extract($value)
    {
        return '';
    }

    /**
     * Converts the given value so that it can be hydrated by the hydrator.
     *
     * @param mixed $value The original value.
     * @param array $data (optional) The original data for context.
     * @return mixed Returns the value that should be hydrated.
     */
    public function hydrate($value)
    {
        if (!is_array($value) || !isset($value['tmp_name'])) {
            throw new UnexpectedValueException('In strategy the value must be from $_FILE');
        }
        if (empty($value['tmp_name'])) {
            return null;
        }

        $file = $this->getFileManager()->factory();
        $file->setPath($value['tmp_name']);

        if ($file instanceof FileNameInterface) {
            $file->setName($value['name']);
        }

        return $file;
    }
}