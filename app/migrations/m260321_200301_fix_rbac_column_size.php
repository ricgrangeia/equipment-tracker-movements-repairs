<?php

use yii\db\Migration;

class m260321_200301_fix_rbac_column_size extends Migration
{
    public function safeUp()
    {
        // Disable foreign keys to allow column modification
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');

        // Increase to 255 to be safe for long URL routes
        $this->alterColumn('{{%auth_item}}', 'name', $this->string(255)->notNull());
        $this->alterColumn('{{%auth_item_child}}', 'parent', $this->string(255)->notNull());
        $this->alterColumn('{{%auth_item_child}}', 'child', $this->string(255)->notNull());
        $this->alterColumn('{{%auth_assignment}}', 'item_name', $this->string(255)->notNull());

        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');
    }

    public function safeDown()
    {
        // Reverting to 64 if necessary, but usually 255 is better for modern apps
        $this->alterColumn('{{%auth_item}}', 'name', $this->string(64)->notNull());
    }
}
