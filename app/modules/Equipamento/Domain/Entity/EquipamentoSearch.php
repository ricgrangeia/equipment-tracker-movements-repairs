<?php

/**
 * @author : Ricardo Grangeia Dias
 * @profile : PHP Developer
 * @email : ricardo@grangeia.pt
 * @site : https://ricardo.grangeia.pt
 */

namespace app\modules\Equipamento\Domain\Entity;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * EquipamentoSearch represents the model behind the search form about `app\modules\Equipamento\Equipamento`.
 */
class EquipamentoSearch extends Equipamento
{
    public $location;
    public $sub_familia_descricao;
    public $familia_descricao;
    public $localization_id;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['localization_id', 'id', 'estado_id', 'empresa_id', 'familia_id', 'sub_familia_id', 'fornecedor'], 'integer'],
            [['num_serie', 'data', 'num_interno', 'equipamento', 'descricao', 'acessorios', 'observacoes', 'modelo', 'marca', 'location', 'sub_familia_descricao', 'familia_descricao'], 'safe'],
            [['caixa'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Equipamento::find();

        $query->joinWith(['subFamilia', 'familia']);

        $query->leftJoin("equipamento_movimento as em ON (em.id = (SELECT MAX(em_.id) 
    FROM equipamento_movimento em_ WHERE (em_.equipamento_id = equipamento.id) LIMIT 1))");


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 300,
            ],
        ]);

        // Important: here is how we set up the sorting
        // The key is the attribute name on our "TourSearch" instance
        //        $dataProvider->sort->attributes['location'] = [
        //            // The tables are the ones our relation are configured to
        //            // in my case they are prefixed with "tbl_"
        //            'asc' => ['equipamentoMovimento.destino.nome' => SORT_ASC],
        //            'desc' => ['equipamentoMovimento.destino.nome' => SORT_DESC],
        //        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if (Yii::$app->user->can('SoArmazemPortugal')) {
            $this->empresa_id = 2; # 2 id da Empresa  Portugal
        }

        if (Yii::$app->user->can('SoArmazemFranca')) {
            $this->empresa_id = 3; # 3 id da Empresa França
        }

        // 2. Safely convert string fields to Uppercase (Fixes PHP 8.1+ Null Deprecation)
        $attributesToUppercase = ['equipamento', 'descricao', 'acessorios', 'observacoes', 'marca', 'modelo'];

        foreach ($attributesToUppercase as $attr) {
            // Check if the property is not null and is a string before converting
            if (isset($this->$attr) && is_string($this->$attr)) {
                $this->$attr = mb_strtoupper($this->$attr, 'UTF-8');
            }
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'estado_id' => $this->estado_id,
            'caixa' => $this->caixa,
            'empresa_id' => $this->empresa_id,
            'familia_id' => $this->familia_id,
            'localization_id' => $this->localization_id,
            'sub_familia_id' => $this->sub_familia_id,
            'fornecedor_id' => $this->fornecedor,
            'destino_id' => $this->location
        ]);

        $query->andFilterWhere(['like', 'num_serie', $this->num_serie])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'num_interno', $this->num_interno])
            ->andFilterWhere(['like', 'UPPER(equipamento)', $this->equipamento])
            ->andFilterWhere(['like', 'UPPER(descricao)', $this->descricao])
            ->andFilterWhere(['like', 'UPPER(acessorios)', $this->acessorios])
            ->andFilterWhere(['like', 'UPPER(observacoes)', $this->observacoes])
            ->andFilterWhere(['like', 'UPPER(modelo)', $this->modelo])
            ->andFilterWhere(['like', 'UPPER(marca)', $this->marca]);


        //        $query->andWhere("equipamentoMovimentos");


        // Use the null coalescing operator (??) to ensure a string is passed
        $this->familia_descricao = mb_strtoupper($this->familia_descricao ?? '', 'UTF-8');

        #Filtro especial para a Familia pesquisa por descricao
        $query->andFilterWhere(['like', "equipamento_familia.familia", $this->familia_descricao]);

        # Configurar a ordenação
        $dataProvider->sort->attributes['familia_descricao'] = [
            'asc' => ['equipamento_familia.familia' => SORT_ASC],
            'desc' => ['equipamento_familia.familia' => SORT_DESC],
        ];

        // Do the same for sub_familia
        $this->sub_familia_descricao = mb_strtoupper($this->sub_familia_descricao ?? '', 'UTF-8');

        # Filtro especial para a SubFamilia pesquisa por descricao
        $query->andFilterWhere(["like", "equipamento_subfamilia.subfamilia", $this->sub_familia_descricao]);
        
        # Configurar a ordenação
        $dataProvider->sort->attributes['sub_familia_descricao'] = [
            'asc' => ['equipamento_subfamilia.subfamilia' => SORT_ASC],
            'desc' => ['equipamento_subfamilia.subfamilia' => SORT_DESC],
        ];

        $query->select([" equipamento.*, 
        
          REPLACE( REPLACE( REPLACE( REPLACE( REPLACE( REPLACE (
            REPLACE( REPLACE( REPLACE( REPLACE(REPLACE( REPLACE(  REPLACE(TRIM(num_interno), 'I', ''), 'V',''), 'X', ''),'0','')
            ,'1',''),'2',''),'3',''),'4',''),'5',''),'6',''),'7',''),'8',''),'9','') AS firstletters,
           LPAD(
           REPLACE(
               
           REPLACE( REPLACE(  REPLACE(TRIM(num_interno), 'I', ''), 'V',''), 'X', ''),
               
           REPLACE( REPLACE( REPLACE( REPLACE( REPLACE( REPLACE (
            REPLACE( REPLACE( REPLACE( REPLACE(REPLACE( REPLACE(  REPLACE(TRIM(num_interno), 'I', ''), 'V',''), 'X', ''),'0','')
            ,'1',''),'2',''),'3',''),'4',''),'5',''),'6',''),'7',''),'8',''),'9','')
             ,
               ''),
		  10, '0')
           AS number,
          CASE
			WHEN Locate(  'XXX'     , TRIM( num_interno )   ) > 0 then 30	
            WHEN Locate(  'XXIX'    , TRIM( num_interno )   ) > 0 then 29	
            WHEN Locate(  'XXVIII'  , TRIM( num_interno )   ) > 0 then 28	
            WHEN Locate(  'XXVII'   , TRIM( num_interno )   ) > 0 then 27		
            WHEN Locate(  'XXVI'    , TRIM( num_interno )   ) > 0 then 26
            WHEN Locate(  'XXV'     , TRIM( num_interno )   ) > 0 then 25
            WHEN Locate(  'XXIV'    , TRIM( num_interno )   ) > 0 then 24
            WHEN Locate(  'XXIII'   , TRIM( num_interno )   ) > 0 then 23
            WHEN Locate(  'XXII'    , TRIM( num_interno )   ) > 0 then 22
            WHEN Locate(  'XXI'     , TRIM( num_interno )   ) > 0 then 21
            WHEN Locate(  'XX'      , TRIM( num_interno )   ) > 0 then 20	
            WHEN Locate(  'XIX'     , TRIM( num_interno )   ) > 0 then 19	
            WHEN Locate(  'XVIII'   , TRIM( num_interno )   ) > 0 then 18	
            WHEN Locate(  'XVII'    , TRIM( num_interno )   ) > 0 then 17		
            WHEN Locate(  'XVI'     , TRIM( num_interno )   ) > 0 then 16
            WHEN Locate(  'XV'      , TRIM( num_interno )   ) > 0 then 15
            WHEN Locate(  'XIV'     , TRIM( num_interno )   ) > 0 then 14
            WHEN Locate(  'XIII'    , TRIM( num_interno )   ) > 0 then 13
            WHEN Locate(  'XII'     , TRIM( num_interno )   ) > 0 then 12
            WHEN Locate(  'XI'      , TRIM( num_interno )   ) > 0 then 11
            WHEN Locate(  'XI'      , TRIM( num_interno )   ) > 0 then 11
            WHEN Locate(  'X'       , TRIM( num_interno )   ) > 0 then 10
            WHEN Locate(  'IX'      , TRIM( num_interno )   ) > 0 then 9
            WHEN Locate(  'VIII'    , TRIM( num_interno )   ) > 0 then 8
            WHEN Locate(  'VII'     , TRIM( num_interno )   ) > 0 then 7
            WHEN Locate(  'VI'      , TRIM( num_interno )   ) > 0 then 6
            WHEN Locate(  'V'       , TRIM( num_interno )   ) > 0 then 5
            WHEN Locate(  'IV'      , TRIM( num_interno )   ) > 0 then 4
            WHEN Locate(  'III'     , TRIM( num_interno )   ) > 0 then 3
            WHEN Locate(  'II'      , TRIM( num_interno )   ) > 0 then 2
            WHEN Locate(  'I'       , TRIM( num_interno )   ) > 0 then 1            
            ELSE 0
        END as ROMAN

        "]);


        //        # Configurar a ordenação
        $dataProvider->sort->attributes['num_interno'] = [
            'asc' => [
                new \yii\db\Expression("firstletters DESC, number DESC, ROMAN DESC"),
            ],
            'desc' => [
                new \yii\db\Expression("firstletters ASC, number ASC, ROMAN ASC"),
            ],

        ];


        $query->orderBy(
            [
                new \yii\db\Expression("firstletters ASC, number ASC, ROMAN ASC")
            ]
        );


        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchEquipamentoActivo()
    {
        $query = Equipamento::find();

        $query->joinWith('equipamentoMovimentos');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'estado_id' => 1,
        ]);

        return $dataProvider;
    }
}
