<?php

use yii\db\Migration;

/**
 * Class m260320_221334_update_equipamento_table
 */
class m260320_221334_update_equipamento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 1. Adicionar colunas em falta
        if ($this->db->getTableSchema('{{%equipamento}}')->getColumn('localization_id') === null) {
            $this->addColumn('{{%equipamento}}', 'localization_id', $this->integer()->null()->after('num_interno')->comment('Localização'));
        }

        if ($this->db->getTableSchema('{{%equipamento}}')->getColumn('image_manager_id_avatar') === null) {
            $this->addColumn('{{%equipamento}}', 'image_manager_id_avatar', $this->string(300)->null());
        }

        // 2. Garantir que 'acessorios' e 'observacoes' são TEXT (como no teu SQL)
        $this->alterColumn('{{%equipamento}}', 'acessorios', $this->text()->null());
        $this->alterColumn('{{%equipamento}}', 'observacoes', $this->text()->null());

        // 3. Adicionar Chave Estrangeira para Localização
        // Nota: Certifica-te que a tabela 'localization' já existe
        $this->addForeignKey(
            'equipamento_ibfk_1',
            '{{%equipamento}}',
            'localization_id',
            '{{%localization}}',
            'id',
            'SET NULL',
            'CASCADE'
        );

        // 4. Indexação adicional para performance (conforme o teu ALTER TABLE)
        $this->createIndex('idx-equipamento-num_interno', '{{%equipamento}}', 'num_interno', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('equipamento_ibfk_1', '{{%equipamento}}');
        $this->dropColumn('{{%equipamento}}', 'localization_id');
        $this->dropColumn('{{%equipamento}}', 'image_manager_id_avatar');
        $this->dropIndex('idx-equipamento-num_interno', '{{%equipamento}}');
    }
}
