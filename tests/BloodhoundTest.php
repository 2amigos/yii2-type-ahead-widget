<?php
/**
 * @link https://github.com/2amigos/ii2-type-ahead-widget
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace tests;

use dosamigos\typeahead\Bloodhound;
use yii\helpers\Json;

/**
 * BloodhoundTest
 */
class BloodhoundTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAdapterScript()
    {
        $actual = Json::encode((new Bloodhound(['name' => 'test']))->getAdapterScript());
        $this->assertEquals('test.ttAdapter()', $actual);
    }

    public function testGetClientScript()
    {
        $actual = (new Bloodhound(['name' => 'test']))->getClientScript();
        $this->assertEquals("var test = new Bloodhound({});\ntest.initialize();", $actual);
    }

    /**
     * @expectedException \yii\base\InvalidConfigException
     */
    public function testWidgetExceptionIsRaisedWhenNameIsNotSet()
    {
        new Bloodhound();
    }
}
