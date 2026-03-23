<?php

use yii\db\Migration;

/**
 * Class m210612_074919_update_funcionario_table
 * Atualiza a tabela funcionario para incluir tipo e localization.
 */
class m210612_074919_update_funcionario_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 1. Adiciona a coluna 'tipo' com o valor padrão correto
        $this->addColumn('{{%funcionario}}', 'tipo', $this->string(100)->notNull()->defaultValue('Funcionário'));

        // 2. Adiciona a coluna 'localization' como inteiro (para a FK)
        // Nota: Removi o 'notNull()' temporariamente caso já tenhas dados na tabela, 
        // ou podes manter se a tabela estiver vazia.
        $this->addColumn('{{%funcionario}}', 'localization', $this->integer()->notNull()->comment('Localização'));

        // 3. Cria o Índice para a coluna localization (ADD KEY)
        $this->createIndex(
            'idx-funcionario-localization',
            '{{%funcionario}}',
            'localization'
        );

        // 4. Adiciona a Chave Estrangeira (Foreign Key) ligando à tabela localization
        $this->addForeignKey(
            'fk-funcionario-localization',
            '{{%funcionario}}',
            'localization',
            '{{%localization}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Remove a FK e o Índice primeiro
        $this->dropForeignKey('fk-funcionario-localization', '{{%funcionario}}');
        $this->dropIndex('idx-funcionario-localization', '{{%funcionario}}');

        // Remove as colunas
        $this->dropColumn('{{%funcionario}}', 'localization');
        $this->dropColumn('{{%funcionario}}', 'tipo');
    }
}
