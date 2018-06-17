<?php

namespace app\models\searches;

use app\models\Item;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ItemSearch represents the model behind the search form of `app\models\Item`.
 */
class ItemSearch extends Item
{
    public $title;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string'],
        ];
    }

    public function formName()
    {
        return '';
    }

    /**
     * {@inheritdoc}
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
    public function search($params, $query = null)
    {
        if ($query == null) {
            $query = Item::find()->where(['status' => self::STATUS_ACTIVE]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
          //  'title' => $this->title,
            //   'status' => $this->status,
            //   'author_id' => $this->author_id,
            //   'created_at' => $this->created_at,
            //   'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'item.title', $this->title]);

        return $dataProvider;
    }
}