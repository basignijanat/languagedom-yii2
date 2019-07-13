<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Sign up';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="hero is-medium">  
    <div class="hero-body">
        <h1 class="title">
            <?= Html::encode($this->title) ?>
        </h1>
        <h2 class="subtitle">
            Please fill out the following fields to sign up:
        </h2>
        <div class="column is-half">            
            <?= Html::beginForm(null, 'post', ['class' => 'field control']) ?>
                <div class="field control">                                    
                    <?= Html::activeInput('text', $model, 'username', [
                        'class' => 'input is-primary', 
                        'placeholder' => 'Email',
                        'required' => true,
                    ]) ?>                                                        
                </div>
                <div class="field control">                
                    <?= Html::activeInput('password', $model, 'password', [
                        'class' => 'input is-primary', 
                        'placeholder' => 'Password',
                        'required' => true,
                    ]) ?>
                </div>
                <div class="field control">                
                    <?= Html::activeInput('password', $model, 'password_repeat', [
                        'class' => 'input is-primary', 
                        'placeholder' => 'Repeat Password',
                        'required' => true,
                    ]) ?>
                </div>
                <hr>
                <div class="field control">                
                    <?= Html::activeInput('text', $model, 'fname', ['class' => 'input is-primary', 'placeholder' => 'First name']) ?>                
                </div>
                <div class="field control">                
                    <?= Html::activeInput('text', $model, 'mname', ['class' => 'input is-primary', 'placeholder' => 'Middle name']) ?>                
                </div>
                <div class="field control">                
                    <?= Html::activeInput('text', $model, 'lname', ['class' => 'input is-primary', 'placeholder' => 'Last name']) ?>                
                </div>
                <hr>
                <div class="field control file has-name is-info">                
                    <label class="file-label">
                        <?= Html::activeFileInput($model, 'image_file', [
                            'class' => 'file-input',
                            'accept' => 'image/jpeg,image/png'
                        ]) ?>                
                        <span class="file-cta">
                            <span class="file-label">
                                Choose a file
                            </span>
                        </span>
                        <span class="file-name" id="userpic-file-name"></span>
                    </label>                    
                </div>

                <div class="field control">
                    <?= Html::submitButton('Sign up', ['class' => 'button is-primary']) ?>
                </div>
            <?= Html::endForm() ?>
        </div>        
    </div>
  </div>
</section>