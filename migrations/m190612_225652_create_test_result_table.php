<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_result}}`.
 */
class m190612_225652_create_test_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test_result}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'test_id' => $this->integer(),
            'date_time_start' => $this->timestamp(),
            'date_time_finish' => $this->timestamp(),
        ]);

        $this->addForeignKey('fk-test_result-user_id-user-id',
            'test_result','user_id',
            'user','id');

        $this->addForeignKey('fk-test_result-test_id-test-id',
            'test_result','test_id',
            'test','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test_result}}');
    }
}
