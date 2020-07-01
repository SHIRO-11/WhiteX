<?php get_header(); //header.phpを取得?>
<div id="content" class="main-content">
    <div class="main-article show-main-article">
        <?php if (have_posts()) : //条件分岐：投稿があるなら?>
        <?php while (have_posts()) : the_post(); //繰り返し処理開始?>

        <section <?php post_class(); //投稿の種類に応じたクラスを付加?>>
            <div class="date show-date">
                <?php the_time('Y.m.d'); //投稿日時を表示 パラメータで書式を指定?>
                (最終更新日:<?php the_modified_date('Y/m/d') ?>)
            </div>
            <h1 class='show-article-title'><?php the_title(); //投稿（固定ページ）のタイトルを表示?>
            </h1>
            <p class='show-category'><?php the_category(','); //投稿の属するカテゴリー名をすべて表示 パラメータで区切り文字を指定?>
            </p>
            <?php if (has_post_thumbnail()): ?>
            <img src="<?php the_post_thumbnail_url('full'); ?>"
                alt="各記事のサムネイル" class="thumbnail" />
            <?php endif; ?>
            <div class="blog-body">
                <?php the_content(); //投稿（固定ページ）の本文を表示?>
            </div>
        </section>

        <?php endwhile; // 繰り返し終了?>
        <?php else : //条件分岐：投稿が無い場合は?>

        <h2>投稿が見つかりません。</h2>
        <p>
            <a
                href="<?php echo esc_url(home_url('/')); ?>">トップページに戻る</a>
        </p>

        <?php endif; //条件分岐終了?>

    </div>

    <?php get_sidebar(); //sidebar.phpを取得?>
</div>
<?php get_footer(); //footer.phpを取得　PHPで終了するので閉じタグは不要です
