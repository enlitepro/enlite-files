<?php
/**
 * The file interface
 *
 * @category   File
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles\File;


interface FileInterface {

    /**
     * Get id of the file
     *
     * @return int
     */
    public function getId();

    /**
     * Set path
     *
     * @param string $path
     * @return mixed
     */
    public function setPath($path);

    /**
     * Get path
     *
     * @return string
     */
    public function getPath();

    /**
     * Get a mime type of the file
     *
     * @return string
     */
    public function getMime();

    /**
     * Check that this file is an image
     *
     * @return bool
     */
    public function isImage();
}