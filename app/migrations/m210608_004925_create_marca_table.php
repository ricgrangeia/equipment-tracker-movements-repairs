<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%marca}}`.
 */
class m210608_004925_create_marca_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%marca}}', [
            'id' => $this->primaryKey(),
            'marca' => $this->string(100)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%marca}}');
    }
}
