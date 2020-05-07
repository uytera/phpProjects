<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "weather".
 *
 * @property int $id
 * @property string|null $time
 * @property string|null $city
 * @property string|null $temp
 * @property string|null $wind
 */
class Weather extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weather';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time', 'city', 'temp', 'wind'], 'string', 'max' => 255],
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
            'city' => 'City',
            'temp' => 'Temp',
            'wind' => 'Wind',
        ];
    }

    public static function GetCityWeatherList($city){
        return self::findAll([
            'city' => $city,
        ]);
    }

    public static function AddWeather($city, $temp, $wind){
        $currentW = new Weather();
        $currentW->id = null;
        $currentW->time = date("l dS of F Y h:I:s A");
        $currentW->city = $city;
        $currentW->temp = $temp;
        $currentW->wind = $wind;
        $currentW->save(false);
    }
}
