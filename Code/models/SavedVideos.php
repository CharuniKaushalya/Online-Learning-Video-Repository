<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "saved_videos".
 *
 * @property integer $videos_id
 * @property integer $users_id
 *
 * @property Users $users
 * @property Videos $videos
 */
class SavedVideos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'saved_videos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['videos_id', 'users_id'], 'required'],
            [['videos_id', 'users_id'], 'integer'],
            [['users_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['users_id' => 'id']],
            [['videos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Videos::className(), 'targetAttribute' => ['videos_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'videos_id' => 'Videos ID',
            'users_id' => 'Users ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'users_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasOne(Videos::className(), ['id' => 'videos_id']);
    }
}
