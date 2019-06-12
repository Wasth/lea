<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%question_result}}`.
 */
class m190612_225702_create_question_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%question_result}}', [
            'id' => $this->primaryKey(),
            'test_result_id' => $this->integer(),
            'question_id' => $this->integer(),
            'bttn_press' => $this->timestamp(),
            'answer_right' => $this->string(),
        ]);


        $this->addForeignKey('fk-question_result-test_result_id-test_result-id',
            'question_result','test_result_id',
            'test_result','id');

        $this->addForeignKey('fk-question_result-question_id-question-id',
            'question_result','question_id',
            'question','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%question_result}}');
    }
}
