<?php

use yii\db\Migration;

/**
 * Class m211101_020607_create_audit_error
 */
class m211101_020607_create_audit_error extends Migration
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
        echo "m211101_020607_create_audit_error cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211101_020607_create_audit_error cannot be reverted.\n";

        return false;
    }
    */
}
