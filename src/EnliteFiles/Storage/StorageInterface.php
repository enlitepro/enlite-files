<?php
/**
 * The interface for storage
 *
 * @category   Storage
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles\Storage;


interface StorageInterface {

    /**
     * Save data in $path
     *
     * @param string $path
     * @param string $data
     * @param null|string $processedHash
     * @return string Return new path if use $processedHash else return $path
     */
    public function saveData($path, $data, $processedHash = null);

    /**
     * Save data from $pathFrom in $path
     *
     * @param string $path
     * @param string $pathFrom
     * @param null|string $processedHash
     * @return string Return new path if use $processedHash else return $path
     */
    public function saveDataFromPath($path, $pathFrom, $processedHash = null);


    /**
     * Remove data
     *
     * @param string $path
     * @param null|string $processedHash
     * @return void
     */
    public function removeData($path, $processedHash = null);

    /**
     * Has data in path
     *
     * @param string $path
     * @param null|string $processedHash
     * @return bool
     */
    public function hasData($path, $processedHash = null);

    /**
     * Check $path is public
     *
     * @param $path
     * @return bool
     */
    public function isPublicPath($path);

    /**
     * Generation new unique path
     *
     * @param bool $public
     * @return string
     */
    public function generationPath($public = false);

    /**
     * Get a path to $path with hash $processedHash
     *
     * @param string $path
     * @param string $processedHash
     * @return string
     */
    public function getPath($path, $processedHash);

} 