<?php
/**
 * The interface of registry
 *
 * @category   Registry
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles\Registry;


use EnliteFiles\File\FileInterface;
use EnliteFiles\Storage\StorageInterface;

interface RegistryInterface {

    /**
     * Save info about file
     *
     * @param FileInterface $file
     * @return void
     */
    public function save(FileInterface $file);

    /**
     * Load file by id
     *
     * @param int $id
     * @return FileInterface
     */
    public function loadById($id);

    /**
     * Remove info about file
     *
     * @param FileInterface $file
     * @return void
     */
    public function remove(FileInterface $file);

    /**
     * Factory model of file
     *
     * @return FileInterface
     */
    public function factory();

    /**
     * Set storage
     *
     * @param StorageInterface $storage
     * @return void
     */
    public function setStorage(StorageInterface $storage);

} 