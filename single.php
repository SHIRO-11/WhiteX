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
        <section class="posts-navigation">
            <div class="nav-links">
                <div class="nav-previous">
                    <?php next_post_link('%link', '&laquo; 新しい投稿へ'); //新しい記事へのリンクを表示?>
                </div>
                <div class="nav-next">
                    <?php previous_post_link('%link', '古い投稿へ &raquo;'); //古い記事へのリンクを表示?>
                </div>
            </div>
        </section>


        <!-- 関連記事の表示 -->
        <?php
        $categ = get_the_category($post->ID);
        $catID = array();

        foreach ($categ as $cat) {
            array_push($catID, $cat -> cat_ID);
        }

        $args = array(
            'post__not_in' => array($post->ID),
            'category__in' => $catID,
            'posts_per_page' => 4,
            'orderby' => 'rand'
        );

        $the_query = new WP_Query($args);
        if ($the_query -> have_posts()) :?>

        <div class="related-wrapper">
            <h4>関連記事</h4>
            <?php while ($the_query -> have_posts()) : $the_query -> the_post();?>
            <div class="related-article">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail() ?>
                    <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg"
                        alt="no-image" />
                    <?php endif; ?>
                </a>
                <div class="post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>
                <div class="related-post-category">
                    <?php the_category(); ?>
                </div>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
        <!-- 関連記事ここまで -->

        <?php endif; wp_reset_postdata(); ?>
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
