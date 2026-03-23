<?php

use yii\db\Migration;

/**
 * Class m211012_221334_update_equipamento_table
 */
class m211012_221334_update_equipamento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('equipamento', 'acessorios', $this->text()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('equipamento', 'acessorios', $this->string(300)->null());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211012_221334_update_equipamento_table cannot be reverted.\n";

        return false;
    }
    */
}
