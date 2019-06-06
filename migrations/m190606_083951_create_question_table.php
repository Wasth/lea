<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%question}}`.
 */
class m190606_083951_create_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%question}}', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer(),
            'theory_id' => $this->integer(),
            'text' => $this->text(),
            'question_score' => $this->integer(),
        ]);

        $this->addForeignKey('fk-question-theory_id-theory-id',
            'question','theory_id',
            'theory','id');

        $this->addForeignKey('fk-question-test_id-test-id',
            'question','test_id',
            'test','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%question}}');
    }
}
