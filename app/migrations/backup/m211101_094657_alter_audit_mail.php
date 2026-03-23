<?php

use yii\db\Migration;

/**
 * Class m211101_094657_alter_audit_mail
 */
class m211101_094657_alter_audit_mail extends Migration
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
        echo "m211101_094657_alter_audit_mail cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211101_094657_alter_audit_mail cannot be reverted.\n";

        return false;
    }
    */
}
