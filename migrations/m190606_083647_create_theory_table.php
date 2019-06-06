<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%theory}}`.
 */
class m190606_083647_create_theory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%theory}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'text' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%theory}}');
    }
}
