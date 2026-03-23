<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%img_category}}`.
 */
class m210524_223553_create_img_categorie_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%img_category}}', [
            'id' => $this->primaryKey(),
            'descricao' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%img_category}}');
    }
}
