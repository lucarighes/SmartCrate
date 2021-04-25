<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "crates".
 *
 * @property int $id
 * @property int $id_company
 * @property string $content
 *
 * @property Companies $company
 * @property Values[] $values
 */
class Crates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'crates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_company', 'content'], 'required'],
            [['id_company'], 'integer'],
            [['content'], 'string'],
            [['id_company'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['id_company' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Crate ID',
            'id_company' => 'Company',
            'content' => 'Content',
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

    public function getCompanies()
    {
        return $this->hasMany(Companies::className(), ['id' => 'id_company']);
    }

    /**
     * Gets query for [[Values]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(Values::className(), ['id_crate' => 'id']);
    }

}
