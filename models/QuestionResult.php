<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question_result".
 *
 * @property int $id
 * @property int $test_result_id
 * @property int $question_id
 * @property string $bttn_press
 * @property string $answer_right
 *
 * @property Question $question
 * @property TestResult $testResult
 */
class QuestionResult extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question_result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_result_id', 'question_id'], 'integer'],
            [['bttn_press'], 'safe'],
            [['answer_right'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['test_result_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestResult::className(), 'targetAttribute' => ['test_result_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_result_id' => 'Test Result ID',
            'question_id' => 'Question ID',
            'bttn_press' => 'Bttn Press',
            'answer_right' => 'Answer Right',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestResult()
    {
        return $this->hasOne(TestResult::className(), ['id' => 'test_result_id']);
    }
}
