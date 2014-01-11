TypeAhead Widget for Yii2
==============================

Renders a [Twitter Typeahead.js Bootstrap plugin](https://github.com/twitter/typeahead.js) widget.

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require 2amigos/yii2-type-ahead-widget "1.0.*"
```
or add

```json
"2amigos/yii2-type-ahead-widget" : "1.0.*"
```

to the require section of your application's `composer.json` file.

Theming
-------
[Twitter Typeahead.js Bootstrap plugin](https://github.com/twitter/typeahead.js) does not style the dropdown nor the hint or the input-field. It does it this way in order for you to customize it so it suits your application.

We have included a stylesheet with hints to match `form-control` bootstrap classes and other tweaks so you can easily identify the classes and style it. 

Usage
-----
Using a model and a `remote` configuration:

```
use dosamigos\yii2\widgets\TypeAhead;

<?=TypeAhead::widget([
    'model' => $model,
    'attribute' => 'country',
    'options' => ['class' => 'form-control', 'placeholder' => 'Enter country'],
    'clientOptions' => [
    	'name' => 'countries', // datum identifier
    	'remote' => [
    	   'url' => yii\helpers\Html::url(['country/autocomplete', 'q'=>'-QUERY-']),
    	   'widlcard' => '-QUERY-'
    	]
    ]
]);?>
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

	public $clientIdGetParamName = 'q';

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

Further Information
-------------------
Please, check the [typeahead.js plugin](https://github.com/twitter/typeahead.js) documentation for further information about its configuration options.


> [![2amigOS!](http://www.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0.png)](http://www.2amigos.us)  
<i>web development has never been so fun</i>  
[www.2amigos.us](http://www.2amigos.us)