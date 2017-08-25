<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property string $date
 * @property string $item
 * @property string $description
 * @property double $cash_out
 * @property double $cash_in
 * @property string $notes
 */
class Account extends \yii\db\ActiveRecord
{
    public $balance;
    public $cash;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['description', 'notes','type'], 'string'],
            [['cash_out', 'cash_in', 'balance', 'cash'], 'number'],
            [['item'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'date' => Yii::t('app', 'Date'),
            'item' => Yii::t('app', 'Item'),
            'description' => Yii::t('app', 'Description'),
            'cash_out' => Yii::t('app', 'Cash Out'),
            'cash_in' => Yii::t('app', 'Cash In'),
            'notes' => Yii::t('app', 'Notes'),
        ];
    }
}
