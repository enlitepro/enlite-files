<?php
/**
 * The default form for ajax upload files
 *
 * @category   Form
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       05.11.13
 */

namespace EnliteFiles\Form;


use EnliteFiles\FileManager;
use EnliteFiles\Hydrator\AjaxUploadHydrator;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AjaxUploadForm implements FactoryInterface {

    /**
     * The fileManger
     *
     * @var FileManager
     */
    protected $fileManger;

    /**
     * @param \EnliteFiles\FileManager $fileManger
     */
    public function setFileManger($fileManger)
    {
        $this->fileManger = $fileManger;
    }

    /**
     * @return \EnliteFiles\FileManager
     */
    public function getFileManger()
    {
        return $this->fileManger;
    }

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var FileManager $fileManager */
        $fileManager = $serviceLocator->get('EnliteFilesManager');
        $this->setFileManger($fileManager);

        $form = new Form('enlite_ajax_file_upload');
        $form->setAttribute('enctype', 'multipart/form-data');

        $file = new Element\File('file');
        $form->add($file);

        $form->setInputFilter($this->getInputFilter());
        $form->setHydrator($this->getHydrator());

        return $form;
    }

    /**
     * @return HydratorInterface
     */
    public function getHydrator()
    {
        $hydrator = new AjaxUploadHydrator();

        return $hydrator;
    }

    /**
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        return (new Factory())->createInputFilter(
            array(
                'file' => [
                    'required' => true
                ]
            )
        );
    }
}