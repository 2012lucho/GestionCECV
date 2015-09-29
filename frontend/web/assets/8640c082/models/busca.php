<?php

namespace app\modules\gestiondatos\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\gestiondatos\models\datosuser;

/**
 * datosuserb represents the model behind the search form about `app\modules\gestiondatos\models\datosuser`.
 */
class datosuserb extends datosuser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdUser'], 'integer'],
            [['NombreyApellido', 'DNI', 'Email', 'Telefono'], 'safe'],
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
        $query = datosuser::find();

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
            'IdUser' => $this->IdUser,
        ]);

        $query->andFilterWhere(['like', 'NombreyApellido', $this->NombreyApellido])
            ->andFilterWhere(['like', 'DNI', $this->DNI])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'Telefono', $this->Telefono]);

        return $dataProvider;
    }
}
