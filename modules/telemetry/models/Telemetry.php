<?php

namespace app\modules\telemetry\models;

/**
 * This is the model class for table "telemetry".
 * @property int $id
 * @property string|null $time
 * @property string|null $telemetry
 */
class Telemetry extends \yii\db\ActiveRecord
{
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

    public static function AddTelemetry($telemetry){
        $currentW = new Telemetry();
        $currentW->id = null;
        $currentW->time = date("l dS of F Y h:I:s A");
        $currentW->telemetry = $telemetry;
        $currentW->save(false);
    }
}
