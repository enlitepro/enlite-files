<?php
/**
 * The filter save an uploaded file to a storage
 *
 * @category   Filter
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       05.11.13
 */
namespace EnliteFiles\Filter\File;

use EnliteFiles\FileManagerTrait;
use Zend\Filter\File\RenameUpload;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class MoveStorage extends RenameUpload implements ServiceLocatorAwareInterface{

    use ServiceLocatorAwareTrait, FileManagerTrait;

    public function __construct($targetOrOptions = null)
    {
        if (is_null($targetOrOptions)) {
            $targetOrOptions = $this->getFileManager()->getStorage()->generationPath();
        }
        parent::__construct($targetOrOptions);
    }


} 