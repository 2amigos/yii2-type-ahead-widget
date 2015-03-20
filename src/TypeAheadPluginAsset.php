<?php
/**
 * @link https://github.com/2amigos/yii2-type-ahead-widget
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace dosamigos\typeahead;

use yii\web\AssetBundle;

/**
 * TypeAheadPluginAsset
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
class TypeAheadPluginAsset extends AssetBundle
{
	public $sourcePath = '@vendor/twitter/typeahead.js/dist';

	public $depends = [
		'yii\bootstrap\BootstrapPluginAsset',
        	'dosamigos\typeahead\TypeAheadAsset'
	];

	public function init()
	{
		$this->js = YII_DEBUG ? ['typeahead.bundle.js'] : ['typeahead.bundle.min.js'];
		parent::init();
	}
}
