<?php

namespace app\models;

use Yii;

class FeedbackForm extends \yii\db\ActiveRecord
{
    public $hidden;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    public function setAttributes($values, $safeOnly = true)
    {
        parent::setAttributes($values, $safeOnly);

        $this->hidden = $values['hidden'];

    }


    public function rules()
    {
        return [
            // phone, email, comment are required
            [['email', 'comment', 'phone'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            [['name'], 'string'],
            [['phone'], 'integer'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'comment' => 'Comment',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject('Feedback Form')
                ->setTextBody($this->comment)
                ->send();

            return true;
        }
        return false;
    }
}