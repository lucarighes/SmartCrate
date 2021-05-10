<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $id_company
 * @property string|null $auth_key
 * @property int $owner
 *
 * @property Companies $company
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['id_company', 'owner'], 'integer'],
            [['username', 'password'], 'string', 'max' => 256],
            [['auth_key'], 'string', 'max' => 32],
            [['id_company'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['id_company' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'id_company' => 'Id Company',
            'auth_key' => 'Auth Key',
            'owner' => 'Owner',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::className(), ['id' => 'id_company']);
    }

    public function beforeSave($insert) {
        $this->password = sha1($this->password);
        return parent::beforeSave($insert);
    }
}
