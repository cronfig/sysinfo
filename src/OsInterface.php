<?php
/**
 * @package     Cronfig Sysinfo Library
 * @link        https://github.com/cronfig/sysinfo
 * @license     http://opensource.org/licenses/MIT
 */

namespace Cronfig\Sysinfo;

/**
 * Interface OsInterface
 */
interface OsInterface
{
    /**
     * Checks whether the current OS is equal to the current class
     *
     * @return bool
     */
    public function inUse();

    /**
     * Returns the amount of memory allocated to PHP
     *
     * @return int in bytes
     */
    public function getCurrentMemoryUsage();

    /**
     *  Returns the peak of memory allocated by PHP
     *
     * @return int in bytes
     */
    public function getPeakMemoryUsage();

    public function getMemoryLimit();

    public function getCurrentMemoryUsageInPercent();

    public function getPeakMemoryUsageInPercent();

    public function getLoadInPercent($timeframe, $round = 2);

    public function getLoad($timeframe);

    /**
     * Counts CPU cores of the current system
     *
     * @return int
     */
    public function getCoreCount();

    public function getPercentage($current, $limit, $round = 2);

    /**
     * Converts shorthand memory notation value to bytes
     *
     * @param string $val Memory size shorthand notation string
     *
     * @return int in bytes
     */
    public function getBytesFromPhpIniValue($val);

    /**
     * Throws an exception if the function does not exist or is disabled
     *
     * @param string $name of the required function
     *
     * @return self
     */
    public function requiredFunction($name);

    /**
     * Check if the function is disabled in php.ini
     *
     * @param string $name
     *
     * @return bool
     */
    public function isFunctionDisabled($name);
}
