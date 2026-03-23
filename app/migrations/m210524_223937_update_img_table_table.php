<?php

use yii\db\Migration;

/**
 * Class m210524_223937_update_img_table_table
 */
class m210524_223937_update_img_table_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%img_table}}', 'category', 'category_id');

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-img_table-img_category_id',
            'img_table',
            'category_id',
            'img_category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210524_223937_update_img_table_table cannot be reverted.\n";

        // drops foreign key for table `tag`
        $this->dropForeignKey(
            'fk-img_table-img_category_id',
            'img_table'
        );

        $this->renameColumn('{{%img_table}}', 'category_id', 'category');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210524_223937_update_img_table_table cannot be reverted.\n";

        return false;
    }
    */
}
