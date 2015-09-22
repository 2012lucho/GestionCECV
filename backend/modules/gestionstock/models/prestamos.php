<?php

namespace app\modules\gestionstock\models;

use Yii;

/**
 * This is the model class for table "Prestamos".
 *
 * @property integer $idPresta
 * @property integer $idUser
 * @property integer $IdStock
 * @property string $FechaPresta
 * @property string $FechaDebT
 * @property string $FechaDeb
 *
 * @property DatosUser $idUser0
 * @property Stock $idStock
 */
class prestamos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Prestamos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'IdStock', 'FechaPresta', 'FechaDebT', 'FechaDeb'], 'required'],
            [['idUser', 'IdStock'], 'integer'],
            [['FechaPresta', 'FechaDebT', 'FechaDeb'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPresta' => 'Id Presta',
            'idUser' => 'Id User',
            'IdStock' => 'Id Stock',
            'FechaPresta' => 'Fecha Presta',
            'FechaDebT' => 'Fecha Deb T',
            'FechaDeb' => 'Fecha Deb',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser0()
    {
        return $this->hasOne(DatosUser::className(), ['IdUser' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStock()
    {
        return $this->hasOne(Stock::className(), ['idStock' => 'IdStock']);
    }
}