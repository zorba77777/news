<?php

/**
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<h1 style="text-align: center">Редактирование новостей</h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
        'date',
        'text',
        [
            'attribute' => 'theme_title',
            'label'=>'Theme',
            'format'=>'text',
            'content'=>function($data){
                return $data->themes->theme_title;
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'template' => '{view}{delete}',
            'buttons' => [
                'view' => function ($url, $data) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-edit"></span>',
                        Url::to(['/admin/edit', 'id' => $data['news_id']]),
                        ['title' => Yii::t('app', 'edit')]
                    );
                },

                'delete' => function ($url, $data) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-remove"></span>',
                        Url::to(['/admin/delete', 'id' => $data['news_id']]),
                        ['title' => Yii::t('app', 'delete')]
                    );
                }
            ],
        ],
    ],
]) ?>