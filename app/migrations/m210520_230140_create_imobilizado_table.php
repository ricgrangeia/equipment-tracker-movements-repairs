<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%imobilizado}}`.
 */
class m210520_230140_create_imobilizado_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%imobilizado}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(150)->notNull(),
            'code_imo' => $this->string(150)->notNull()->unique(),
            'descricao' => $this->text()->null(),
            'data_compra' => $this->date()->null(),
            'tipo_imobilizado' => $this->integer(11)->notNull(),
            'localizacao' => $this->string(150)->notNull(),
            'tipo_estado_conservacao' => $this->integer(11)->notNull(),
            'num_serie' => $this->string(120)->notNull(),
            'familia' => $this->integer(11)->notNull(),
            'sub_familia' => $this->integer(11)->notNull(),
            'observacoes' => $this->text()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%imobilizado}}');
    }
}
