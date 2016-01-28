<?php

namespace backend\models;

use Yii;
/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property integer $id_papka
 * @property string $title
 * @property string $text
 * @property string $status
 * @property integer $author
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_papka', 'title', 'text', 'author'], 'required'],
            [['id_papka', 'author'], 'integer'],
            [['status'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['text'], 'string', 'max' => 20000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'id_papka' => 'Раздел',
            'title' => 'Название страницы',
            'text' => 'Текст',
            'status' => 'Видно',
            'author' => 'Автор',
        ];
    }

}
