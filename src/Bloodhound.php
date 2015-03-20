<?php
/**
 * @link https://github.com/2amigos/yii2-type-ahead-widget
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace dosamigos\typeahead;

use yii\base\InvalidConfigException;
use yii\base\Object;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * Bloodhound is a helper class to configure Bloodhound suggestion engines.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\typeahead
 */
class Bloodhound extends Object
{
    /**
     * @var string the engine js name
     */
    public $name;
    /**
     * @var array the configuration of Bloodhound suggestion engine.
     * @see https://github.com/twitter/typeahead.js/blob/master/doc/bloodhound.md#options
     */
    public $clientOptions = [];

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if ($this->name === null) {
            throw new InvalidConfigException("'name' cannot be null.");
        }
        parent::init();
    }

    /**
     * Returns the engine adapter. To be used to configure [[TypeAhead::dataSets]] `source` option.
     * @return JsExpression
     */
    public function getAdapterScript()
    {
        return new JsExpression("{$this->name}.ttAdapter()");
    }

    /**
     * Returns the javascript initialization code
     * @return string
     */
    public function getClientScript()
    {
        $options = $this->clientOptions !== false && !empty($this->clientOptions)
            ? Json::encode($this->clientOptions)
            : '{}';

        return "var {$this->name} = new Bloodhound($options);\n{$this->name}.initialize();";
    }
}
