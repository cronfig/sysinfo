<?php

/**
 * @package     Cronfig Sysinfo Library
 * @link        https://github.com/cronfig/sysinfo
 * @license     http://opensource.org/licenses/MIT
 */

namespace CronfigTest\Sysinfo;

use Cronfig\Sysinfo\Linux;

class LinuxTest extends \PHPUnit\Framework\TestCase
{
    public function testInUseTrue()
    {
        $os = $this->getMockBuilder(Linux::class)
            ->setMethods(['getCurrentOsName'])
            ->getMock();

        $os->expects($this->once())
            ->method('getCurrentOsName')
            ->will($this->returnValue('Linux'));

        $result = $os->inUse();

        $this->assertTrue($result);
    }
}
