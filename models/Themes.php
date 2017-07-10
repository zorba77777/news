<?php

namespace app\models;

use yii\db\ActiveRecord;

class Themes extends ActiveRecord
{

    public static function tableName()
    {
        return 'themes';
    }

    public function rules()
    {
        return [
            [['theme_title'], 'safe']
        ];
    }

    public function getNews()
    {
        return $this->hasMany(News::className(), ['theme_id' => 'theme_id']);
    }
}