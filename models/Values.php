<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "values".
 *
 * @property int $id
 * @property int $id_crate
 * @property string $date
 * @property float $temperature
 * @property int $humidity
 * @property string $position
 * @property int $hydrogen
 * @property int $oxigen
 *
 * @property Crates $crate
 */
class Values extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'values';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_crate', 'temperature', 'humidity', 'position', 'hydrogen', 'oxigen'], 'required'],
            [['id_crate', 'humidity', 'hydrogen', 'oxigen'], 'integer'],
            [['date'], 'safe'],
            [['temperature'], 'number'],
            [['position'], 'string'],
            [['id_crate'], 'exist', 'skipOnError' => true, 'targetClass' => Crates::className(), 'targetAttribute' => ['id_crate' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_crate' => 'Id Crate',
            'date' => 'Date',
            'temperature' => 'Temperature',
            'humidity' => 'Humidity',
            'position' => 'Position',
            'hydrogen' => 'Hydrogen',
            'oxigen' => 'Oxigen',
        ];
    }

    /**
     * Gets query for [[Crate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCrate()
    {
        return $this->hasOne(Crates::className(), ['id' => 'id_crate']);
    }
}
