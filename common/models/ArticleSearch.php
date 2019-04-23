<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * ArticleSearch represents the model behind the search form of `common\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'cate_id', 'user_id', 'user_type', 'click', 'is_comment', 'is_recommend', 'is_hot', 'is_new', 'is_deleted', 'create_time', 'update_time'], 'integer'],
            [['thumbnail', 'writer', 'title', 'desc', 'keyword', 'content'], 'safe'],
        ];
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
    public function search($params)
    {
        $query = Article::find();

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
            'article_id' => $this->article_id,
            'cate_id' => $this->cate_id,
            'user_id' => $this->user_id,
            'user_type' => $this->user_type,
            'click' => $this->click,
            'is_comment' => $this->is_comment,
            'is_recommend' => $this->is_recommend,
            'is_hot' => $this->is_hot,
            'is_new' => $this->is_new,
            'is_deleted' => $this->is_deleted,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'thumbnail', $this->thumbnail])
            ->andFilterWhere(['like', 'writer', $this->writer])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
