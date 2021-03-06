<?php

namespace app\models;

use Yii;

use app\models\Student;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $student_id
 * @property int $form_id
 * @property string $content
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'language_id'], 'integer'],
            [['content'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app\admin', 'ID'),
            'student_id' => Yii::t('app\admin', 'User'),
            'language_id' => Yii::t('app\admin', 'Language'),
            'content' => Yii::t('app\admin', 'Content'),
        ];
    }

    public static function getCommentsByLanguage($language_id){

        return self::find()->where(['language_id' => $language_id])->all();
    }

    public function getStudent(){

        return Student::find()->where(['id' => $this->student_id])->one();
    }

    public function getUser(){

        return $this->getStudent()->getUser();
    }
}
