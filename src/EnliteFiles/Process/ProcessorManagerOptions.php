<?php
/**
 * The options for processor manager
 *
 * @category   Options
 * @package    EnliteFiles
 * @author     Vladimir Struc <Sysaninster@gmail.com>
 * @license    LICENSE.txt
 * @date       30.10.13
 */

namespace EnliteFiles\Process;


use Zend\Stdlib\AbstractOptions;

class ProcessorManagerOptions extends AbstractOptions
{

    /**
     * The handlers
     *
     * @var array
     */
    protected $handlers = [
        'original' => [],
    ];

    /**
     * @param array $handlers
     */
    public function setHandlers($handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * @return array
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

} 