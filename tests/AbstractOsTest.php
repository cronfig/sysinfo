<?php

/*
 * @package     Cronfig Mautic Bundle
 * @copyright   2016 Cronfig.io. All rights reserved
 * @author      Jan Linhart
 * @link        http://cronfig.io
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
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
