<?php
/**
 * @package     Cronfig Mautic Bundle
 * @copyright   2016 Cronfig.io. All rights reserved
 * @author      Jan Linhart
 * @link        http://cronfig.io
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Cronfig\Sysinfo;

/**
 * Class Mac
 */
class Mac extends AbstractOs implements OsInterface
{
    /**
     * Checks whether the current OS is equal to the current class
     *
     * @return bool
     */
    public function inUse()
    {
        return strtolower($this->getCurrentOsName()) === 'darwin';
    }

    /**
     * Counts CPU cores of the current system
     *
     * @return int
     */
    public function getCoreCount()
    {
        $this->requiredFunction('shell_exec');

        return (int) trim(shell_exec('sysctl -n hw.ncpu'));
    }
}
