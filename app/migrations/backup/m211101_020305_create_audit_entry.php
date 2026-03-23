<?php

use yii\db\Migration;

/**
 * Class m211101_020305_create_audit_entry
 */
class m211101_020305_create_audit_entry extends Migration
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
        echo "m211101_020305_create_audit_entry cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211101_020305_create_audit_entry cannot be reverted.\n";

        return false;
    }
    */
}
