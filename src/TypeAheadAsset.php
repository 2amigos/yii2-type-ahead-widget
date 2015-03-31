<?php
/**
 * @link https://github.com/2amigos/yii2-type-ahead-widget
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace dosamigos\typeahead;

use yii\web\AssetBundle;

/**
 * TypeAheadAsset
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
class TypeAheadAsset extends AssetBundle
{
    public $sourcePath = '@vendor/2amigos/yii2-type-ahead-widget/src/assets';
    public $css = [
        'css/bootstrap-typeahead.css',
    ];
}
