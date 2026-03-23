<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%marca}}`.
 */
class m210608_212905_drop_marca_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%marca}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%marca}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
