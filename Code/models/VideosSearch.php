<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Videos;
use app\models\Users;


/**
 * VideosSearch represents the model behind the search form about `app\models\Videos`.
 */
class VideosSearch extends Videos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creator', 'rating'], 'integer'],
            [['title', 'url', 'description', 'createDate'], 'safe'],
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
       // $query = Videos::find();
        if(Yii::$app->user->identity->role==100){
            $query = Videos::find();
        }else{
            $query = Videos::find()->where(['creator' => Yii::$app->user->identity->id]);
        }

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
            'createDate' => $this->createDate,
            'creator' => $this->creator,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

    public function globalsearch($params)
    {
       // $query = Videos::find();
        if(Yii::$app->user->identity->role==100){
            $query = Videos::find();
        }else{
            $query = Videos::find()->where(['creator' => Yii::$app->user->identity->id]);
        }

        // add conditions that should always apply here

        $query->orFilterWhere(['like', 'title', $params])
            ->orFilterWhere(['like', 'url', $params])
            ->orFilterWhere(['like', 'description', $params]);


        return $query->all();
    }
}
