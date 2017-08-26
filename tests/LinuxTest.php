<?php

/**
 * @package     Cronfig Sysinfo Library
 * @link        https://github.com/cronfig/sysinfo
 * @license     http://opensource.org/licenses/MIT
 */

namespace CronfigTest\Sysinfo;

use Cronfig\Sysinfo\Linux;

class LinuxTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMemoryInfo()
    {
        $os = new Linux;
        $info = $os->getMemoryInfo();
        echo "<pre>";var_dump($info);die("</pre>");
    }
}
