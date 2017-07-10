<?php

use yii\db\Migration;

class m170707_194147_init_news_table extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'news',
            [
                'news_id' => $this->primaryKey(11)->notNull(),
                'date' => $this->date(),
                'theme_id' => $this->integer(),
                'text' => $this->text(),
                'title' => $this->string(255)
            ],
            'ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci'
        );
    }

    public function safeDown()
    {
        echo "m170707_194147_init_news_table cannot be reverted.\n";

        return false;
    }
}
