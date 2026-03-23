<?php
/**
 * @author : Ricardo Grangeia Dias
 * @profile : PHP Developer
 * @email : ricardo@grangeia.pt
 * @site : https://ricardo.grangeia.pt
 */

namespace app\modules\Empresa;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EmpresaSearch represents the model behind the search form about `app\modules\Empresa\Empresa`.
 */
class EmpresaSearch extends Empresa
{
    public $empresa;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['empresa'], 'safe'],
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
        $query = Empresa::find();

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
        ]);

        $query->andFilterWhere(['like', 'empresa', $this->empresa]);

        return $dataProvider;
    }
}
