<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parceiro_venda}}`.
 */
class m210531_221824_create_parceiro_venda_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%parceiro_venda}}', [
            'id' => $this->primaryKey(),
            'empresa_id' => $this->integer(11)->notNull(),
            'loja_id' => $this->integer(11)->notNull(),
            'ano' => $this->integer(4)->notNull(),
            'parceiro_id' => $this->integer(11)->notNull(),
            'pedido_id' => $this->string(10)->null(),
            'connection_id' => $this->string(150)->null(),
            'canal_pedido' => $this->string(150)->null(),
            'data_pedido' => $this->date()->notNull(),
            'hora_pedido' => $this->time()->null(),
            'valor_base_pedido' => $this->double()->notNull(),
            'iva6_pedido' => $this->double()->notNull(),
            'iva13_pedido' => $this->double()->notNull(),
            'iva23_pedido' => $this->double()->notNull(),
            'valor_total_pedido' => $this->double()->notNull(),
            'estado_pedido' => $this->string()->null(),
            'taxa_base_parceiro' => $this->double()->notNull(),
            'taxa_iva23_parceiro' => $this->double()->notNull(),
            'taxa_valor_total_parceiro' => $this->double()->notNull(),
            'pagamento_parceiro' => $this->double()->null(),
            'data_pagamento_parceiro' => $this->double()->notNull(),

        ]);

        // add comments
        $this->addCommentOnColumn('{{%parceiro_venda}}', 'empresa_id', 'Empresa');
        $this->addCommentOnColumn('{{%parceiro_venda}}', 'loja_id', 'Loja');
        $this->addCommentOnColumn('{{%parceiro_venda}}', 'parceiro_id', 'Parceiro');
        $this->addCommentOnColumn('{{%parceiro_venda}}', 'ano', 'Ano');
        $this->addCommentOnColumn('{{%parceiro_venda}}', 'data_pedido', 'Data');
        $this->addCommentOnColumn('{{%parceiro_venda}}', 'hora_pedido', 'Hora');


        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-parceiro_venda-parceiro_id',
            'parceiro_venda',
            'parceiro_id',
            'parceiro',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%parceiro_venda}}');
    }
}
