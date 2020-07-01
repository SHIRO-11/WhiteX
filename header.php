<!DOCTYPE html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- デスクリプションを設定 -->
    <meta name="description"
        content="<?php echo strip_tags(get_the_excerpt()); ?>" />
    <!-- noindexの設定 -->
    <?php if (is_single() || is_page()): ?>
    <?php if (get_post_meta(get_the_ID(), 'noindex', true)) {
    echo'<meta name="robots" content="noindex"/>';
}; ?>
    <?php endif; ?>
    <!-- キーワードの設定 -->
    <?php if (get_post_meta(get_the_ID(), 'meta_keywords', true)) { ?>
    <meta name="keywords"
        content="<?php echo esc_attr($post->meta_keywords); ?>">
    <?php } ?>

    <title><?php wp_title('|', true, 'right'); //ページタイトルを出力?><?php bloginfo('name'); //サイト名を表示?>
    </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="<?php echo get_stylesheet_uri(); echo '?' . filemtime(get_stylesheet_directory() . '/style.css'); ?>"
        type="text/css" />
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/css/destyle.css" />
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/css/single.css" />
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/css/footer-1.css" />
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/css/sidebar.css" />
    <?php wp_head(); //wp_headはテーマの</head>タグ直前に必ず挿入します?>
    <!-- fontawsomeを読み込む -->
    <script src="https://kit.fontawesome.com/e9f491b3f6.js" crossorigin="anonymous"></script>
</head>

<body class="opacity">
    <header>
        <a
            href="<?php echo esc_url(home_url('/'));?>">
            <div id="logo">
                <img id="header-back-img"
                    src="<?php echo get_the_header_img_url(); ?>"
                    alt="ヘッダーの背景画像" />
                <div id="logo-back-o"></div>
                <?php if (get_the_logo_img_url()): ?>
                <div id="min-logo">
                    <img id="logo-img"
                        src="<?php echo get_the_logo_img_url(); ?>"
                        alt="ロゴ画像" />
                    <?php endif;?>
                    <?php if (is_home() || is_front_page()) : ?>
                    <h1><?php bloginfo('name'); ?>
                    </h1>
                    <?php else:?>
                    <p id="logo-site-title"><?php bloginfo('name'); ?>
                    </p>
                    <?php endif;?>
                    <p><?php bloginfo('description'); ?>
                    </p>
                </div>
            </div>
        </a>

        <div id="nav-drawer">
            <input id="nav-input" type="checkbox" class="nav-unshown">
            <label id="nav-open" for="nav-input">
                <div class="nav-menu-wrap">
                    <div>MENU</div><span></span>
                </div>
            </label>
            <label class="nav-unshown" id="nav-close" for="nav-input"></label>
            <div id="nav-content"> <?php
            $args = array(
                'theme_location'=>'main-menu',
                'menu_class'=>'menu',
                'container'=>'nav',
            );
            wp_nav_menu($args);
            ?>
            </div>
        </div>

        </div>
    </header>