<?php

/**
 * @var array $newsYears
 * @var array $themes
 * @var yii\data\Pagination $pages
 * @var array $selectedNews
 */

use yii\widgets\LinkPager;

$this->title = 'Новости';
?>
<h1 style="text-align: center">Новости</h1>
<div class="col-md-2">
    <p>Новости по годам</p>
    <?php foreach ($newsYears as $year => $months) { ?>
        <a style="line-height: 0.5"
           href="<?= Yii::$app->request->hostInfo . '/?attr=year&value=' . $year ?>"><?= $year ?></a>
        <br/>
        <?php foreach ($months as $month => $news) { ?>
            <a style="margin-left: 10%; line-height: 0.5"
               href="<?= Yii::$app->request->hostInfo . '/?attr=month&value=' . $news[0]->date ?>"><?= $month ?>
                (<?= count($news) ?>)</a>
            <br/>
        <?php } ?>
    <?php } ?>
    <br/>
    <hr/>
    <p>Новости по темам</p>
    <?php foreach ($themes as $theme) { ?>
        <a style="line-height: 0.5"
           href="<?= Yii::$app->request->hostInfo . '/?attr=theme&value=' . $theme->theme_id ?>"><?= $theme->theme_title ?>
            (<?= count($theme->news) ?>)</a>
        <br/>
    <?php } ?>
</div>
<div id="container" class="col-md-10" style="text-align: center">
    <?php if (isset ($selectedNews)) {
        foreach ($selectedNews as $news) { ?>
            <div id="div<?= $news->news_id ?>">
                <h4 style="line-height: 0.5"><?= $news->title ?></h4>
                <p style="line-height: 0.5; font-size: small"><?= $news->date ?></p>
                <p style="line-height: 0.5; font-style: italic"><?= $news->themes->theme_title ?></p>
                <p id="<?= $news->news_id ?>" class="text_review"><?= $news->text ?></p>
            </div>
        <?php } ?>
        <div style="bottom: 0; left: 50%; position: fixed">
            <?php echo LinkPager::widget([
                'pagination' => $pages
            ]) ?>
        </div>
    <?php } ?>
</div>

<script type="text/javascript">
    jQuery(".text_review").each(function () {
        var ID = jQuery(this).attr('id');
        var review_full = jQuery(this).html();
        var review = review_full;
        if (review.length > 256) {
            review = review.substring(0, 256);
            jQuery(this).html(review + '<div class="read_more" id="' + ID + '"> читать полностью &rarr;</div>');
        }
        jQuery(this).append('<div class="full_text" style="display: none;">' + review_full + '</div>');
    });
    jQuery(".read_more").click(function () {
        jQuery(this).parent().html(jQuery(this).parent().find(".full_text").html());
        var divId = 'div' + jQuery(this).attr('id');
        jQuery('#container').html(jQuery('#' + divId).html()).append('<a href="<?= Yii::$app->request->hostInfo ?>">Все новости</a>');
    });
</script>