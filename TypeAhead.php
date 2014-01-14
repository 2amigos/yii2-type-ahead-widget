<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\widgets;

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
 * @package common\extensions\dosamigos\yii2\widgets
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
	 * @inheritdoc
	 */
	public function run()
	{
		if ($this->hasModel()) {
			echo Html::activeTextInput($this->model, $this->attribute, $this->options);
		} else {
			echo Html::textInput($this->name, $this->value, $this->options);
		}
		$this->registerPlugin();
	}

	/**
	 * Registers Twitter TypeAhead Bootstrap plugin and the related events
	 */
	protected function registerPlugin()
	{
		$view = $this->getView();

		TypeAheadPluginAsset::register($view);

		$id = $this->options['id'];

		$options = $this->clientOptions !== false && !empty($this->clientOptions)
			? Json::encode($this->clientOptions)
			: '';

		$js = "jQuery('#$id').typeahead($options);";
		$view->registerJs($js);
	}
}