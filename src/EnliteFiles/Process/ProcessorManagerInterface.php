<?php
/**
 * The interface for processor manager
 *
 * @category   ProcessorManager
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles\Process;


use EnliteFiles\File\FileInterface;

interface ProcessorManagerInterface {

    /**
     * Process file
     *
     * @param FileInterface $file
     * @param string $handler
     * @return FileInterface Return a new file (after processed)
     */
    public function process(FileInterface $file, $handler);

    /**
     * Remove results of process file
     *
     * @param FileInterface $file
     * @param string|null $handler If null then remove results for all handlers
     * @return mixed
     */
    public function remove(FileInterface $file, $handler = null);

} 