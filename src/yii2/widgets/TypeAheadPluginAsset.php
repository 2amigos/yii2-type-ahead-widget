<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\yii2\widgets;

use yii\web\AssetBundle;

class TypeAheadPluginAsset extends AssetBundle
{
	public $sourcePath = '@vendor/twitter/typeahead.js/dist';

	public $js = [
		'typeahead.min.js',
	];

	public $depends = [
		'yii\bootstrap\BootstrapPluginAsset',
        'dosamigos\yii2\widgets\TypeAheadThemeAsset'
	];
}