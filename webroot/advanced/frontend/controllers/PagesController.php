<?php

namespace frontend\controllers;

use frontend\models\Pages;
use frontend\models\PagesSearch;
use frontend\models\Papka;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionShow($ch)
    {
        $query = Pages::find()->where(['status' => '1', 'id_papka' => $ch,]);

        $pagination = new Pagination([
            'defaultPageSize' => 1,
            'totalCount' => $query->count(),
            'pageParam' => 'i',
            'pageSizeParam' => 'p',
        ]);

        $pages = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('t', [
            'pages' => $pages,
            'pagination' => $pagination,
        ]);
    }


    public function actionMap()
    {
        $sett = new Papka();
        $list = new Pages();
        $r = $sett->find()->all();
        $name = '';
        $show = '';
        $all = '';
        foreach ($r as $page) {
            $show = $list->find()->where(['status' => '1', 'id_papka' => $page->id]);
            $listrows = $show->where(['status' => '1', 'id_papka' => $page->id])->all();
            $all = $show->count('*');
            $name .= '<li class="theme">' . $page->title . ' Всего: ' . $all . '</li>';
            $numpage = 0;
            foreach ($listrows as $rows) {
                $name .= '<li class="item"><a class="map" href="/' . $rows->id_papka . '/' . ++$numpage . '">' . $rows->title . '</a></li>';
            }
        }

        return $this->render('map', [
            'model' => $name,
        ]);
    }

    public function actionTextsearch()
    {
        if (strlen($_POST['text']) > 2) {
            $query = new Query;

            $query->select(['id', 'id_papka', 'title', 'text'])
                ->from('pages')
                ->where(['status' => '1'])->andWhere(['like', 'text', $_POST['text']])->limit(10);

            $all = $query->count('*');
            $name = '<h1 class="page-count">Найдено: ' . $all . ' стр.</h1>';
            foreach ($query->each() as $rowname) {
                $pattern = '/(' . $_POST['text'] . ')/';
                $replacement = '<strong class="search">$1</strong>';
                $finder = preg_replace($pattern, $replacement, $rowname['text']);
                $name .= '<h3 class="page-item">' . $rowname['title'] .
                    '<a class="page-link" href="/' . $rowname['id_papka'] . '?i=' . $rowname['id'] . '">
                         Читать...</a></h3><div class="finder">' . $finder . '</div>';
            }

            return $this->render('text-search', [
                'model' => $name,
            ]);
        } else {
            return $this->goHome();
        }
    }

    public function actionFirst()
    {
        $name = '';
        $query = new Query;

        $query->select(['id', 'id_papka', 'title', 'text', 'status'])
            ->from('pages')
            ->orderBy(['id' => SORT_DESC,])
            ->where(['status' => '1'])
            ->limit(2);
        foreach ($query->each() as $rowname) {
//            $pattern = '/(.{100})/';
//            $replacement = '<strong class="search">$1</strong>';
//            $finder = preg_replace($pattern, $replacement, $rowname['text']);
            $name .= '<h3>' . $rowname['title'] . '</h3>
            <div class="finder">' . $rowname['text'] . '
            <a class="page" href="/' . $rowname['id_papka'] . '?i=' . $rowname['id'] . '"> Читать...</a>
            </div>';
        }

        return $this->render('text-search', [
            'model' => $name,
        ]);
    }


    public function actionLastfoto()
    {
        $name = '';
        $query = new Query;

        $query->select(['id', 'id_papka', 'title', 'text', 'status'])
            ->from('pages')
            ->orderBy(['id' => SORT_DESC,])
            ->where(['status' => '1', 'id_papka' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],]);

        $number = 0;
        foreach ($query->each() as $rowname) {
            $pattern = '/(?P<foto><p class="polframe">.{250,450}<\/p>)(\r\n)(?P<note>.{0,500}<\/p>){1,2}/';
            $subject = $rowname['text'];
            preg_match($pattern, $subject, $matches);
            if (isset($matches[1]) && isset($matches[3]) && ($number < 12)) {
                $page['id_papka'] = $rowname['id_papka'];
                $page['id'] = $rowname['id'];
                $name .= '<div class="fotonote"><h2>
                          <a class="hrefer" href="' . $rowname['id_papka'] . '/' . $this->setAdress($rowname['id_papka'], $rowname['id']) . '">' . $rowname['title'] . '</a>
                          </h2>' . $matches[1] . $matches[3] . '</div>';
                $number++;
            }
        }
        return $this->render('lastfoto', [
            'model' => $name,
            'page' => $page,
        ]);
    }

    function actionI($id)
    {
        $name = '';
        $query = new Query;

        $query->select(['id', 'id_papka', 'title',])
            ->from('pages')
            ->orderBy(['id' => SORT_DESC,])
            ->where(['id' => $id, 'status' => '1'])
            ->limit(20);
        foreach ($query->each() as $rowname) {
            $name = $rowname['id_papka'];
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Pages::find()->where(['id' => $id, 'status' => '1', 'id_papka' => $name,]),
            'pagination' => [
                'pageSize' => 1,
                'pageParam' => 'i',
            ],
        ]);
        return $this->render('i', [
            'dataProvider' => $dataProvider,
        ]);
    }

    function actionT()
    {
        $query = Pages::find();

        $pagination = new Pagination([
            'defaultPageSize' => 1,
            'totalCount' => $query->count(),
            'pageParam' => 'i',
        ]);

        $pages = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('t', [
            'pages' => $pages,
            'pagination' => $pagination,
        ]);
    }

    function actionFindword()
    {

//        echo '<pre>', var_dump($_POST),'</pre>';
        $a = $_POST['text'];
//        $a = 'все';
        $query = Pages::find()->where(['status' => '1'])->andWhere(['like', 'text', $a]);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
            'pageParam' => 'i',
        ]);

        $pages = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('findword', [
            'pages' => $pages,
            'pagination' => $pagination,
            'a' => $a,
        ]);
    }

    function actionFindposition()
    {

//        echo '<pre>', var_dump($_POST),'</pre>';
        $a = $_POST['text'];
        $query = Pages::find()->where(['status' => '1'])->andWhere(['like', 'text', $a]);

        $pagination = new Pagination([
            'defaultPageSize' => 1,
            'totalCount' => $query->count(),
            'pageParam' => ['p' => $a,],
            'route' => ['#' => 'my-hash'],
        ]);

        $pages = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('findword', [
            'pages' => $pages,
            'pagination' => $pagination,
            'a' => $a,
        ]);
    }

    protected function setAdress($ch, $id)
    {
        $pag = new Pages();
        $pageins = $pag->find()->where(['status' => '1', 'id_papka' => $ch])->all();
        $i = 1;
        $in = 0;
        $listpage = [];
        $list = [];

        foreach ($pageins as $pager) {
            $listpage[$pager->id] = $i++;
            $list[++$in] = $pager->title;
        }
        return $listpage[$id];
    }
}
