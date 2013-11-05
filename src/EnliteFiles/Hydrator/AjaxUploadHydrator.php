<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 05.11.13
 * Time: 14:34
 */

namespace EnliteFiles\Hydrator;


use EnliteFiles\File\FileInterface;
use EnliteFiles\File\FileNameInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

class AjaxUploadHydrator implements HydratorInterface{

    /**
     * Extract values from an object
     *
     * @param  FileInterface $object
     * @return array
     */
    public function extract($object)
    {
        return [];
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  FileInterface $object
     * @return FileInterface
     */
    public function hydrate(array $data, $object)
    {
        if (isset($data['file'])) {
            $file = $data['file'];
            $object->setPath($file['tmp_name']);

            if ($object instanceof FileNameInterface) {
                $object->setName($file['name']);
            }
        }

        return $object;
    }
}