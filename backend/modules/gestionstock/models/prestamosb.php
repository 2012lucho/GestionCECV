<?php

namespace app\modules\gestionstock\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\gestionstock\models\prestamos;

/**
 * prestamosb represents the model behind the search form about `app\modules\gestionstock\models\prestamos`.
 */
class prestamosb extends prestamos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPresta', 'idUser', 'IdStock'], 'integer'],
            [['FechaPresta', 'FechaDebT', 'FechaDeb'], 'safe'],
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
        $query = prestamos::find();

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
            'idPresta' => $this->idPresta,
            'idUser' => $this->idUser,
            'IdStock' => $this->IdStock,
            'FechaPresta' => $this->FechaPresta,
            'FechaDebT' => $this->FechaDebT,
            'FechaDeb' => $this->FechaDeb,
        ]);

        return $dataProvider;
    }
}
