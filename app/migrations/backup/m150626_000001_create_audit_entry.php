<?php

namespace bedezign\yii2\audit\migrations;

use bedezign\yii2\audit\components\Migration;
use yii\db\Schema;

class m150626_000001_create_audit_entry extends Migration
{
    const TABLE = '{{%audit_entry}}';

    public function up()
    {
        $this->createTable(self::TABLE, [
            'id'                => $this->primaryKey(),
            'created'           => $this->dateTime()->notNull(),
            'user_id'           => $this->integer()->defaultValue(0),
            'duration'          => $this->float()->null(),
            'ip'                => $this->string(45)->null(),
            'request_method'    => $this->string(16)->null(),
            'ajax'              => $this->integer(1)->defaultValue(0)->notNull(),
            'route'             => $this->string(255)->null(),
            'memory_max'        => $this->integer()->null(),
        ]);

        $this->createIndex('idx_user_id', self::TABLE, ['user_id']);
        $this->createIndex('idx_route', self::TABLE, ['route']);
    }

    public function down()
    {
        $this->dropTable(self::TABLE);
    }
}
