<?php
/**
 * This access always return true
 *
 * @category   Access
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles\Access;


use EnliteFiles\File\FileInterface;

class VoidAccess implements AccessInterface
{

    /**
     * Check has access
     *
     * @param FileInterface $file
     * @param string $handler
     * @return bool
     */
    public function hasAccess(FileInterface $file, $handler)
    {
        return true;
    }
}