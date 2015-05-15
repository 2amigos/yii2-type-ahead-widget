# Bootstrap TypeAhead Widget for Yii2

[![Latest Version](https://img.shields.io/github/tag/2amigos/yii2-type-ahead-widget.svg?style=flat-square&label=release)](https://github.com/2amigos/yii2-type-ahead-widget/tags)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/2amigos/yii2-type-ahead-widget/master.svg?style=flat-square)](https://travis-ci.org/2amigos/yii2-type-ahead-widget)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/2amigos/yii2-type-ahead-widget.svg?style=flat-square)](https://scrutinizer-ci.com/g/2amigos/yii2-type-ahead-widget/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/2amigos/yii2-type-ahead-widget.svg?style=flat-square)](https://scrutinizer-ci.com/g/2amigos/yii2-type-ahead-widget)
[![Total Downloads](https://img.shields.io/packagist/dt/2amigos/yii2-type-ahead-widget.svg?style=flat-square)](https://packagist.org/packages/2amigos/yii2-type-ahead-widget)

Renders a [Twitter Typeahead.js Bootstrap plugin](https://github.com/twitter/typeahead.js) widget.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ composer require 2amigos/yii2-type-ahead-widget:~1.0
```

or add

```
"2amigos/yii2-type-ahead-widget": "~1.0"
```

to the `require` section of your `composer.json` file.

## Usage

Using a model and a `remote` configuration:

```
use dosamigos\typeahead\Bloodhound;
use dosamigos\typeahead\TypeAhead;
use yii\helpers\Url;

<?php
    $engine = new Bloodhound([
        'name' => 'countriesEngine',
        'clientOptions' => [
            'datumTokenizer' => new \yii\web\JsExpression("Bloodhound.tokenizers.obj.whitespace('name')"),
            'queryTokenizer' => new \yii\web\JsExpression("Bloodhound.tokenizers.whitespace"),
            'remote' => [
                'url' => Url::to(['country/autocomplete', 'query'=>'QRY']),
                'wildcard' => 'QRY'
            ]
        ]
    ]);
?>
<?= $form->field($model, 'country')->widget(
    TypeAhead::className(),
    [
        'options' => ['class' => 'form-control'],
        'engines' => [ $engine ],
        'clientOptions' => [
            'highlight' => true,
            'minLength' => 3
        ],
        'clientEvents' => [
            'typeahead:selected' => 'function () { console.log(\'event "selected" occured.\'); }'
        ],
        'dataSets' => [
            [
                'name' => 'countries',
                'displayKey' => 'value',
                'source' => $engine->getAdapterScript()
            ]
        ]
    ]
);?>
```
Note the use of the custom `wildcard`. It is required as if we use `typeahead.js` default's wildcard (`%QUERY`), Yii2 will automatically URL encode it thus making the wrong configuration for token replacement.

The results need to be JSON encoded as specified on the [plugin documentation](https://github.com/twitter/typeahead.js#datum). The following is an example of a custom `Action` class that you could plug to any `Controller`:

```
namespace frontend\controllers\actions;

use yii\base\Action;
use yii\helpers\Json;
use yii\base\InvalidConfigException;

class AutocompleteAction extends Action
{
	public $tableName;

	public $field;

	public $clientIdGetParamName = 'query';

	public $searchPrefix = '';

	public $searchSuffix = '%';

	public function init()
	{
		if($this->tableName === null) {
			throw new  InvalidConfigException(get_class($this) . '::$tableName must be defined.');
		}
		if($this->field === null) {
			throw new  InvalidConfigException(get_class($this) . '::$field must be defined.');
		}
		parent::init();
	}

	public function run()
	{
		$value = $this->searchPrefix . $_GET[$this->clientIdGetParamName] . $this->searchSuffix;
		$rows = \Yii::$app->db
			->createCommand("SELECT {$this->field} AS value FROM {$this->tableName} WHERE {$this->field} LIKE :field ORDER BY {$this->field}")
			->bindValues([':field' => $value])
			->queryAll();

		echo Json::encode($rows);
	}
}
```
And how to configure it on your `Controller` class:

```
public function actions()
{
	return [
		'autocomplete' => [
			'class' => 'frontend\controllers\actions\AutocompleteAction',
			'tableName' => Country::tableName(),
			'field' => 'name'
		]
	];
}
```

## Theming

[Twitter Typeahead.js Bootstrap plugin](https://github.com/twitter/typeahead.js) does not style the dropdown nor the hint or the input-field. It does it this way in order for you to customize it so it suits your application.

We have included a stylesheet with hints to match `form-control` bootstrap classes and other tweaks so you can easily identify the classes and style it.

## Testing

```bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Antonio Ramirez](https://github.com/tonydspaniard)
- [Alexander Kochetov](https://github.com/creocoder)
- [All Contributors](https://github.com/2amigos/yii2-selectize-widget/graphs/contributors)

## License

The BSD License (BSD). Please see [License File](LICENSE.md) for more information.

<blockquote>
    <a href="http://www.2amigos.us"><img src="http://www.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0.png"></a><br>
    <i>web development has never been so fun</i><br>
    <a href="http://www.2amigos.us">www.2amigos.us</a>
</blockquote>
