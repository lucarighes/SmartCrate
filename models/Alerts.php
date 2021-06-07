<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alerts".
 *
 * @property int $id
 * @property int $id_values
 * @property string $severity
 * @property string $domain
 * @property string $note
 */
class Alerts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alerts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_values', 'severity', 'domain', 'note'], 'required'],
            [['id_values'], 'integer'],
            [['severity', 'domain', 'note'], 'string'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_values' => Yii::t('app', 'Id Values'),
            'severity' => Yii::t('app', 'Severity'),
            'domain' => Yii::t('app', 'Domain'),
            'note' => Yii::t('app', 'Note'),
            'date' => Yii::t('app', 'Date'),
        ];
    }
}
