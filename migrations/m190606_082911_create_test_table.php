<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test}}`.
 */
class m190606_082911_create_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'time_limit' => $this->integer(),
            'attempt_limit' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey('fk-test-user_id-user-id',
            'test', 'user_id',
            'user','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test}}');
    }
}
