<?php

use yii\db\Migration;

/**
 * Class m210524_225404_update_img_table_table
 */
class m210524_225404_update_img_table_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%img_table}}', 'id_model', 'model_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210524_225404_update_img_table_table cannot be reverted.\n";
        $this->renameColumn('{{%img_table}}', 'model_id', 'id_model');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210524_225404_update_img_table_table cannot be reverted.\n";

        return false;
    }
    */
}
