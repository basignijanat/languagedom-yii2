<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "setting".
 *
 * @property int $id
 * @property string $name
 * @property string $value
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            [['name', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app\admin', 'ID'),
            'name' => Yii::t('app\admin', 'Name'),
            'value' => Yii::t('app\admin', 'Value'),
        ];
    }

    public static function getSettingValue($name){

        return self::find()->where(['name' => $name])->one()['value'];
    }

    public static function getSettingValues($names = false){
        if ($names){

            return ArrayHelper::map(self::find()->where(['name' => $names])->all(), 'name', 'value');
        }
        else{
            
            return ArrayHelper::map(self::find()->all(), 'name', 'value');
        }
    }
}
