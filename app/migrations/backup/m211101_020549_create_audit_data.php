<?php

use yii\db\Migration;

/**
 * Class m211101_020549_create_audit_data
 */
class m211101_020549_create_audit_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211101_020549_create_audit_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211101_020549_create_audit_data cannot be reverted.\n";

        return false;
    }
    */
}
