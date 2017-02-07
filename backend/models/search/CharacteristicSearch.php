<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Characteristic;

/**
 * CharacteristicSearch represents the model behind the search form about `backend\models\Characteristic`.
 */
class CharacteristicSearch extends Characteristic
{
    public function behaviors()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'language'], 'integer'],
            [['classify', 'name', 'units', 'specification'], 'safe'],
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
        $query = Characteristic::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'language' => $this->language,
        ]);

        $query->andFilterWhere(['like', 'classify', $this->classify])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'units', $this->units])
            ->andFilterWhere(['like', 'specification', $this->specification]);

        return $dataProvider;
    }
}
