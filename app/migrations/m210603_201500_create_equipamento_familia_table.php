<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%equipamento_familia}}`.
 */
class m210603_201500_create_equipamento_familia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%equipamento_familia}}', [
            'id' => $this->primaryKey(),
            'familia' => $this->string(150)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%equipamento_familia}}');
    }
}
