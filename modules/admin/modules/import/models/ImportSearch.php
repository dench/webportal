<?php

namespace app\modules\admin\modules\import\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\modules\import\models\Import;

/**
 * ImportSearch represents the model behind the search form about `app\modules\admin\modules\import\models\Import`.
 */
class ImportSearch extends Import
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'format_id', 'date', 'created_at', 'enabled'], 'integer'],
            [['rate'], 'number'],
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
        $query = Import::find();

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
            'user_id' => $this->user_id,
            'format_id' => $this->format_id,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'rate' => $this->rate,
            'status' => $this->enabled,
        ]);

        return $dataProvider;
    }
}
