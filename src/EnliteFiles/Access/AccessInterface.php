<?php
/**
 * The interface access
 *
 * @category   Access
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles\Access;


use EnliteFiles\File\FileInterface;

interface AccessInterface {

    /**
     * Check has access
     *
     * @param FileInterface $file
     * @param string $handler
     * @return bool
     */
    public function hasAccess(FileInterface $file, $handler);

} 