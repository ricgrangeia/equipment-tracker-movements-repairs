<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%localization}}`.
 */
class m210612_062431_create_localization_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%localization}}', [
            'id' => $this->primaryKey(),
            'active' => $this->boolean()->defaultValue(true),
            'localization' => $this->string(250)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%localization}}');
    }
}
