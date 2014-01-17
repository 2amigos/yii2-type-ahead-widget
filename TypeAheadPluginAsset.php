<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\typeahead;

use yii\web\AssetBundle;

class TypeAheadPluginAsset extends AssetBundle
{
	public $sourcePath = '@vendor/twitter/typeahead.js/dist';

	public $depends = [
		'yii\bootstrap\BootstrapPluginAsset',
        'dosamigos\widgets\TypeAheadAsset'
	];

	public function init()
	{
		$this->js = YII_DEBUG ? ['typeahead.js'] : ['typeahead.min.js'];
		parent::init();
	}
}