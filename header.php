<!DOCTYPE html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title><?php wp_title('|', true, 'right'); //ページタイトルを出力?><?php bloginfo('name'); //サイト名を表示?>
    </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="<?php echo get_stylesheet_uri(); //使用中テーマのスタイルシートURLを出力?>">
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/css/destyle.css" />
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/css/single.css" />
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/css/footer.css" />
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/css/sidebar.css" />
    <?php wp_head(); //wp_headはテーマの</head>タグ直前に必ず挿入します?>
    <!-- fontawsomeを読み込む -->
    <script src="https://kit.fontawesome.com/e9f491b3f6.js" crossorigin="anonymous"></script>
</head>

<body class="opacity">
    <header>
        <div id="logo">
            <img id="header-back-img"
                src="<?php echo get_the_header_img_url(); ?>"
                alt="ヘッダーの背景画像" />
            <div id="logo-back-o"></div>
            <img id="logo-img"
                src="<?php echo get_the_logo_img_url(); ?>"
                alt="ロゴ画像" />
            <h1><?php bloginfo('name'); ?>
            </h1>
            <p><?php bloginfo('description'); ?>
            </p>
        </div>

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