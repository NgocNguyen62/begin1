<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin();

foreach ($settings as $id => $setting) {
    echo $form->field($setting, "[$id]value")->label($setting->name);
}

echo Html::submitButton('Save');

ActiveForm::end();