<?php

use yii\db\Migration;

/**
 * Class m210619_110121_update_equipamento_table
 */
class m210619_110121_update_equipamento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('equipamento', 'fornecedor_id', 'fornecedor');
        $this->alterColumn('equipamento', 'fornecedor', $this->string(150)->notNull());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210619_110121_update_equipamento_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210619_110121_update_equipamento_table cannot be reverted.\n";

        return false;
    }
    */
}
