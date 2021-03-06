<?php

namespace app\models;

use Yii;
use app\components\ArrayForForm;
use yii\web\UploadedFile;

use app\models\Userlang;

/**
 * This is the model class for table "language".
 *
 * @property int $id
 * @property string $meta_title
 * @property string $meta_description
 * @property string $name
 * @property string $content
 */
class Language extends \yii\db\ActiveRecord
{
    //public $image_file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meta_description', 'content'], 'string'],
            [['meta_title', 'name', 'image', 'url'], 'string', 'max' => 255],
            [['userlang_id'], 'integer'],
            [['url'], 'unique'],
            //[['image_file'], 'file', 'extensions' => 'png, jpg'],
            //[['image_file'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app\admin', 'ID'),
            'meta_title' => Yii::t('app\admin', 'Meta Title'),
            'meta_description' => Yii::t('app\admin', 'Meta Description'),
            'name' => Yii::t('app\admin', 'Name'),
            'content' => Yii::t('app\admin', 'Content'),
            'userlang_id' => Yii::t('app\admin', 'User Language'),
            'url' => Yii::t('app\admin', 'URL'),
            'image' => Yii::t('app\admin', 'Image'),
            'image_file' => Yii::t('app\admin', 'Download Image'),
        ];
    }

    public static function getUploadDir(){
        
        return 'uploads/language/';
    }

    public static function getImageExt(){
        
        return '.png';
    }

    public static function getImagePrefix(){
        
        return 'language';
    }

    public function getImage(){
        
        return '/web/uploads/language/'.$this->image;
    }
    
    /*public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
		{			
			$this->uploadImage();
            
            return true;
        }
        
        return false;       
    }*/

	public static function getLanguages()
	{
		return ArrayForForm::getDropDownArray(Language::find()->all(), 'name', null);		
	}
	
	public static function getLanguageById($id)
	{
		return Language::find()->where(['id' => $id])->one();		
    }

    public static function getCurrentLanguages(){
        $userlang = Userlang::find()->where(['val' => Yii::$app->language])->one();        

		return Language::find()->where(['userlang_id' => $userlang->id])->all();		
    }
    
    protected function uploadImage(){
        if ($this->image_file = UploadedFile::getInstance($this, 'image_file'))
        {
            $fileName = uniqid('language_');
			$fullFileName = self::getUploadDir().$fileName.'.'.$this->image_file->extension;
            $this->image_file->saveAs($fullFileName);
            $this->image = $fileName.'.'.$this->image_file->extension;
            
            return true;
        }
        
        return false;
    }
}
