<?php
/**
 * Created by PhpStorm.
 * User: Gehh
 * Date: 03.04.2015
 * Time: 8:15
 */
use frontend\models\Pages;
use yii\widgets\LinkPager;

$this->title = $a;
//echo $pagination->getLinks( $absolute = false )["self"];

?>
        <?php foreach ($pages as $page): ?>
    <?php echo '<h1><a href="/',$page->id_papka, '/',$page->id,'">', $page->title,'</a></h1>'; ?>
    <?php
    $pattern = '/(\s[^\<\>]{0,100})('.$a.')([^\<\>]{0,100}\s)/';
    $subject = $page->text;
    preg_match_all($pattern, $subject, $matches);
//    echo '<pre>',var_dump($matches),'</pre>';
    echo '<h2>',$a,'</h2><p>... ',$matches[1][0],'<strong class="search">',$matches[2][0], '</strong>', $matches[3][0], ' ... '
               ,$matches[1][1],'<strong class="search">',$matches[2][1], '</strong>', $matches[3][1], ' ... '
               ,$matches[1][2],'<strong class="search">',$matches[2][2], '</strong>', $matches[3][2], ' </p>';
    ?>
<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $pagination]) ?>