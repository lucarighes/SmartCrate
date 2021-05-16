<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoices".
 *
 * @property int $id_invoice
 * @property string $date
 * @property int $customer
 * @property int $crate
 *
 * @property Crates $crate0
 * @property Users $customer0
 */
class Invoices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_invoice', 'customer', 'crate'], 'required'],
            [['id_invoice', 'customer', 'crate'], 'integer'],
            [['date'], 'safe'],
            [['id_invoice', 'crate'], 'unique', 'targetAttribute' => ['id_invoice', 'crate']],
            [['crate'], 'exist', 'skipOnError' => true, 'targetClass' => Crates::className(), 'targetAttribute' => ['crate' => 'id']],
            [['customer'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['customer' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_invoice' => Yii::t('app', 'Id Invoice'),
            'date' => Yii::t('app', 'Date'),
            'customer' => Yii::t('app', 'Customer'),
            'crate' => Yii::t('app', 'Crate'),
        ];
    }

    /**
     * Gets query for [[Crate0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCrate0()
    {
        return $this->hasOne(Crates::className(), ['id' => 'crate']);
    }

    /**
     * Gets query for [[Customer0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer0()
    {
        return $this->hasOne(Users::className(), ['id' => 'customer']);
    }
}
