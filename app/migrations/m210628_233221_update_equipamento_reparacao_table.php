<?php

use yii\db\Migration;

/**
 * Class m210628_233221_update_equipamento_reparacao_table
 */
class m210628_233221_update_equipamento_reparacao_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('equipamento_reparacao', 'data_prox_manutencao', $this->string(10)->null());
        $this->addColumn('equipamento_reparacao', 'observacoes', $this->text()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210628_233221_update_equipamento_reparacao_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210628_233221_update_equipamento_reparacao_table cannot be reverted.\n";

        return false;
    }
    */
}
