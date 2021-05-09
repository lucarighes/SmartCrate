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
    const SCENARIO_CREATE = 'create';

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
           // [['id_crate', 'temperature', 'humidity', 'latitude', 'longitude', 'hydrogen', 'oxigen'], 'required'],
            [['temperature, humidity'], 'required'],
            [['id_crate', 'humidity', 'hydrogen', 'oxigen'], 'integer'],
            [['date'], 'safe'],
            [['temperature'], 'number'],
            [['longitude', 'latitude'], 'double'],
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
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'hydrogen' => 'Hydrogen',
            'oxigen' => 'Oxigen',
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['id_crate','date','temperature', 'humidity', 'longitude', 'latitude', 'hydrogen', 'oxigen']; 
        return $scenarios; 
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
