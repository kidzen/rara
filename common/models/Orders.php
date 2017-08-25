<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $type
 * @property string $order_no
 * @property string $order_date
 * @property string $order_by
 * @property string $contact_refference
 * @property string $required_date
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property OrderItems[] $orderItems
 * @property Payment[] $payments
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_date', 'required_date'], 'safe'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['type'], 'string', 'max' => 20],
            [['order_no', 'order_by', 'contact_refference'], 'string', 'max' => 50],
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
            'order_no' => Yii::t('app', 'Order No'),
            'order_date' => Yii::t('app', 'Order Date'),
            'order_by' => Yii::t('app', 'Order By'),
            'contact_refference' => Yii::t('app', 'Contact Refference'),
            'required_date' => Yii::t('app', 'Required Date'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['order_id' => 'id']);
    }
}
