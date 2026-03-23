<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%img_table}}`.
 */
class m210524_222507_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%img_table}}', [
            'id' => $this->primaryKey(),
            'timestamp' => $this->dateTime()->notNull(),
            'path' => $this->string(300)->null(),
            'img_name' => $this->string(250)->notNull(),
            'file_type' => $this->string(50)->notNull(),
            'img_name_thumb' => $this->string(250)->null(),
            'name' => $this->string(250)->notNull()->defaultValue(''),
            'id_model' => $this->integer(11)->null(),
            'name_model' => $this->string(250)->null(),
            'category' => $this->integer(11)->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%img_table}}');
    }
}
