<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Stock".
 *
 * @property integer $idStock
 * @property string $Codigo
 * @property string $Nombre
 * @property string $Descripcion
 * @property string $Autor
 * @property integer $Cantidad
 * @property integer $CantidadDisponible
 *
 * @property Prestamos[] $prestamos
 */
class stock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['Codigo', 'Nombre', 'Descripcion', 'Autor', 'Cantidad', 'CantidadDisponible'], 'required'],
            [['Cantidad', 'CantidadDisponible'], 'integer'],
            [['Codigo'], 'string', 'max' => 11],
            [['Nombre', 'Autor'], 'string', 'max' => 50],
            [['Descripcion'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idStock' => 'Id Stock',
            'Codigo' => 'Codigo',
            'Nombre' => 'Nombre',
            'Descripcion' => 'Descripcion',
            'Autor' => 'Autor',
            'Cantidad' => 'Cantidad',
            'CantidadDisponible' => 'Cantidad Disponible',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(prestamos::className(), ['IdStock' => 'idStock']);
    }
}
