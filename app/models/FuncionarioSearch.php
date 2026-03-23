<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FuncionarioSearch represents the model behind the search form about `app\models\Funcionario`.
 */
class FuncionarioSearch extends Funcionario
{
    public $localization;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'localization'], 'integer'],
            [['ativo', 'nome', 'tipo'], 'safe'],
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
        $query = Funcionario::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'ativo' => $this->ativo,
            'localization' => $this->localization,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'tipo', $this->tipo]);

        $query->orderBy(['nome'=> SORT_ASC]);
        return $dataProvider;
    }
}
