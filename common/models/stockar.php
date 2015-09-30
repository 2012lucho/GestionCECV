<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\stock;

use yii\helpers\BaseJson;
/**
 * stockbusca represents the model behind the search form about `app\modules\gestionstock\models\stock`.
 */
class stockar extends stock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idStock', 'Cantidad', 'CantidadDisponible'], 'integer'],
            [['Codigo', 'Nombre', 'Descripcion', 'Autor'], 'safe'],
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
        $query = stock::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idStock' => $this->idStock,
            'Cantidad' => $this->Cantidad,
            'CantidadDisponible' => $this->CantidadDisponible,
        ]);

        $query->andFilterWhere(['like', 'Codigo', $this->Codigo])
              ->andFilterWhere(['like', 'Nombre', $this->Nombre])
              ->andFilterWhere(['like', 'Descripcion', $this->Descripcion])
              ->andFilterWhere(['like', 'Autor', $this->Autor]);

        return $dataProvider;
    }
}
