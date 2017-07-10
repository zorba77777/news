<?php

namespace app\models;

use yii\db\ActiveRecord;


class News extends ActiveRecord
{

    public static function tableName()
    {
        return 'news';
    }

    public function rules()
    {
        return [
            [['date', 'theme_id', 'text', 'title'], 'safe']
        ];
    }

    public function getThemes()
    {
        return $this->hasOne(Themes::className(), ['theme_id' => 'theme_id']);
    }
}