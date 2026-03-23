<?php

use yii\db\Migration;

/**
 * Class m210710_080631_update_equipamento_table
 */
class m210710_080631_update_equipamento_table extends Migration
{
    /**
     * {@inheritdoc}
     *
     * Tem haver com a inspeção dos equipamentos nas obras
     *
     */
    public function safeUp()
    {
        $this->addColumn('empresa', 'avaliacao_estado', $this->string(50)->null());
        $this->addColumn('empresa', 'avaliacao_observacoes', $this->text()->null());
        $this->addColumn('empresa', 'avaliacao_data_ultima', $this->string(10)->null());
        $this->addColumn('empresa', 'avaliacao_data_proxima', $this->string(10)->null());

        // add comments
        $this->addCommentOnColumn('empresa', 'avaliacao_estado', 'Avaliação Estado');
        $this->addCommentOnColumn('empresa', 'avaliacao_observacoes', 'Avaliação Observações');
        $this->addCommentOnColumn('empresa', 'avaliacao_data_ultima', 'Avaliação Última');
        $this->addCommentOnColumn('empresa', 'avaliacao_data_proxima', 'Avaliação Próxima');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('empresa', 'avaliacao_estado');
        $this->dropColumn('empresa', 'avaliacao_observacoes');
        $this->dropColumn('empresa', 'avaliacao_data_ultima');
        $this->dropColumn('empresa', 'avaliacao_data_proxima');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210710_080631_update_equipamento_table cannot be reverted.\n";

        return false;
    }
    */
}
