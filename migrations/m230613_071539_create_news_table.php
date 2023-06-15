<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m230613_071539_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'firstName' => $this->string(),
            'lastName' => $this->string(),
            'username' => $this->string()->notNull(),
            'password' => $this->string(),
            'authKey' => $this->char(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
