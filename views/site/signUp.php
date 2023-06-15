<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var yii\web\View $this */
$this->title = 'Sign Up';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstName')->textInput() ?>

    <?= $form->field($model, 'lastName')->textInput() ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>