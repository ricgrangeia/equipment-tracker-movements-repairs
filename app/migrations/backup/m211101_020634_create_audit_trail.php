<?php

use yii\db\Migration;

/**
 * Class m211101_020634_create_audit_trail
 */
class m211101_020634_create_audit_trail extends Migration
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
        echo "m211101_020634_create_audit_trail cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211101_020634_create_audit_trail cannot be reverted.\n";

        return false;
    }
    */
}
