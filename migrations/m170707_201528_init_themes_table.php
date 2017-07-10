<?php

use yii\db\Migration;

class m170707_201528_init_themes_table extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'themes',
            [
                'theme_id' => $this->primaryKey(11)->notNull(),
                'theme_title' => $this->string(255)->notNull()
            ],
            'ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci'
        );
        $this->addForeignKey(
            'theme_idFK',
            'news',
            'theme_id',
            'themes',
            'theme_id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        echo "m170707_201528_init_themes_table cannot be reverted.\n";

        return false;
    }
}
