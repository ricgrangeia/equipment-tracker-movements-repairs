<?php

use yii\db\Migration;

/**
 * Class m210604_200345_update_equipamento_table
 */
class m210604_200345_update_equipamento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-equipamento-estado_id',
            'equipamento',
            'estado_id',
            'equipamento_estado',
            'id',
            'CASCADE'
        );

//        // add foreign key for table `user`
//        $this->addForeignKey(
//            'fk-equipamento-empresa_id',
//            'equipamento',
//            'empresa_id',
//            'empresa',
//            'id',
//            'CASCADE'
//        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-equipamento-familia_id',
            'equipamento',
            'familia_id',
            'equipamento_familia',
            'id',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-equipamento-sub_familia_id',
            'equipamento',
            'sub_familia_id',
            'equipamento_subfamilia',
            'id',
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210604_200345_update_equipamento_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210604_200345_update_equipamento_table cannot be reverted.\n";

        return false;
    }
    */
}
