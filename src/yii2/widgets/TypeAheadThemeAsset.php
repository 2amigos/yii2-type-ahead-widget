<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\yii2\widgets;

use yii\web\AssetBundle;

class TypeAheadThemeAsset extends AssetBundle
{
	public $css = [
		'css/bootstrap-typeahead.css'
	];

    public function init()
    {
        $this->sourcePath = dirname(__FILE__) . '/assets';
        parent::init();
    }
}