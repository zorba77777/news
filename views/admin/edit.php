<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var \app\models\news $news
 * @var array $themes
 */

$this->title = 'Редактировать новость';
?>

<div style="text-align: center">
    <h2>Редактировать новость</h2>

    <?php $form = ActiveForm::begin([
        'id' => 'news',
        'options' => ['class' => 'form-horizontal'],
    ]) ?>
    <label style="margin-right: 50px">ID
        <?= $form->field($news, 'news_id', ['addAriaAttributes' => false])->textInput([
            'readOnly' => true,
            'style' => 'width:10em'
        ])
            ->label('') ?>
    </label>
    <br/>
    <label style="margin-right: 50px">Дата <br/>
        <?= $form->field($news, 'date')->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['style' => 'width:10em']
        ])
            ->label('') ?>
    </label>
    <br/>
    <label style="margin-right: 50px">Тема
        <?= $form->field($news, 'theme_id', ['addAriaAttributes' => false])->dropDownList($themes, [
            'style' => 'width:10em'
        ])
            ->label('') ?>
    </label>
    <br/>
    <label style="margin-right: 50px">Текст
        <?= $form->field($news, 'text', ['addAriaAttributes' => false])->textarea([
            'style' => 'width:50em'
        ])
            ->label('') ?>
    </label>
    <br/>
    <label style="margin-right: 50px">Заголовок
        <?= $form->field($news, 'title', ['addAriaAttributes' => false])->textInput([
            'style' => 'width:10em'
        ])
            ->label('') ?>
    </label>
    <br/>

    <div>
        <?= Html::submitButton('Сохранить изменения', [
            'class' => 'btn btn-primary'
            ]) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>








