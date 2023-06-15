<?php

use yii\db\Migration;

/**
 * Class m230614_082007_upload_file
 */
class m230614_082007_upload_file extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('files', [
            'id' => $this->primaryKey(),
            'fileName' => $this->string(),
            'path' => $this->string()->notNull(),
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
