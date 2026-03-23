<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%equipamento}}`.
 */
class m210603_185955_create_equipamento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%equipamento}}', [
            'id' => $this->primaryKey(),
            'num_serie' => $this->string(150)->null(),
            'data' => $this->string(10)->null(),
            'num_interno' => $this->string(150)->notNull()->unique(),
            'equipamento' => $this->string(150)->notNull(),
            'descricao' => $this->string(300)->null(),
            'marca_id' => $this->integer()->null(),
            'modelo_id' => $this->integer()->null(),
            'estado_id' => $this->integer(11)->notNull(),
            'caixa' => $this->boolean()->defaultValue(false),
            'empresa_id' => $this->integer(11)->notNull(),
            'familia_id' => $this->integer(11)->null(),
            'sub_familia_id' => $this->integer(11)->null(),
            'acessorios' => $this->string(300)->null(),
            'fornecedor_id' => $this->integer(11)->null(),
            'observacoes' => $this->text()->null(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%equipamento}}');
    }
}
