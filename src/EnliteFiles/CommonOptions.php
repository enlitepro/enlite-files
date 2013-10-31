<?php
/**
 * The common options
 *
 * @category   Options
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       31.10.13
 */

namespace EnliteFiles;


use Zend\Stdlib\AbstractOptions;

class CommonOptions extends AbstractOptions
{

    /**
     * The uploadForms
     *
     * @var array
     */
    protected $uploadForms = [
        'default' => 'EnliteFilesDefaultUploadForm'
    ];
    
    /**
     * The responseBuilders
     *
     * @var 
     */
    protected $allowResponses = [
        'view',
        'download'
    ];

    /**
     * @param array $uploadForms
     */
    public function setUploadForms($uploadForms)
    {
        $this->uploadForms = $uploadForms;
    }

    /**
     * @return array
     */
    public function getUploadForms()
    {
        return $this->uploadForms;
    }

    /**
     * @param mixed $allowResponses
     */
    public function setAllowResponses($allowResponses)
    {
        $this->allowResponses = $allowResponses;
    }

    /**
     * @return mixed
     */
    public function getAllowResponses()
    {
        return $this->allowResponses;
    }

} 