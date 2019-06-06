<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property int $test_id
 * @property int $theory_id
 * @property string $text
 * @property int $question_score
 *
 * @property Answer[] $answers
 * @property Test $test
 * @property Theory $theory
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id', 'theory_id', 'question_score'], 'integer'],
            [['text'], 'string'],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
            [['theory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Theory::className(), 'targetAttribute' => ['theory_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Test ID',
            'theory_id' => 'Theory ID',
            'text' => 'Text',
            'question_score' => 'Question Score',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTheory()
    {
        return $this->hasOne(Theory::className(), ['id' => 'theory_id']);
    }
}
