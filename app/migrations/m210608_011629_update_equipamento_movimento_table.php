<?php

use yii\db\Migration;

/**
 * Class m210608_011629_update_equipamento_movimento_table
 */
class m210608_011629_update_equipamento_movimento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-equipamento_movimento-tipo_movimento_id',
            'equipamento_movimento',
            'tipo_movimento_id',
            'equipamento_movimento_tipo',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210608_011629_update_equipamento_movimento_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210608_011629_update_equipamento_movimento_table cannot be reverted.\n";

        return false;
    }
    */
}
