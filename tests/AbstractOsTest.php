<?php

/**
 * @package     Cronfig Sysinfo Library
 * @link        https://github.com/cronfig/sysinfo
 * @license     http://opensource.org/licenses/MIT
 */

namespace CronfigTest\Sysinfo;

use Cronfig\Sysinfo\AbstractOs;

class AbstractOsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCurrentMemoryUsageInPercent()
    {
        $os = $this->getMockForAbstractClass(AbstractOs::class);
        $result = $os->getCurrentMemoryUsageInPercent();

        $this->assertInternalType(\PHPUnit_Framework_Constraint_IsType::TYPE_FLOAT, $result);
        $this->assertGreaterThan(0, $result);
        $this->assertLessThan(100, $result);
    }

    public function testGetCurrentMemoryInfo()
    {
        $os = $this->getMockForAbstractClass(AbstractOs::class);
        $result = $os->getCurrentMemoryUsage();

        $this->assertInternalType(\PHPUnit_Framework_Constraint_IsType::TYPE_INT, $result);
        $this->assertGreaterThan(0, $result);
    }

    public function testGetMemoryLimit()
    {
        $os = $this->getMockForAbstractClass(AbstractOs::class);
        $result = $os->getMemoryLimit();

        $this->assertInternalType(\PHPUnit_Framework_Constraint_IsType::TYPE_INT, $result);
        $this->assertGreaterThan(0, $result);
    }
}
