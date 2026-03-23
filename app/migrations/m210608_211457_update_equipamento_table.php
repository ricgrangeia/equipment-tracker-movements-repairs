<?php

use yii\db\Migration;

/**
 * Class m210608_211457_update_equipamento_table
 */
class m210608_211457_update_equipamento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add foreign key for table `user`
        $this->dropForeignKey('fk-equipamento-marca_id', 'equipamento');
        $this->dropColumn('equipamento', 'marca_id');
        $this->addColumn('equipamento', 'marca', $this->string(150)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210608_211457_update_equipamento_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210608_211457_update_equipamento_table cannot be reverted.\n";

        return false;
    }
    */
}
