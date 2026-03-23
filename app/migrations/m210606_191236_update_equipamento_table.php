<?php

use yii\db\Migration;

/**
 * Class m210606_191236_update_equipamento_table
 */
class m210606_191236_update_equipamento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%equipamento}}', 'modelo_id');
        $this->addColumn('{{%equipamento}}', 'modelo', $this->string(150)->null());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210606_191236_update_equipamento_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210606_191236_update_equipamento_table cannot be reverted.\n";

        return false;
    }
    */
}
