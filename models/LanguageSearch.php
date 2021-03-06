<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Language;

use app\models\Userlang;

/**
 * LanguageSearch represents the model behind the search form of `app\models\Language`.
 */
class LanguageSearch extends Language
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['meta_title', 'meta_description', 'name', 'content'], 'safe'],
			[['userlang_id'], 'string'],
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
        $query = Language::find();

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
        ]);

        $query->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content]);

        //custom complex search
        if (strlen($this->userlang_id)){                        
            $userlangs = Userlang::find()->select(['id', 'name'])->where(['like', 'name', $this->userlang_id])->all();

            if ($userlangs){
                foreach ($userlangs as $userlang){                                       
                    $query->orFilterWhere([
                        'userlang_id' => $userlang->id,
                    ]);                    
                }
            }
            else{
                $query->andFilterWhere(['like', 'userlang_id', $this->userlang_id]);
            }
        }
        else{
            $query->andFilterWhere(['like', 'userlang_id', $this->userlang_id]);
        }

        return $dataProvider;
    }
}
