<?php

use yii\db\Migration;

class m260321_123548_seed_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Check if user already exists

        $username = 'demoadmin';
        $email = 'teste@example.com';

        $exists = (new \yii\db\Query())
            ->from('{{%user}}')
            ->where(['username' => $username])
            ->exists();

        if (!$exists) {

            // 2. Generate the security hash dynamically
            $passwordHash = Yii::$app->security->generatePasswordHash('password');
            $authKey = Yii::$app->security->generateRandomString();

            $this->insert('{{%user}}', [
                'id' => 1,
                'username' => $username,
                'auth_key' => $authKey,
                'password_hash' => $passwordHash,
                'email' => $email,
                'status' => 10,
                'created_at' => time(),
                'updated_at' => time(),
            ]);

            echo "   > User '{$username}' created with a fresh hash.\n";
        } else {
            echo "   > User '{$username}' already exists. Skipping seed.\n";
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', ['username' => 'ricardo']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260321_123548_seed_user_table cannot be reverted.\n";

        return false;
    }
    */
}
