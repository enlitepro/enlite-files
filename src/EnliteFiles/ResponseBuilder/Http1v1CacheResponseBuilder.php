<?php
/**
 * The response builder support cache http 1.1 and Expires for http 1.0
 *
 * @category   ResponseBuilder
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       31.10.13
 */

namespace EnliteFiles\ResponseBuilder;

use EnliteFiles\File\FileInterface;
use Zend\Http\Request;
use Zend\Http\Response;

class Http1v1CacheResponseBuilder implements ResponseBuilderInterface {

    /**
     * The enableCache
     *
     * @var bool
     */
    protected $enableCache = true;
    
    /**
     * The expiresCache
     *
     * @var int
     */
    protected $expiresCache = 604800;

    /**
     * The typeCache
     *
     * @var string
     */
    protected $typeCache = 'public';

    /**
     * The view
     *
     * @var bool
     */
    protected $view = false;

    /**
     * @param boolean $enableCache
     */
    public function setEnableCache($enableCache)
    {
        $this->enableCache = $enableCache;
    }

    /**
     * @return boolean
     */
    public function getEnableCache()
    {
        return $this->enableCache;
    }

    /**
     * @param int $expiresCache
     */
    public function setExpiresCache($expiresCache)
    {
        $this->expiresCache = $expiresCache;
    }

    /**
     * @return int
     */
    public function getExpiresCache()
    {
        return $this->expiresCache;
    }

    /**
     * @param string $typeCache
     */
    public function setTypeCache($typeCache)
    {
        $this->typeCache = $typeCache;
    }

    /**
     * @return string
     */
    public function getTypeCache()
    {
        return $this->typeCache;
    }

    /**
     * @param boolean $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @return boolean
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param Request $request
     * @param FileInterface $file
     * @return Response
     */
    public function buildResponse(Request $request, FileInterface $file)
    {
        header_remove('Pragma');

        if (!$this->getEnableCache()) {
            return $this->fileResponse($file);
        }

        if ($response = $this->eTagResponse($request, $file)) {
            return $response;
        }

        return $this->fileResponse($file);
    }

    /**
     * Get response with file
     *
     * @param FileInterface $file
     */
    protected function fileResponse(FileInterface $file) {
        $response = new Response\Stream();
        $response->getHeaders()->addHeaderLine('Content-type', $file->getMime());

        if ($this->getEnableCache()) {
            $response->getHeaders()->addHeaderLine(
                'Cache-Control', $this->getTypeCache() . ', max-age=' . (int)$this->getExpiresCache()
            );
            $response->getHeaders()->addHeaderLine('Expires', date('r', time() + (int)$this->getExpiresCache()));
            $response->getHeaders()->addHeaderLine('ETag', '"' . $file->getHash() . '"');
        } else {
            $response->getHeaders()->addHeaderLine('Cache-Control', 'no-store');
            $response->getHeaders()->addHeaderLine('Expires', date('r', time()));
        }

        if (!$this->getView()) {
            $response->getHeaders()->addHeaderLine('Content-Disposition', 'attachment; filename="' . $file->getName() . '";');
        }

        $response->setStream(fopen($file->getPath(), 'r'));
    }

    /**
     * Try get a none modified response
     *
     * @param Request $request
     * @param FileInterface $file
     * @return bool|Response
     */
    protected function eTagResponse(Request $request, FileInterface $file)
    {
        $hash = $request->getHeader('If-None-Match');
        if (!$hash || $hash !== '"' . $file->getHash() . '"') {
            return false;
        }

        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_304);
        return $response;
    }
}