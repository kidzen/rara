<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RawMaterial;

/**
 * RawMaterialSearch represents the model behind the search form about `common\models\RawMaterial`.
 */
class RawMaterialSearch extends RawMaterial
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'quantity'], 'integer'],
            [['type', 'stock', 'description', 'brand', 'vendor', 'notes'], 'safe'],
            [['unit_price'], 'number'],
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
        $query = RawMaterial::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'stock', $this->stock])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'vendor', $this->vendor])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
