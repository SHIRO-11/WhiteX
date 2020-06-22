<?php get_header(); //header.phpを取得
?>

<div class="main-wrapper">
    <?php if (is_home() || is_front_page()) : ?>
    <?php
    $page_id_1 =  get_theme_mod('fixed_post-1', true);
    $content_1 = get_post($page_id_1);
    $page_id_2 =  get_theme_mod('fixed_post-2', true);
    $content_2 = get_post($page_id_2);
    $page_id_3 =  get_theme_mod('fixed_post-3', true);
    $content_3 = get_post($page_id_3);
    ?>
    <?php if ($content_1  != null || $content_2 != null || $content_3 != null) :?>

    <article class="main-fixed">
        <?php if ($content_1 != null) :?>
        <div class="fixed-article">
            <a href="index.html">
                <?php if (get_the_post_thumbnail_url($content_1->ID) != false): ?>
                <img src="<?php echo get_the_post_thumbnail_url($content_1->ID); ?>"
                    alt="固定記事のサムネイル1" />
                <?php else: ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg"
                    alt="no-image" />
                <?php endif; ?>
                <h2><?php echo $content_1->post_title; ?>
                </h2>
            </a>
        </div>
        <?php endif;?>
        <?php if ($content_2 != null) :?>
        <div class="fixed-article">
            <a href="index.html">
                <?php if (get_the_post_thumbnail_url($content_2->ID) != false): ?>
                <img src="<?php echo get_the_post_thumbnail_url($content_2->ID); ?>"
                    alt="固定記事のサムネイル2" />
                <?php else: ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg"
                    alt="no-image" />
                <?php endif; ?>
                <h2><?php echo $content_2->post_title; ?>
                </h2>
            </a>
        </div>
        <?php endif;?>
        <?php if ($content_3 != null) :?>
        <div class="fixed-article">
            <a href="index.html">
                <?php if (get_the_post_thumbnail_url($content_3->ID) != false): ?>
                <img src="<?php echo get_the_post_thumbnail_url($content_3->ID); ?>"
                    alt="固定記事のサムネイル3" />
                <?php else: ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg"
                    alt="no-image" />
                <?php endif; ?>
                <h2><?php echo $content_3->post_title; ?>
                </h2>
            </a>
        </div>
        <?php endif;?>
    </article>
    <?php endif;?>
    <?php endif; ?>

    <?php if (have_posts()) : //条件分岐：投稿があるなら?>
    <div class="main-content">
        <div class="main-article">
            <h1 class="archive-title">【<?php echo get_the_archive_title();//アーカイブページのタイトルを表示?>】
            </h1>
            <?php while (have_posts()) : the_post(); //繰り返し処理開始?>
            <a href="<?php the_permalink(); //投稿（固定ページ）のリンクを取得?>">
                <div class="article-content">
                    <?php if (has_post_thumbnail()): ?>
                    <img src="<?php the_post_thumbnail_url('full'); ?>"
                        alt="各記事のサムネイル" />
                    <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg"
                        alt="no-image" />
                    <?php endif; ?>
                    <h2 class="post-list-title"><?php the_title(); //投稿（固定ページ）のタイトルを表示?>
                    </h2>
                    <div class="date"><?php the_time('Y.m.d'); //投稿日時を表示 パラメータで書式を指定?>
                    </div>
                </div>
            </a>
            <?php endwhile; // 繰り返し終了?>
        </div>
        <?php else : //条件分岐：投稿が無い場合は?>

        <h2>投稿がみつかりません。</h2>
        <p><a
                href="<?php echo esc_url(home_url('/')); ?>">トップページに戻る</a>
        </p>
    </div>
    <?php endif; //条件分岐終了?>

    <?php get_sidebar(); //sidebar.phpを取得?>

</div>

<?php get_footer(); //footer.phpを取得　PHPで終了するので閉じタグは不要です
