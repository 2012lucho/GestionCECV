<?php

namespace app\modules\gestiondatos\models;

use Yii;

/**
 * This is the model class for table "DatosUser".
 *
 * @property integer $IdUser
 * @property string $NombreyApellido
 * @property string $DNI
 * @property string $Email
 * @property string $Telefono
 *
 * @property Prestamos[] $prestamos
 */
class datosuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'DatosUser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NombreyApellido', 'DNI', 'Email', 'Telefono'], 'required'],
            [['NombreyApellido', 'Email'], 'string', 'max' => 50],
            [['DNI'], 'string', 'max' => 12],
            [['Telefono'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdUser' => 'Id User',
            'NombreyApellido' => 'Nombrey Apellido',
            'DNI' => 'Dni',
            'Email' => 'Email',
            'Telefono' => 'Telefono',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamos::className(), ['idUser' => 'IdUser']);
    }
}
