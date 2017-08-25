<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrderItems;

/**
 * OrderItemsSearch represents the model behind the search form about `common\models\OrderItems`.
 */
class OrderItemsSearch extends OrderItems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'quantity', 'weight', 'size', 'status', 'created_at', 'updated_at'], 'integer'],
            [['type', 'item', 'description', 'quantity_unit', 'weight_unit', 'size_unit', 'time_required', 'notes'], 'safe'],
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
        $query = OrderItems::find();

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
            'order_id' => $this->order_id,
            'quantity' => $this->quantity,
            'weight' => $this->weight,
            'size' => $this->size,
            'unit_price' => $this->unit_price,
            'time_required' => $this->time_required,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'item', $this->item])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'quantity_unit', $this->quantity_unit])
            ->andFilterWhere(['like', 'weight_unit', $this->weight_unit])
            ->andFilterWhere(['like', 'size_unit', $this->size_unit])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
