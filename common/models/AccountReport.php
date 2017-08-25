<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "account_report".
 *
 * @property integer $id
 * @property string $date
 * @property integer $YEAR
 * @property integer $MONTH
 * @property string $item
 * @property double $cash_in
 * @property double $cash_out
 * @property double $margin_income
 * @property double $daily_cash_in
 * @property double $daily_cash_out
 * @property double $monthly_cash_in
 * @property double $monthly_cash_out
 * @property double $yearly_cash_in
 * @property double $yearly_cash_out
 */
class AccountReport extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'account_report';
    }

    public static function primaryKey() {
        return ['id'];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'year', 'month'], 'integer'],
            [['date'], 'required'],
            [['date'], 'safe'],
            [['cash_in', 'cash_out', 'margin_income', 'daily_cash_in', 'daily_cash_out', 'monthly_cash_in', 'monthly_cash_out', 'yearly_cash_in', 'yearly_cash_out'], 'number'],
            [['item'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'year' => Yii::t('app', 'Year'),
            'month' => Yii::t('app', 'Month'),
            'item' => Yii::t('app', 'Item'),
            'cash_in' => Yii::t('app', 'Cash In'),
            'cash_out' => Yii::t('app', 'Cash Out'),
            'margin_income' => Yii::t('app', 'Margin Income'),
            'daily_cash_in' => Yii::t('app', 'Daily Cash In'),
            'daily_cash_out' => Yii::t('app', 'Daily Cash Out'),
            'monthly_cash_in' => Yii::t('app', 'Monthly Cash In'),
            'monthly_cash_out' => Yii::t('app', 'Monthly Cash Out'),
            'yearly_cash_in' => Yii::t('app', 'Yearly Cash In'),
            'yearly_cash_out' => Yii::t('app', 'Yearly Cash Out'),
        ];
    }

}
