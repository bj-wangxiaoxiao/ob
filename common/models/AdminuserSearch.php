<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AdminUser;

/**
 * AdminuserSearch represents the model behind the search form of `common\models\AdminUser`.
 */
class AdminuserSearch extends AdminUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['admin_user_id', 'is_deleted', 'create_time', 'update_time'], 'integer'],
            [['name', 'phone', 'nickname', 'avatar', 'email', 'password', 'pwd_salt', 'introduction', 'last_login_ip'], 'safe'],
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
        $query = AdminUser::find();

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
            'admin_user_id' => $this->admin_user_id,
            'is_deleted' => $this->is_deleted,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'pwd_salt', $this->pwd_salt])
            ->andFilterWhere(['like', 'introduction', $this->introduction])
            ->andFilterWhere(['like', 'last_login_ip', $this->last_login_ip]);

        return $dataProvider;
    }
}
