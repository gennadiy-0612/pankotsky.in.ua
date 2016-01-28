<?php
/**
 * Created by PhpStorm.
 * User: Gehh
 * Date: 08.04.2015
 * Time: 8:23
 */

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Pages;
use yii\data\Pagination;
use yii\web\Session;
use yii\filters\VerbFilter;


class FinderController extends Controller {
    /**
     * PagesController implements the CRUD actions for Pages model.
     */
    public function behaviors()
    {
        {
            return [
                'verbs' => [
                    'class' => \yii\filters\VerbFilter::className(),
                    'actions' => [
                        'index' => ['get', 'post'],
                    ],
                ],
            ];
        }
    }

    /**
     * PagesController implements the CRUD actions for Pages model.
     */
    function actionIndex()
    {
        $session = new Session;
        $session->open();
        if(!empty($_POST['text'])) {
            $session['text'] = $a = trim($_POST['text']);
        }
        else $a = $session['text'];
        $query = Pages::find()->where(['status' => '1'])->andWhere(['like', 'text', $a]);
        $pagination = new Pagination([
            'defaultPageSize' => 1,
            'totalCount' => $query->count(),
            'pageParam' => 'i',
        ]);

        $pages = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'pages' => $pages,
            'pagination' => $pagination,
            'a' => $a,
        ]);
    }
}