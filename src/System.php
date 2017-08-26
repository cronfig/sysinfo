<?php
/**
 * @package     Cronfig Sysinfo Library
 * @link        https://github.com/cronfig/sysinfo
 * @license     http://opensource.org/licenses/MIT
 */

namespace Cronfig\Sysinfo;

use Cronfig\Sysinfo\Linux;
use Cronfig\Sysinfo\Mac;

/**
 * Class System
 */
class System
{
    public function __construct($customs = [])
    {
        $defaults = [
            Linux::class,
            Mac::class,
        ];

        $osToRegister = array_merge($defaults, $customs);

        foreach ($osToRegister as $os) {
            $this->registerOs($os);
        }
    }

    public function registerOs(array $classNames)
    {
        foreach ($classNames as $className) {
            $os = new $className;

            if ($os->inUse()) {
                $this->os = $os;

                // The OS has been found, no need to iterate anymore
                break;
            }
        }
    }

    public function getOs()
    {
        return $this->os;
    }
}
