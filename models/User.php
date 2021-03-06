<?php

namespace app\models;

use Yii;
use app\components\ArrayForForm;
use yii\web\UploadedFile;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
	
    public $password_new;
    public $password_repeat;
    public $image_file;
    public $signup_error;
	
	public static function tableName()
    {
        return 'userdata';
    }
	
	public function rules()
    {
        return [
			[['isadmin'], 'integer'],			
            [['authkey', 'accesstoken', 'userpic', 'password', 'password_new', 'password_repeat', 'fname', 'lname', 'mname'], 'string'],
            [['username'], 'email'],
            [['username'], 'required'],            
			[['image_file'], 'file', 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }
	
	public function attributeLabels()
    {
        return [
            'id' => Yii::t('app\admin', 'ID'),
			'isadmin' => Yii::t('app\admin', 'Is Administrator'),            
            'username' => Yii::t('app\admin', 'Email'),
            'password' => Yii::t('app\admin', 'Password'),
			'password_new' => Yii::t('app\admin', 'New Password'),
			'authkey' => Yii::t('app\admin', 'Auth Key'),
            'userpic' => Yii::t('app\admin', 'Userpic'),
            'fname' => Yii::t('app\admin', 'First Name'),
            'mname' => Yii::t('app\admin', 'Middle Name'),
            'lname' => Yii::t('app\admin', 'Last Name'),
			'image_file' => Yii::t('app\admin', 'Download Image'),
        ];
    }
	
	public static function getUsers(){
        
        return ArrayForForm::getDropDownArray(User::find()->all(), 'username', Yii::t('app\admin', 'No User Selected'));				
	}
    
    public static function getUsersData(){
        
        return ArrayForForm::getDropDownArray(User::find()->all(), ['fname', 'mname', 'lname']);				
    }

    public static function getUploadDir()
    {
        return 'uploads/userpic/';
    }

    public static function getDefaultImage()
    {        
        return '/web/uploads/userpic/default.png';
    }    

    public function getUserpic()
    {
        if (isset($this->userpic))
        {
            return '/web/uploads/userpic/'.$this->userpic;
        }
        
        return false;
    }    
    
	public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
		{            
			if ($this->getIsNewRecord())
			{
				$this->authkey = \Yii::$app->security->generateRandomString();
				$this->accesstoken = \Yii::$app->security->generateRandomString();
			}
			$this->savePassword($insert);
			$this->uploadUserpic();
            
            return true;
        }
        
        return false;       
    }
	
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
		$user_data = User::find()->where(['id' => $id])->one();
		return $user_data ? $user_data : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {        
		$user_data = User::find()->where(['accesstoken' => $accesstoken])->one();
		return $user_data ? $user_data : null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user_data = User::find()->where(['username' => $username])->one();
		return $user_data ? $user_data : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authkey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authkey)
    {
        return $this->authkey === $authkey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function signup(){
        if (self::find()->where(['username' => $this->username])->one()){            
            $this->signup_error = '1.1';
        }
        elseif ($this->password_new != $this->password_repeat){
            $this->signup_error = '1.2';
        }
        elseif (strlen($this->password_new)){            

            return $this->save();
        }

        return false;
    }
	
	protected function savePassword($insert){		        
        if (strlen($this->password_new) && $this->password_new == $this->password_repeat){			
            
            return $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password_new);
        }
        
        return false;
	}
	
	protected function uploadUserpic(){
        if ($this->image_file = UploadedFile::getInstance($this, 'image_file'))
        {
            $fileName = uniqid('user_');
			$fullFileName = self::getUploadDir().$fileName.'.'.$this->image_file->extension;
			$this->image_file->saveAs($fullFileName);
            $this->userpic = $fileName.'.'.$this->image_file->extension;
            
            return true;
        }
        
        return false;
    }

    public function getFullName($patronymic = true){        
        
        return $patronymic 
            ? $this->lname.' '.$this->fname.' '.$this->mname 
            : $this->fname.' '.$this->mname.' '.$this->lname;
    }

    public function getShortName($patronymic = true){        
        
        return $patronymic 
            ? $this->lname.' '.$this->fname 
            : $this->fname.' '.$this->lname;
    }
}
