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
            <img src="<?php echo get_template_directory_uri(); ?>/images/sample.jpg"
                alt="サイトのロゴ" />
        </div>

        <?php
        $args = array(
            'theme_location'=>'main-menu',
            'menu_class'=>'menu',
            'container'=>'nav',
        );
        wp_nav_menu($args);
        ?>
    </header>