<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AccountReport;

/**
 * AccountReportSearch represents the model behind the search form about `common\models\AccountReport`.
 */
class AccountReportSearch extends AccountReport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'year', 'month'], 'integer'],
            [['date', 'item'], 'safe'],
            [['cash_in', 'cash_out', 'margin_income', 'daily_cash_in', 'daily_cash_out', 'monthly_cash_in', 'monthly_cash_out', 'yearly_cash_in', 'yearly_cash_out'], 'number'],
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
        $query = AccountReport::find();

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
            'year' => $this->year,
            'month' => $this->month,
            'cash_in' => $this->cash_in,
            'cash_out' => $this->cash_out,
            'margin_income' => $this->margin_income,
            'daily_cash_in' => $this->daily_cash_in,
            'daily_cash_out' => $this->daily_cash_out,
            'monthly_cash_in' => $this->monthly_cash_in,
            'monthly_cash_out' => $this->monthly_cash_out,
            'yearly_cash_in' => $this->yearly_cash_in,
            'yearly_cash_out' => $this->yearly_cash_out,
        ]);

        $query->andFilterWhere(['like', 'item', $this->item]);
        $query->andFilterWhere(['like', 'date', $this->date]);

        return $dataProvider;
    }
}
