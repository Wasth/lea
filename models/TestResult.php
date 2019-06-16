<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_result".
 *
 * @property int $id
 * @property int $user_id
 * @property int $test_id
 * @property string $date_time_start
 * @property string $date_time_finish
 *
 * @property QuestionResult[] $questionResults
 * @property Test $test
 * @property User $user
 */
class TestResult extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'test_id'], 'integer'],
            [['date_time_start', 'date_time_finish'], 'safe'],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'test_id' => 'Test ID',
            'date_time_start' => 'Date Time Start',
            'date_time_finish' => 'Date Time Finish',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionResults()
    {
        return $this->hasMany(QuestionResult::className(), ['test_result_id' => 'id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getResultData(){
        $test = Test::findOne($this->test_id);
        $max_score = $test->getMaxScore();

        $score = 0;
        foreach ($this->questionResults as $questionResult) {
            if($questionResult->question->answers[0]->right_answer == $questionResult->answer_right) {
                $score+=$questionResult->question->question_score;
            }
        }

        $pass_time = floor(($this->date_time_finish - $this->date_time_start) / 1000);

        return [
            'score' => $score,
            'max_score' => $max_score,
            'pass_time' => $pass_time,
            'test_name' => $test->name,
        ];
    }
}
