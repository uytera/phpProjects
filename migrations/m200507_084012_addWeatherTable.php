<?php

use yii\db\Migration;

/**
 * Class m200507_084012_addWeatherTable
 */
class m200507_084012_addWeatherTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('weather', [
            'id' => $this->primaryKey(),
            'time' => $this->string(),
            'city' => $this->string(),
            'temp' => $this->string(),
            'wind' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('weather');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200507_084012_addWeatherTable cannot be reverted.\n";

        return false;
    }
    */
}
