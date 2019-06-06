<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property int $id
 * @property int $question_id
 * @property string $type
 * @property string $text
 * @property string $right_answer
 *
 * @property Question $question
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id'], 'integer'],
            [['text'], 'string'],
            [['type', 'right_answer'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'type' => 'Type',
            'text' => 'Text',
            'right_answer' => 'Right Answer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }
}
