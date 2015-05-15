<?php
/**
 * @link https://github.com/2amigos/yii2-type-ahead-widget
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace dosamigos\typeahead;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use Yii;

/**
 * TypeAhead renders a Twitter typeahead Bootstrap plugin.
 * @see http://twitter.github.io/typeahead.js/examples/
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\typeahead
 */
class TypeAhead extends InputWidget
{
    /**
     * @var array the options for the Bootstrap TypeAhead JS plugin.
     * Please refer to the Bootstrap TypeAhead plugin Web page for possible options.
     * @see https://github.com/twitter/typeahead.js#usage
     */
    public $clientOptions = [];
    /**
     * @var array the event handlers for the Bootstrap TypeAhead JS plugin.
     * Please refer to the Bootstrap TypeAhead plugin Web page for possible events.
     * @see https://github.com/twitter/typeahead.js/blob/master/doc/jquery_typeahead.md#custom-events
    */
    public $clientEvents = [];
    /**
     * @var array the datasets object arrays of the Bootstrap TypeAhead Js plugin.
     * @see https://github.com/twitter/typeahead.js/blob/master/doc/jquery_typeahead.md#datasets
     */
    public $dataSets = [];
    /**
     * @var array of [[Bloodhound]] instances. Please note, that the widget is just calling the object to return its
     * client script. In order to use its adapter, you will have to set it on the widget [[dataSets]] source option
     * and using the object instance as [[Bloodhound::getAdapter()]] method. This is required to be able to use multiple
     * datasets with bloodhound engine.
     * @see https://gist.github.com/jharding/9458772#file-remote-js
     */
    public $engines = [];

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput($this->name, $this->value, $this->options);
        }
        $this->registerClientScript();
    }

    /**
     * Registers Twitter TypeAhead Bootstrap plugin and the related events
     */
    protected function registerClientScript()
    {
        $view = $this->getView();

        TypeAheadPluginAsset::register($view);

        $id = $this->options['id'];

        $options = $this->clientOptions !== false && !empty($this->clientOptions)
            ? Json::encode($this->clientOptions)
            : 'null';

        foreach($this->dataSets as $dataSet) {
            if(empty($dataSet)) {
                continue;
            }
            $dataSets[] = Json::encode($dataSet);
        }

        $dataSets = !empty($dataSets)
            ? implode(", ", $dataSets)
            : '{}';

        foreach ($this->engines as $bloodhound) {
            if ($bloodhound instanceof Bloodhound) {
                $js[] = $bloodhound->getClientScript();
            }
        }

        $js[] = "jQuery('#$id').typeahead($options, $dataSets);";

        foreach ($this->clientEvents as $eventName => $handler) {
            $js[] = "jQuery('#$id').on('$eventName', $handler);";
        }

        $view->registerJs(implode("\n", $js));
    }
}
