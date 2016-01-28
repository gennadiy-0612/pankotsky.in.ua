<?php
/**
 * User: Gennadiy Shcherbakha
 * Date: 08.04.2015
 * Time: 10:11
 */

use yii\widgets\LinkPager;

$this->title = 'Поиск по сайту';
//echo $pagination->getLinks( $absolute = false )["self"];

$finder = '<h2>Результаты поиска</h2><p>К сожелению ничего не найдено.</p>
           <p>Пожалуста попробуйте ввести одно слово.</p>';
foreach ($pages as $page) {
    $pattern = '/([\s]{1,5}[^\<\>]{0,100})(' . $a . ')([^\<\>]{0,100}[\s])/imu';
    $subject = $page->text;
    preg_match_all($pattern, $subject, $matches);
    $pag = new \frontend\models\Pages();
    $pagein = $pag->find()->where(['status' => '1', 'id_papka' => $page->id_papka])->all();
    $i = 1;
    $in = 0;
    $listpage = [];
    $list = [];

    foreach ($pagein as $pager) {
        $listpage[$pager->id] = $i++;
        $list[++$in] = $pager->title;
    }
    if (!empty($matches[2][0])) {
        $finder = '<h2><a href="/' . $page->id_papka . '/' . $listpage[$page->id] . '">' . $list[$listpage[$page->id]] . '</a></h2><p>';
        for ($i = 0; $i < (count($matches[2])); $i++) {
            if (!empty($matches[1][0]) | !empty($matches[2][0]) | !empty($matches[3][$i])) $finder .= ' ... ' . $matches[1][$i] . '<strong class="search">' . $matches[2][$i] . '</strong>' . $matches[3][$i] . ' ... ';
            else $finder .= '';
        }
    } else $finder = '<pre>' . var_dump($matches) . '</pre>';
}
//$data = explode(' ', $a);
//
//for($i=0, $j = 0; $i<count($data); ++$i){
//    if(!($data[$i] ==' ')) {
//        $data[$j] = $data[$i];
//        echo '<em>', $data[$j], ': ',  $j,' </em>';
//        ++$j;
//    }
//}
echo $finder;
//echo '<pre>' . var_dump(array_unique($data)) . '</pre>';
//echo '<pre>' . var_dump($data) . '</pre>';
?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>