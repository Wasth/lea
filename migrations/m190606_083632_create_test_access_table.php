<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_access}}`.
 */
class m190606_083632_create_test_access_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test_access}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'test_id' => $this->integer(),
        ]);

        $this->addForeignKey('test_access-user_id-user-id',
            'test_access','user_id',
            'user','id');

        $this->addForeignKey('test_access-test_id-test-id',
            'test_access','test_id',
            'test','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test_access}}');
    }
}
