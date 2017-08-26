<?php
/**
 * @package     Cronfig Sysinfo Library
 * @link        https://github.com/cronfig/sysinfo
 * @license     http://opensource.org/licenses/MIT
 */

namespace Cronfig\Sysinfo;

/**
 * Abstract model of a general Operating System
 *
 * Class AbstractOs
 */
abstract class AbstractOs
{
    const TIMEFRAME_1_MIN = 0;
    const TIMEFRAME_5_MIN = 1;
    const TIMEFRAME_15_MIN = 2;

    /**
     * Returns the amount of memory allocated to PHP
     *
     * @return int in bytes
     */
    public function getCurrentMemoryUsage()
    {
        $this->requiredFunction('memory_get_usage');

        return memory_get_usage();
    }

    /**
     *  Returns the peak of memory allocated by PHP
     *
     * @return int in bytes
     */
    public function getPeakMemoryUsage()
    {
        $this->requiredFunction('memory_get_peak_usage');

        return memory_get_peak_usage();
    }

    public function getMemoryLimit()
    {
        return $this->getBytesFromPhpIniValue(ini_get('memory_limit'));
    }

    public function getExecutionTimeLimit()
    {
        return ini_get('max_execution_time');
    }

    public function getCurrentMemoryUsageInPercent()
    {
        return $this->getPercentage($this->getCurrentMemoryUsage(), $this->getMemoryLimit());
    }

    public function getPeakMemoryUsageInPercent()
    {
        return $this->getPercentage($this->getPeakMemoryUsage(), $this->getMemoryLimit());
    }

    public function getLoadInPercent($timeframe, $round = 2)
    {
        return round($this->getLoad($timeframe) / $this->getCoreCount() * 100, $round);
    }

    public function getLoad($timeframe)
    {
        $this->requiredFunction('sys_getloadavg');

        $possibleArguments = [self::TIMEFRAME_1_MIN, self::TIMEFRAME_5_MIN, self::TIMEFRAME_15_MIN];

        if (!in_array($timeframe, $possibleArguments)) {
            throw new \InvalidArgumentException;
        }

        return sys_getloadavg()[$timeframe];
    }

    public function getDiskUsagePercentage($round = 2)
    {
        $this->requiredFunction('disk_total_space')->requiredFunction('disk_free_space');

        $disktotal = disk_total_space('/');
        $diskfree  = disk_free_space('/');

        return round(100 - (($diskfree / $disktotal) * 100), $round);
    }

    /**
     * Counts CPU cores of the current system
     *
     * @return int
     */
    public function getCoreCount()
    {
        throw new \BadMethodCallException(__METHOD__.' must be implemented in a child class');
    }

    /**
     * Returns name of the current OS
     *
     * @return string
     */
    public function getCurrentOsName()
    {
        $this->requiredFunction('php_uname');
        return php_uname('s');
    }

    public function getTimeframeFromExecutionTime($executionTime)
    {
        $ETInMinutes = $executionTime / 60;

        switch ($ETInMinutes) {
            case $ETInMinutes > 10:
                $timeframe = self::TIMEFRAME_15_MIN;
                break;

            case $ETInMinutes > 4:
                $timeframe = self::TIMEFRAME_5_MIN;
                break;

            default:
                $timeframe = self::TIMEFRAME_1_MIN;
                break;
        }

        return $timeframe;
    }

    public function getPercentage($current, $limit, $round = 2)
    {
        if (!$limit) {
            return 0;
        }

        return round($current / $limit * 100, $round);
    }

    /**
     * Converts shorthand memory notation value to bytes
     *
     * @param string $val Memory size shorthand notation string
     *
     * @return int in bytes
     */
    public function getBytesFromPhpIniValue($val)
    {
        $val = trim($val);
        $last = strtolower($val[strlen($val) - 1]);

        switch ($last) {
            case 'g':
                $val *= 1024;
                break;
            case 'm':
                $val *= 1024;
                break;
            case 'k':
                $val *= 1024;
                break;
        }

        return $val;
    }

    /**
     * Throws an exception if the function does not exist or is disabled
     *
     * @param string $name of the required function
     *
     * @return self
     */
    public function requiredFunction($name)
    {
        if (!function_exists($name)) {
            throw new \BadFunctionCallException('Function '.$name.' does not exist.');
        }

        if ($this->isFunctionDisabled($name)) {
            throw new \BadFunctionCallException('Function '.$name.' is disabled in php.ini.');
        }

        return $this;
    }

    /**
     * Check if the function is disabled in php.ini
     *
     * @param string $name
     *
     * @return bool
     */
    public function isFunctionDisabled($name)
    {
        $disabled = explode(',', ini_get('disable_functions'));
        return in_array($name, $disabled);
    }
}
