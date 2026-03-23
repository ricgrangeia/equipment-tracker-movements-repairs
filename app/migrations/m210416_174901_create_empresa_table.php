<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%empresa}}`.
 */
class m210416_174901_create_empresa_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%empresa}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%empresa}}');
    }
}
