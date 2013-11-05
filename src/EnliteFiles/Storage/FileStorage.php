<?php
/**
 * The storage in files
 *
 * @category   Storage
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       05.11.13
 */

namespace EnliteFiles\Storage;


class FileStorage implements StorageInterface {

    /**
     * The options
     *
     * @var FileStorageOptions
     */
    protected $options;

    /**
     * @param \EnliteFiles\Storage\FileStorageOptions $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return \EnliteFiles\Storage\FileStorageOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Save data in $path
     *
     * @param string $path
     * @param string $data
     * @param null|string $processedHash
     * @return string Return new path if use $processedHash else return $path
     */
    public function saveData($path, $data, $processedHash = null)
    {
        // TODO: Implement saveData() method.
    }

    /**
     * Save data from $pathFrom in $path
     *
     * @param string $path
     * @param string $pathFrom
     * @param null|string $processedHash
     * @return string Return new path if use $processedHash else return $path
     */
    public function saveDataFromPath($path, $pathFrom, $processedHash = null)
    {
        // TODO: Implement saveDataFromPath() method.
    }

    /**
     * Remove data
     *
     * @param string $path
     * @param null|string $processedHash
     * @return void
     */
    public function removeData($path, $processedHash = null)
    {
        // TODO: Implement removeData() method.
    }

    /**
     * Has data in path
     *
     * @param string $path
     * @param null|string $processedHash
     * @return bool
     */
    public function hasData($path, $processedHash = null)
    {
        // TODO: Implement hasData() method.
    }

    /**
     * Check $path is public
     *
     * @param $path
     * @return bool
     */
    public function isPublicPath($path)
    {
        // TODO: Implement isPublicPath() method.
    }

    /**
     * Generation new unique path
     *
     * @param bool $public
     * @return string
     */
    public function generationPath($public = false)
    {
        // TODO: Implement generationPath() method.
    }

    /**
     * Get a path to $path with hash $processedHash
     *
     * @param string $path
     * @param string $processedHash
     * @return string
     */
    public function getPath($path, $processedHash)
    {
        // TODO: Implement getPath() method.
    }
}