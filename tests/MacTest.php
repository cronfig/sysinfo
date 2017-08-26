<?php

/*
 * @package     Cronfig Mautic Bundle
 * @copyright   2016 Cronfig.io. All rights reserved
 * @author      Jan Linhart
 * @link        http://cronfig.io
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace CronfigTest\Sysinfo;

use Cronfig\Sysinfo\Mac;

class MacTest extends \PHPUnit_Framework_TestCase
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
        $this->assertInternalType(\PHPUnit_Framework_Constraint_IsType::TYPE_INT, $result);
    }
}
