<?php

use dosamigos\typeahead\Bloodhound;
use dosamigos\typeahead\TypeAhead;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model tests\models\Model */
?>

<?= TypeAhead::widget([
    'model' => $model,
    'attribute' => 'test',
]) ?>

<?= TypeAhead::widget([
    'name' => 'test',
]) ?>

<?= TypeAhead::widget([
    'name' => 'test',
    'engines' => [
        new Bloodhound(['name' => 'test']),
    ],
    'dataSets' => [
        'foo' => 'bar',
        [],
    ],
    'clientEvents' => [
        'test' => new JsExpression('function () { }'),
    ],
]) ?>
