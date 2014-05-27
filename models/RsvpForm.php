<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RsvpForm is the model behind the contact form.
 */
class RsvpForm extends Model
{
    public $names;
    public $accepting_count;
    public $declining_count;
    public $email;
    public $message;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['names', 'email', 'accepting_count', 'declining_count', 'verifyCode'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // counts must be integers
            [['accepting_count', 'declining_count'], 'integer'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'names' => 'Name(s) of Guest(s)',
            'verifyCode' => 'Verification Code',
            'email' => 'Your Email',
            'accepting_count' => '# Accepts',
            'declining_count' => '# Declines',
            'message' => 'Any Message for Bryan and Sam'
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mail->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->names])
                ->setSubject($this->accepting_count . " more people have RSVPed!")
                ->setTextBody($this->message)
                ->send();

            return true;
        } else {
            return false;
        }
    }
}
