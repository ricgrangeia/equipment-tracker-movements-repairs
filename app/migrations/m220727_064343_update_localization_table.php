<?php

use yii\db\Migration;

/**
 * Class m220727_064343_update_localization_table
 */
class m220727_064343_update_localization_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addCommentOnColumn('localization', 'active', 'Ativa');
        $this->addCommentOnColumn('localization', 'localization', 'Localização');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220727_064343_update_localization_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220727_064343_update_localization_table cannot be reverted.\n";

        return false;
    }
    */
}
