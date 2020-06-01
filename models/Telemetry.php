<?php

namespace app\models;

/**
 * This is the model class for table "telemetry".
 * @property int $id
 * @property string|null $time
 * @property string|null $telemetry
 */
class Telemetry extends \yii\db\ActiveRecord
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->time = date("l dS of F Y h:I:s A");
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telemetry';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telemetry'], 'string', 'max' => 255],
        ];
        //$rows = $model::find()->all();
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'telemetry' => 'Telemetry',
        ];
    }
}
