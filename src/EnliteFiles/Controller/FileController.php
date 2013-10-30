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


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class FileController extends AbstractActionController
{

    public function ajaxUploadAction()
    {

    }

    /**
     * @return JsonModel
     */
    public function ajaxForbidden()
    {
        $model = new JsonModel();
        $model->setVariable('status', 'error');
        $model->setVariable('message', 'Forbidden error');
        return $model;
    }

} 