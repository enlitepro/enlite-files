<?php
/**
 * The interface for processor
 *
 * @category   Interface
 * @package    EnliteFile
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles\Process;


use EnliteFiles\File\FileInterface;

interface ProcessorInterface {

    /**
     * Process file
     *
     * @param FileInterface $file
     * @return FileInterface Return a new file (processed)
     */
    public function processFile(FileInterface $file);

    /**
     * Remove cache file
     *
     * @param FileInterface $file
     * @return FileInterface
     */
    public function remove(FileInterface $file);

    /**
     * After a process this processor do break a process
     *
     * @return bool
     */
    public function isBreak();

} 