<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::class, [
        'options' => ['rows' => 6],
        'preset' => 'basic',
        'clientOptions' => [
            'filebrowserBrowseUrl' => '/filemanager/dialog?unique_name=virtual&editor=ckeditor&multiple=0',
            'filebrowserImageBrowseUrl' => '/filemanager/dialog?unique_name=virtual&editor=ckeditor&multiple=0'
        ]
    ]) ?>

    <?= $form->field($model, 'background')->fileInput() ?>

    <?=
    $form->field($model, 'files_str')->widget(\vatandoost\filemanager\widgets\selector\Selector::class, [
        'fileTypeName' => 'virtual',
        'multiple' => true,
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = <<<JS
CKEDITOR.replace( 'Post[text]' ,{
	filebrowserBrowseUrl : 'filemanager/dialog?callback=filemanager_selector_callback&unique_name=virtual&multiple=0',
	filebrowserUploadUrl : 'filemanager/dialog?callback=filemanager_selector_callback&unique_name=virtual&multiple=0',
	filebrowserImageBrowseUrl : 'filemanager/dialog?callback=filemanager_selector_callback&unique_name=virtual&multiple=0'
});
JS;
//$this->registerJs($js);
