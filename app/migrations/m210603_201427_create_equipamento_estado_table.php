<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%equipamento_estado}}`.
 */
class m210603_201427_create_equipamento_estado_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%equipamento_estado}}', [
            'id' => $this->primaryKey(),
            'estado' => $this->string(150)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%equipamento_estado}}');
    }
}
