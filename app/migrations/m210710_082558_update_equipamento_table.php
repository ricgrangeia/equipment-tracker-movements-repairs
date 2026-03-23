<?php

use yii\db\Migration;

/**
 * Class m210710_082558_update_equipamento_table
 */
class m210710_082558_update_equipamento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('equipamento', 'avaliacao_estado', $this->string(50)->null());
        $this->addColumn('equipamento', 'avaliacao_observacoes', $this->text()->null());
        $this->addColumn('equipamento', 'avaliacao_data_ultima', $this->string(10)->null());
        $this->addColumn('equipamento', 'avaliacao_data_proxima', $this->string(10)->null());

        // add comments
        $this->addCommentOnColumn('equipamento', 'avaliacao_estado', 'Avaliação Estado');
        $this->addCommentOnColumn('equipamento', 'avaliacao_observacoes', 'Avaliação Observações');
        $this->addCommentOnColumn('equipamento', 'avaliacao_data_ultima', 'Avaliação Última');
        $this->addCommentOnColumn('equipamento', 'avaliacao_data_proxima', 'Avaliação Próxima');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('equipamento', 'avaliacao_estado');
        $this->dropColumn('equipamento', 'avaliacao_observacoes');
        $this->dropColumn('equipamento', 'avaliacao_data_ultima');
        $this->dropColumn('equipamento', 'avaliacao_data_proxima');
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210710_082558_update_equipamento_table cannot be reverted.\n";

        return false;
    }
    */
}
