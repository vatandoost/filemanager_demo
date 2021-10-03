<?php

use vatandoost\filemanager\libs\FileHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'text:raw',
            [
                'attribute' => 'background',
                'value' => Html::a(
                    Html::img(FileHelper::getFileUrl($model->background_image_id, true), ['width' => 200]),
                    $model->getBackground(),
                    [
                        'target' => '_blank'
                    ]
                ),
                'format' => 'raw'
            ],
            [
                'attribute' => 'files_str',
                'value' => function ($model) {
                    if (empty($model->files_str)) {
                        return '';
                    }
                    $file_ids = json_decode($model->files_str, true);
                    $imgs = '';
                    foreach ($file_ids as $id) {
                        $imgs .= Html::img(FileHelper::getFileUrl($id, true), ['width' => 200]);
                    }
                    return $imgs;
                },
                'format' => 'raw'
            ]
        ],
    ]) ?>

</div>