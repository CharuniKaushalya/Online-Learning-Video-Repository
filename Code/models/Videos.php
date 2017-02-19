<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "videos".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $description
 * @property integer $creator
 * @property string $createDate
 * @property integer $rating
 * @property resource $image
 *
 * @property Comments[] $comments
 * @property SavedVideos[] $savedVideos
 * @property Users[] $users
 */
class Videos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $file;
    public static function tableName()
    {
        return 'videos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url', 'description','category_id'], 'required'],
            [['description'], 'string'],
            [['title'], 'unique'],
            [['category_id'], 'integer'],
            [['title', 'url'], 'string', 'max' => 100],
            [['file'], 'file','extensions' => 'png, jpg,gif,jpeg'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'url' => 'Url',
            'description' => 'Description',
            'creator' => 'Creator',
            'createDate' => 'Create Date',
            'rating' => 'Rating',
            'file' => 'Image',
            'category_id' => 'Select a Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['videos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSavedVideos()
    {
        return $this->hasMany(SavedVideos::className(), ['videos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['id' => 'users_id'])->viaTable('saved_videos', ['videos_id' => 'id']);
    }
}
