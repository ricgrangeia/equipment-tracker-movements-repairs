<?php

use yii\db\Migration;

/**
 * Class m210416_181305_update_empresa_table
 */
class m210416_181305_update_empresa_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('empresa', 'empresa', $this->string(250)->notNull());
     

        // add comments
        $this->addCommentOnColumn('empresa', 'empresa', 'Nome Empresa');
  
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210416_181305_update_empresa_table cannot be reverted.\n";


        $this->dropColumn('empresa', 'empresa');



    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210416_181305_update_empresa_table cannot be reverted.\n";

        return false;
    }
    */
}
