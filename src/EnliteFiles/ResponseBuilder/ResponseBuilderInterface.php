<?php
/**
 * The interface for response builder
 *
 * @category   Interface
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       31.10.13
 */

namespace EnliteFiles\ResponseBuilder;


use EnliteFiles\File\FileInterface;
use Zend\Http\Request;
use Zend\Http\Response;

interface ResponseBuilderInterface {

    /**
     * @param Request $request
     * @param FileInterface $file
     * @return Response
     */
    public function buildResponse(Request $request, FileInterface $file);

} 