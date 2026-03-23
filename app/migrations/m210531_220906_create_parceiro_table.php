<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parceiro}}`.
 */
class m210531_220906_create_parceiro_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%parceiro}}', [
            'id' => $this->primaryKey(),
            'parceiro' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%parceiro}}');
    }
}
