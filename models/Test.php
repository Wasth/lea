<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string $name
 * @property int $time_limit
 * @property int $attempt_limit
 * @property int $user_id
 *
 * @property Question[] $questions
 * @property User $user
 * @property TestAccess[] $testAccesses
 */
class Test extends \yii\db\ActiveRecord/**/
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time_limit', 'attempt_limit', 'user_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            ['name', 'required'],
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
            'name' => 'Название теста',
            'time_limit' => 'Ограничение по времени в сек.(пустое если неограничено)',
            'attempt_limit' => 'Попыток для одного ученика(пустое если неограничено)',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['test_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestAccesses()
    {
        return $this->hasMany(TestAccess::className(), ['test_id' => 'id']);
    }

    public function attachTeacher($id){
        if(!Yii::$app->user->isGuest) {
            if($this->user_id == Yii::$app->user->identity->id) {
                $relationship = new TestAccess();
                $relationship->test_id = $this->id;
                $relationship->user_id = $id;
                $relationship->save();
            }
        }
    }
}
