<?php

use yii\db\Migration;

/**
 * Class m211015_011621_update_equipamento_reparacao_table
 */
class m211015_011621_update_equipamento_reparacao_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('equipamento_reparacao', 'destino_origem', $this->integer(11)->null());
        $this->addColumn('equipamento_reparacao', 'movimento_id_reparacao', $this->integer(11)->null());
        $this->addColumn('equipamento_reparacao', 'movimento_id_reparacao_regresso', $this->integer(11)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211015_011621_update_equipamento_reparacao_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211015_011621_update_equipamento_reparacao_table cannot be reverted.\n";

        return false;
    }
    */
}
