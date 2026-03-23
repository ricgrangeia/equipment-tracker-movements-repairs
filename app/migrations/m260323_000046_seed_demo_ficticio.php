<?php

use yii\db\Migration;

class m260323_000046_seed_demo_ficticio extends Migration
{
    public function safeUp()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');

        // 1. Empresas Fictícias
        $this->batchInsert('{{%empresa}}', ['id', 'empresa'], [
            [2, 'Logística Global Norte'],
            [3, 'Construções Horizonte Azul'],
            [4, 'Manutenção Industrial Delta'],
        ]);

        // 2. Localizações
        $this->batchInsert('{{%localization}}', ['id', 'active', 'localization'], [
            [1, 1, 'Armazém Central'],
            [2, 1, 'Estaleiro Sul'],
            [3, 1, 'Oficina de Reparação'],
        ]);

        // 3. Estados de Equipamento
        $this->batchInsert('{{%equipamento_estado}}', ['id', 'estado'], [
            [4, 'OPERACIONAL'],
            [6, 'NOVO'],
            [3, 'ABATE'],
            [1, 'DANIFICADO'],
            [2, 'USO LIMITADO'],
        ]);

        // 4. Famílias
        $this->batchInsert('{{%equipamento_familia}}', ['id', 'familia'], [
            [5, 'ACESSO E ALTURA'],
            [8, 'FERRAMENTAS SEM FIOS'],
            [7, 'EQUIPAMENTO ELÉTRICO'],
        ]);

        // 5. Subfamílias
        $this->batchInsert('{{%equipamento_subfamilia}}', ['id', 'familia_id', 'subfamilia'], [
            [5, 5, 'PLATAFORMA ELEVATÓRIA'],
            [11, 8, 'APARAFUSADORA IMPACTO'],
            [10, 7, 'REBARBADORA INDUSTRIAL'],
        ]);

        // 6. Funcionários (5 Nomes Inventados)
        $this->batchInsert('{{%funcionario}}', ['id', 'nome', 'tipo', 'localization', 'ativo'], [
            [1, 'Clark Kent (Super-Homem)', 'Gestor de Crises', 1, 1],
            [2, 'Zeus do Copérnico', 'Diretor de Energia', 2, 1],
            [7, 'Tony Stark', 'Engenheiro Principal', 3, 1],
            [13, 'Nicolau Copérnico (O Vigilante)', 'Navegador', 3, 1],
            [15, 'Diana Prince (Mulher-Maravilha)', 'Segurança', 2, 1],
        ]);

        // 7. Equipamentos (15 Itens com Marcas/Modelos Inventados)
        $this->batchInsert(
            '{{%equipamento}}',
            ['id', 'num_interno', 'equipamento', 'marca', 'modelo', 'estado_id', 'empresa_id', 'familia_id', 'sub_familia_id', 'localization_id', 'fornecedor'],
            [
                [1001, 'DM-001', 'PLATAFORMA X1', 'TITAN-BUILD', 'VORTEX 500', 4, 2, 5, 5, 1, 'MegaSuprimentos'],
                [1002, 'DM-002', 'PLATAFORMA X1', 'TITAN-BUILD', 'VORTEX 500', 4, 2, 5, 5, 1, 'MegaSuprimentos'],
                [1003, 'DM-003', 'APARAFUSADORA PRO', 'VOLT-MAX', 'Z-THOR 18V', 4, 2, 8, 11, 1, 'Loja do Profissional'],
                [1004, 'DM-004', 'APARAFUSADORA PRO', 'VOLT-MAX', 'Z-THOR 18V', 4, 3, 8, 11, 2, 'Loja do Profissional'],
                [1005, 'DM-005', 'REBARBADORA 2000W', 'STEEL-CUT', 'SC-Xtreme', 2, 2, 7, 10, 1, 'Ferramentas & Cia'],
                [1006, 'DM-006', 'REBARBADORA 2000W', 'STEEL-CUT', 'SC-Xtreme', 4, 2, 7, 10, 1, 'Ferramentas & Cia'],
                [1007, 'DM-007', 'PLATAFORMA COMPACTA', 'SKY-REACH', 'NANO-8', 6, 4, 5, 5, 3, 'Alugueres Delta'],
                [1008, 'DM-008', 'APARAFUSADORA MINI', 'VOLT-MAX', 'LITE-DRILL', 4, 2, 8, 11, 1, 'MegaSuprimentos'],
                [1009, 'DM-009', 'REBARBADORA C/ BATERIA', 'VOLT-MAX', 'Z-SAW 20V', 4, 3, 8, 10, 2, 'MegaSuprimentos'],
                [1010, 'DM-010', 'GERADOR SILENCIOSO', 'POWER-GEN', 'SILENT-7000', 4, 2, 7, 10, 1, 'Energy Source'],
                [1011, 'DM-011', 'MARTELO DEMOLIDOR', 'ROCK-BREAK', 'RB-95', 1, 2, 7, 10, 1, 'Ferramentas & Cia'],
                [1012, 'DM-012', 'SOPRADOR TÉRMICO', 'HEAT-TECH', 'HT-2100', 4, 4, 7, 10, 3, 'Distribuidora Norte'],
                [1013, 'DM-013', 'BERBEQUIM COLUNA', 'DRILL-MASTER', 'BM-STATIC', 4, 2, 7, 10, 1, 'Oficina Total'],
                [1014, 'DM-014', 'MÁQUINA CRAVAR', 'PRESS-FIX', 'PF-2026', 4, 2, 7, 10, 1, 'Sistemas Fixos'],
                [1015, 'DM-015', 'PLACA VIBRATÓRIA', 'TERRA-FORCE', 'TF-VIBE', 2, 3, 7, 10, 2, 'Maquinaria Global'],
            ]
        );

        // 8. Exemplos de Movimentação
        $this->batchInsert(
            '{{%equipamento_movimento}}',
            ['data', 'destino_id', 'tipo_movimento_id', 'equipamento_id', 'utilizador_responsavel', 'observacoes'],
            [
                ['22/03/2026', 1, 1, 1003, 1, 'Atribuição inicial de ferramenta'],
                ['21/03/2026', 15, 1, 1001, 1, 'Entrega para obra em curso'],
            ]
        );

        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');
    }

    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->truncateTable('{{%equipamento_movimento}}');
        $this->truncateTable('{{%equipamento}}');
        $this->truncateTable('{{%funcionario}}');
        $this->truncateTable('{{%empresa}}');
        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
