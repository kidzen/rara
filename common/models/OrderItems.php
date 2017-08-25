<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $type
 * @property string $item
 * @property string $description
 * @property integer $quantity
 * @property string $quantity_unit
 * @property integer $weight
 * @property string $weight_unit
 * @property integer $size
 * @property string $size_unit
 * @property double $unit_price
 * @property string $time_required
 * @property string $notes
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Orders $order
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'quantity', 'weight', 'size', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description', 'notes'], 'string'],
            [['unit_price'], 'number'],
            [['time_required'], 'safe'],
            [['type'], 'string', 'max' => 20],
            [['item'], 'string', 'max' => 50],
            [['quantity_unit', 'weight_unit', 'size_unit'], 'string', 'max' => 10],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'type' => Yii::t('app', 'Type'),
            'item' => Yii::t('app', 'Item'),
            'description' => Yii::t('app', 'Description'),
            'quantity' => Yii::t('app', 'Quantity'),
            'quantity_unit' => Yii::t('app', 'Quantity Unit'),
            'weight' => Yii::t('app', 'Weight'),
            'weight_unit' => Yii::t('app', 'Weight Unit'),
            'size' => Yii::t('app', 'Size'),
            'size_unit' => Yii::t('app', 'Size Unit'),
            'unit_price' => Yii::t('app', 'Unit Price'),
            'time_required' => Yii::t('app', 'Time Required'),
            'notes' => Yii::t('app', 'Notes'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }
}
