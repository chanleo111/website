<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BackEndUser;

/**
 * BackEndUserSearch represents the model behind the search form of `app\models\BackEndUser`.
 */
class BackEndUserSearch extends BackEndUser
{
    /**
     * {@inheritdoc}
     */
    public $roleid;
    
    public function rules()
    {
        return [
            [['id', 'tel', 'deleted', 'roleid'], 'integer'],
            [['username', 'password', 'email', 'authKey','roleid'], 'safe'],
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
        $query = BackEndUser::find()->joinWith(['roles']);

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
           'deleted' => 0,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
              ->andFilterWhere(['like', 'tel', $this->tel])
              ->andFilterWhere(['like', 'email', $this->email]);
        return $dataProvider;
    }
}
