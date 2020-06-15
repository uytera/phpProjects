<?php

use yii\db\Migration;

/**
 * Class m200615_080141_addBannedColToUsers
 */
class m200615_080141_addBannedColToUsers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'banned', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'banned');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200615_080141_addBannedColToUsers cannot be reverted.\n";

        return false;
    }
    */
}
