<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%equipamento_subfamilia}}`.
 */
class m210603_201529_create_equipamento_subfamilia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%equipamento_subfamilia}}', [
            'id' => $this->primaryKey(),
            'familia_id' => $this->integer(11)->notNull(),
            'subfamilia' => $this->string(150)->notNull(),
        ]);

        $this->createIndex(
            'idx-unique-equipamento_subfamilia-familia_id-subfamilia',
            'equipamento_subfamilia',
            'familia_id, subfamilia',
            true

        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-equipamento_subfamilia-familia_id',
            'equipamento_subfamilia',
            'familia_id',
            'equipamento_familia',
            'id',
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%equipamento_subfamilia}}');
    }
}
