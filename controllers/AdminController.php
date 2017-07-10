<?php

namespace app\controllers;

use app\models\News;
use app\models\Themes;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class AdminController extends Controller
{
    public function actionAdmin()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_ASC,
                ]
            ],
        ]);

        return $this->render('admin', ['dataProvider' => $dataProvider]);
    }

    public function actionEdit($id)
    {
        $news = News::findOne(['news_id' => $id]);
        if ($news->load(\Yii::$app->request->post()) && $news->validate()) {
            $news->save();
            return $this->redirect(['admin/admin']);
        } else {
            $themes = Themes::find()->all();
            $themes = ArrayHelper::map($themes, 'theme_id', 'theme_title');
            return $this->render('edit', [
                'news' => $news,
                'themes' => $themes
            ]);
        }
    }

    public function actionDelete($id)
    {
        News::deleteAll(['news_id' => $id]);
        return $this->redirect(['admin/admin']);
    }
}