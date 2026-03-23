<?php

use yii\db\Migration;

/**
 * Class m210902_205402_update_equipamento_movimento_table
 */
class m210902_205402_update_equipamento_movimento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('equipamento_movimento', 'utilizador_responsavel', $this->integer(11));

        $this->addCommentOnColumn('equipamento_movimento', 'utilizador_responsavel', 'Utilizador responsável');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('equipamento_movimento', 'utilizador_responsavel');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210902_205402_update_equipamento_movimento_table cannot be reverted.\n";

        return false;
    }
    */
}
