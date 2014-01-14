<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\widgets;

use yii\web\AssetBundle;

class TypeAheadAsset extends AssetBundle
{
	public $css = [
		'css/bootstrap-typeahead.css'
	];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}