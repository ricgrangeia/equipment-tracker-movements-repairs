<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nacionalidade}}`.
 */
class m210416_175502_create_nacionalidade_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%nacionalidade}}', [
            'id' => $this->primaryKey(),
            'descricao' => $this->string(50)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%nacionalidade}}');
    }
}
