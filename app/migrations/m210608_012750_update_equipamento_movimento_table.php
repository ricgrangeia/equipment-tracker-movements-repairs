<?php

use yii\db\Migration;

/**
 * Class m210608_012750_update_equipamento_movimento_table
 */
class m210608_012750_update_equipamento_movimento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%equipamento_movimento}}', 'equipamento_id', $this->integer(11)->notNull());

        $this->addForeignKey(
            'fk-equipamento_movimento-equipamento_id',
            'equipamento_movimento',
            'equipamento_id',
            'equipamento',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210608_012750_update_equipamento_movimento_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210608_012750_update_equipamento_movimento_table cannot be reverted.\n";

        return false;
    }
    */
}
