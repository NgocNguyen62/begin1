<?php

use yii\db\Migration;

/**
 * Class m230613_074327_update_table
 */
class m230613_074327_update_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $this->insert('users', [
                'firstName' => 'Nguyen',
                'lastName' => 'Ngoc',
                'username' => 'ngoc',
                'password' => 'ngoc123',
                'authKey' => 'c',
            ]);
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230613_074327_update_table cannot be reverted.\n";

        return false;
    }
    */
}
