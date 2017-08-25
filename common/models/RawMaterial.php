<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "raw_material".
 *
 * @property integer $id
 * @property string $type
 * @property string $stock
 * @property string $description
 * @property string $brand
 * @property string $vendor
 * @property string $quantity
 * @property double $unit_price
 * @property string $notes
 */
class RawMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raw_material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['description', 'notes'], 'string'],
            [['quantity'], 'integer'],
            [['unit_price'], 'number'],
            [['type', 'stock', 'brand', 'vendor'], 'string', 'max' => 50],
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
            'stock' => Yii::t('app', 'Stock'),
            'description' => Yii::t('app', 'Description'),
            'brand' => Yii::t('app', 'Brand'),
            'vendor' => Yii::t('app', 'Vendor'),
            'quantity' => Yii::t('app', 'Quantity'),
            'unit_price' => Yii::t('app', 'Unit Price'),
            'notes' => Yii::t('app', 'Notes'),
        ];
    }
}
