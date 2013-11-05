<?php
/**
 * The iterface for support setName in files
 *
 * @category   Interface
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       05.11.13
 */

namespace EnliteFiles\File;


interface FileNameInterface {

    /**
     * Set a name of the file
     *
     * @param string $name
     * @return void
     */
    public function setName($name);

} 