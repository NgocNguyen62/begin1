<?php
use yii\bootstrap5\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-page">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Begin</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 mb-3">
                <h2>Upload File</h2>

                <p>
                    <?= Html::a('Upload', ['upload'], ['class' => 'btn btn-success']) ?>
                </p>
            </div>
            <div class="col-lg-4 mb-3">
                <h2>Country</h2>
                <p>
                    <?= Html::a('View', ['country/'], ['class' => 'btn btn-success']) ?>
                </p>
            </div>
            <?= Html::a('View', ['files/'])?>
            <div>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'label' => 'Image',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::img($model, ['width' => '100']);
                        },
                    ],
                    'basename',
                ],
                ]); ?>
            </div>
            
        </div>

    </div>
</div>
