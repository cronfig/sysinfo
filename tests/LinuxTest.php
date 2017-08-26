<?php

/*
 * @package     Cronfig Mautic Bundle
 * @copyright   2016 Cronfig.io. All rights reserved
 * @author      Jan Linhart
 * @link        http://cronfig.io
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
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
