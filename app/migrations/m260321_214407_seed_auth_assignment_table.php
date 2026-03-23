<?php

use yii\db\Migration;

class m260321_214407_seed_auth_assignment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('auth_assignment', [
            'item_name' => 'Programador',
            'user_id' => 1
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('auth_assignment', [
            'item_name' => 'Programador',
            'user_id' => 1,
        ]);
    }


}
