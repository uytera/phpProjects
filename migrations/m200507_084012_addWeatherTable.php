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
        $this->createTable('telemetry', [
            'id' => $this->primaryKey(),
            'time' => $this->string(),
            'telemetry' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('telemetry');
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
