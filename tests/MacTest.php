<?php

/**
 * @package     Cronfig Sysinfo Library
 * @link        https://github.com/cronfig/sysinfo
 * @license     http://opensource.org/licenses/MIT
 */

namespace CronfigTest\Sysinfo;

use Cronfig\Sysinfo\Mac;
use PHPUnit\Framework\Constraint\IsType;

class MacTest extends CommonTestCase
{
    public function testInUseTrue()
    {
        $os = $this->getMockBuilder(Mac::class)
            ->setMethods(['getCurrentOsName'])
            ->getMock();

        $os->expects($this->once())
            ->method('getCurrentOsName')
            ->will($this->returnValue('Darwin'));

        $result = $os->inUse();

        $this->assertTrue($result);
    }

    public function testInUseFalse()
    {
        $os = $this->getMockBuilder(Mac::class)
            ->setMethods(['getCurrentOsName'])
            ->getMock();

        $os->expects($this->once())
            ->method('getCurrentOsName')
            ->will($this->returnValue('Linux'));

        $result = $os->inUse();

        $this->assertFalse($result);
    }

    public function testGetCoreCount()
    {
        $os = new Mac;
        $result = $os->getCoreCount();

        $this->assertGreaterThan(1, $result);
        $this->assertInternalType(IsType::TYPE_INT, $result);
    }
}
