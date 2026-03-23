<?php

use yii\db\Migration;

/**
 * Class m210615_223201_update_equipamento_table
 */
class m210615_223201_update_equipamento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-equipamento-empresa_id',
            'equipamento',
            'empresa_id',
            'empresa',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-equipamento-empresa_id','equipamento');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210615_223201_update_equipamento_table cannot be reverted.\n";

        return false;
    }
    */
}
