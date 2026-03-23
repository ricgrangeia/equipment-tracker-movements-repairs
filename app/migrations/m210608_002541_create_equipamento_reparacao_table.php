<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%equipamento_reparacao}}`.
 */
class m210608_002541_create_equipamento_reparacao_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%equipamento_reparacao}}', [
            'id' => $this->primaryKey(),
            'equipamento_id' => $this->integer(11)->notNull(),
            'entidade_reparadora' => $this->string(150)->notNull(),
            'data_envio' => $this->string(10)->notNull(),
            'data_recepcao' => $this->string(10)->null(),
            'num_fatura' => $this->string(100)->null(),
            'valor_total' => $this->double()->null(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%equipamento_reparacao}}');
    }
}
