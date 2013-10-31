<?php
/**
 * The controller for work with file
 *
 * @category   Controller
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles\Controller;


use EnliteFiles\CommontOptionsTrait;
use EnliteFiles\Exception\UnexpectedValueException;
use EnliteFiles\FileManagerTrait;
use EnliteFiles\ResponseBuilder\ResponseBuilderInterface;
use EnliteFiles\ResponseBuilder\ResponseBuilderManager;
use Exception;
use Zend\Form\Form;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class FileController extends AbstractActionController
{
    use FileManagerTrait, CommontOptionsTrait;

    /**
     * Ajax upload file
     *
     * @return JsonModel
     * @throws UnexpectedValueException
     */
    public function ajaxUploadAction()
    {
        $formName = $this->params()->fromRoute('form', 'default');
        $validNames = $this->getCommonOptions()->getUploadForms();
        if (!isset($validNames[$formName])) {
            return $this->ajaxError([sprintf('The name "%s" of form not registered in $config[enlite_files][upload_forms]', $formName)]);
        }
        /** @var Form $form */
        $form = $this->getServiceLocator()->get($validNames[$formName]);
        if (!$form instanceof FormInterface) {
            throw new UnexpectedValueException(sprintf('The object "%s" must be implement of Zend\Form\FormInterface', $validNames[$formName]));
        }

        if (!$this->getRequest()->isPost()) {
            return $this->ajaxError(['For upload file you must use POST method']);
        }

        $file = $this->getFileManager()->factory();
        $form->bind($file);
        $form->setData($this->params()->fromPost());

        if (!$form->isValid()) {
            return $this->ajaxError($form->getMessages());
        }

        $access = $this->getFileManager()->getAccessUpload();
        if (!$access->hasAccess($file, $formName)) {
            return $this->ajaxForbidden();
        }

        $this->getFileManager()->save($file);

        $model = new JsonModel();
        $model->setVariable('status', 'ok');
        $model->setVariable('file', $file->toArray());

        return $model;
    }

    /**
     * Ajax delete file
     */
    public function ajaxDeleteAction()
    {
        $id = $this->params()->fromQuery('id');
        try {
            $file = $this->getFileManager()->loadById($id);
        } catch (Exception $e) {
            return $this->ajaxError([$e->getMessage()]);
        }

        if (!$this->getRequest()->isPost() && !$this->getRequest()->isDelete()) {
            return $this->ajaxError(['For delete file you must use POST or DELETE methods']);
        }

        $access = $this->getFileManager()->getAccessDelete();
        if (!$access->hasAccess(
            $file,
            $this->params()->fromQuery('handler', 'default')
        )) {
            return $this->ajaxForbidden();
        }

        $this->getFileManager()->remove($file);

        $model = new JsonModel();
        $model->setVariable('status', 'ok');

        return $model;
    }

    /**
     * Get file for show and download
     *
     * @return array|ViewModel|\Zend\Http\Response|JsonModel
     */
    public function fileAction()
    {
        $id = $this->params()->fromQuery('id');
        try {
            $file = $this->getFileManager()->loadById($id);
        } catch (Exception $e) {
            return $this->ajaxError([$e->getMessage()]);
        }

        $access = $this->getFileManager()->getAccessDownload();
        if (!$access->hasAccess(
            $file,
            $this->params()->fromQuery('handler', 'original')
        )) {
            return $this->forbidden();
        }

        /** @var ResponseBuilderManager $buildersManager */
        $buildersManager = $this->getServiceLocator()->get('EnliteFilesResponseBuilderManager');
        $builderName = $this->params()->fromQuery('builder');
        if (!$buildersManager->has($builderName)) {
            return $this->notFoundAction();
        }

        /** @var ResponseBuilderInterface $builder */
        $builder = $buildersManager->get($builderName);
        return $builder->buildResponse($this->getRequest(), $file);
    }

    /**
     * Create an HTTP view model representing a "forbidden" page
     *
     * @return ViewModel
     */
    public function forbidden()
    {
        $this->getResponse()->setStatusCode(403);
        return new ViewModel(array(
            'content' => 'Access forbidden',
        ));
    }

    /**
     * Get model for ajax error
     *
     * @param $errors
     * @return JsonModel
     */
    public function ajaxError($errors)
    {
        $model = new JsonModel();
        $model->setVariable('status', 'error');
        $model->setVariable('messages', $errors);
        return $model;
    }

    /**
     * @return JsonModel
     */
    public function ajaxForbidden()
    {
        return $this->ajaxError(['Forbidden error']);
    }

} 