<?php

/**
 * ウィジェットエリアを定義します。
 */
    function bj_register_sidebars()
    {
        register_sidebar(array(
            'id'            => 'primary-widget-area',
            'name'          => 'サイドバー',
            'description'   => 'サイドバーに表示されるウィジェットエリアです。',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));


        register_sidebar(array(
            'id'            => 'fotter-widget-menu', //ウィジェットのID
            'name'          => 'フッターメニュー', //ウィジェットの名前
            'description'   => 'フッターに表示されるウィジェットエリアです。', //ウィジェットの説明文
            'before_widget' => '<section id="%1$s" class="widget %2$s fotter-widget">', //ウィジェットを囲う開始タグ
            'after_widget'  => '</section>', //ウィジェットを囲う終了タグ
            'before_title'  => '<h3 class="fotter-widget-title">', //タイトルを囲う開始タグ
            'after_title'   => '</h3>', //タイトルを囲う終了タグ
        ));
    }

    add_action('widgets_init', 'bj_register_sidebars');


// アイキャッチ画像を有効にする。
add_theme_support('post-thumbnails');

// カスタムメニュー機能を使用可能
register_nav_menu('main-menu', 'Main Menu');

//カスタムHTMLでPHPを使えるようにする
function widget_text_exec_php($widget_text)
{
    if (strpos($widget_text, '<' . '?') !== false) {
        ob_start();
        eval('?>' . $widget_text);
        $widget_text = ob_get_contents();
        ob_end_clean();
    }
    return $widget_text;
}
add_filter('widget_text', 'widget_text_exec_php', 99);



//追加したヘッダー画像を呼び出す処理
function get_the_header_img_url()
{
    return esc_url(get_theme_mod('header_img'));
}

//追加したロゴ画像を呼び出す処理
function get_the_logo_img_url()
{
    return esc_url(get_theme_mod('logo_img'));
}

//追加したプロフィール画像を呼び出す処理
function get_the_profile_img_url()
{
    return esc_url(get_theme_mod('profile_img'));
}


//------------------------テーマカスタマイザーに項目を追加--------------
function mytheme_customize_register($wp_customize)
{

    //----------プロフィールを追加---------------
    //プロフィールのセクション
    $wp_customize->add_section('profile_section', array(
    'title' => 'プロフィール設定', //セクションのタイトル
    'priority' => '59', //セクションの位置
    'description' => 'プロフィールを編集してください', //セクションの説明
    ));

    //プロフィール画像
    $wp_customize->add_setting('profile_img'); //設定項目を追加
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'profile_img', array(
    'label' => 'プロフィール画像', //設定項目のタイトル
    'section' => 'profile_section', //セクションのIDを指定
    'settings' => 'profile_img', //セッティングのIDを指定
    'description' => 'プロフィール画像を設定してください。' //設定項目の説明
    )));

    //アカウント名前
    $wp_customize->add_setting('profile_name', array(
    'default' => 'アカウントの名前', //デフォルトで入るテキスト
    'type' => 'option', //入れておく
    ));
    $wp_customize->add_control('profile_name', array(
    'label' => 'アカウント名', //設定項目のタイトル
    'section' => 'profile_section', //セクションのIDを指定
    'setting' => 'profile_name', //セッティングのIDを指定
    'type' => 'text', //テキストを指定
    ));

    //自己紹介
    $wp_customize->add_setting('profile_text', array(
    'default' => '自己紹介', //デフォルトで入るテキスト
    'type' => 'option', //入れておく
    ));
    $wp_customize->add_control('profile_text', array(
    'label' => 'プロフィール文', //設定項目のタイトル
    'section' => 'profile_section', //セクションのIDを指定
    'setting' => 'profile_text', //セッティングのIDを指定
    'type' => 'textarea', //テキストエリアを指定
    ));

    //Twitterリンク
    $wp_customize->add_setting('twitter_url_text', array(
    'default' => '', //デフォルトで入るテキスト
    'type' => 'option', //入れておく
    ));
    $wp_customize->add_control('twitter_url_text', array(
    'label' => 'Twitterリンク', //設定項目のタイトル
    'section' => 'profile_section', //セクションのIDを指定
    'setting' => 'twitter_url_text', //セッティングのIDを指定
    'type' => 'text', //テキストエリアを指定
    ));



    //----------ヘッダー画像を追加---------------
    //画像のセクション追加
    $wp_customize->add_section('img_section', array(
        'title' => 'ヘッダー画像', //セクションのタイトル
        'priority' => 59, //セクションの位置
        'description' => '画像をアップロードしてください。', //セクションの説明
    ));

    // ヘッダー背景を追加
    $wp_customize->add_setting('header_img'); //設定項目を追加
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_img', array(
            'label' => 'ヘッダー画像', //設定項目のタイトル
            'section' => 'img_section', //追加するセクションのID
            'settings' => 'header_img', //追加する設定項目のID
            'description' => 'ロゴ画像を設定してください。', //設定項目の説明
        )));

    // ロゴ背景を追加
    $wp_customize->add_setting('logo_img'); //設定項目を追加
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_img', array(
            'label' => 'ロゴ画像', //設定項目のタイトル
            'section' => 'img_section', //追加するセクションのID
            'settings' => 'logo_img', //追加する設定項目のID
            'description' => 'ロゴ画像を設定してください。', //設定項目の説明
        )));


    //----------トップページに固定する記事---------------

    // セクションを追加
    $wp_customize->add_section(
        'fixed_posts',  // セクションを識別する「セクションID」を指定
        array(
            'title' => __('トップページに表示する固定記事', 'mytheme'), // 表示名を指定
            'priority'   => 30, // 表示順の優先度を指定
        )
    );
    // テーマ設定を追加
    $wp_customize->add_setting(
        'fixed_post-1', // テーマ設定を識別する「テーマ設定ID」を指定
        array(
            'default'     => null, // デフォルト値を設定
            'sanitize_callback' => 'absint', // 値のサニタイズを行う関数を指定（バリデーションみたいなもの）
        )
    );

    // 「セクション」と「テーマ設定」を紐づけてコントロール（テーマカスタマイザーに表示する入力フォーム）を出力
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'fixed_post-control-1', // コントロールを識別する「コントロールID」を指定
            array(
                'label'      => '1つ目の固定ページを指定', // 表示名を指定
        'section'    => 'fixed_posts', // セクションIDを指定
                'settings'   => 'fixed_post-1', // 設定IDを指定
        'priority'   => 30, // 表示順の優先度を指定
        'type'      => 'number', // フォームの種類を指定
            )
        )
    );

    // テーマ設定を追加
    $wp_customize->add_setting(
        'fixed_post-2', // テーマ設定を識別する「テーマ設定ID」を指定
        array(
            'default'     => '', // デフォルト値を設定
            'sanitize_callback' => 'absint', // 値のサニタイズを行う関数を指定（バリデーションみたいなもの）
        )
    );

    // 「セクション」と「テーマ設定」を紐づけてコントロール（テーマカスタマイザーに表示する入力フォーム）を出力
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'fixed_post-control-2', // コントロールを識別する「コントロールID」を指定
            array(
                'label'      => '2つ目の固定ページを', // 表示名を指定
        'section'    => 'fixed_posts', // セクションIDを指定
                'settings'   => 'fixed_post-2', // 設定IDを指定
        'priority'   => 30, // 表示順の優先度を指定
        'type'      => 'number', // フォームの種類を指定
            )
        )
    );

    // テーマ設定を追加
    $wp_customize->add_setting(
        'fixed_post-3', // テーマ設定を識別する「テーマ設定ID」を指定
        array(
            'default'     => '', // デフォルト値を設定
            'sanitize_callback' => 'absint', // 値のサニタイズを行う関数を指定（バリデーションみたいなもの）
        )
    );

    // 「セクション」と「テーマ設定」を紐づけてコントロール（テーマカスタマイザーに表示する入力フォーム）を出力
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'fixed_post-control-3', // コントロールを識別する「コントロールID」を指定
            array(
                'label'      => '3つ目の固定ページを', // 表示名を指定
        'section'    => 'fixed_posts', // セクションIDを指定
                'settings'   => 'fixed_post-3', // 設定IDを指定
        'priority'   => 30, // 表示順の優先度を指定
        'type'      => 'number', // フォームの種類を指定
            )
        )
    );

    // ----------色系のカスタマイザーの設定---------

    //背景色変更のセッティング＆コントロール
    $wp_customize->add_setting('all_background_color', array(
        'default' => '#f7f7f7',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'all_background_color', array(
        'label' => '背景色',
        'section' => 'colors',
        'settings' => 'all_background_color',
        'priority' => 1,
    )));

    //ヘッダーh1の文字色
    $wp_customize->add_setting('header_h1_color', array(
        'default' => '#7b7b7b',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_h1_color', array(
        'label' => 'ヘッダータイトルの文字色',
        'section' => 'colors',
        'settings' => 'header_h1_color',
        'priority' => 3,
    )));


    //説明の文字色
    $wp_customize->add_setting('description_color', array(
        'default' => '#7b7b7b',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'description_color', array(
        'label' => 'ヘッダー説明文の文字色',
        'section' => 'colors',
        'settings' => 'description_color',
        'priority' => 5,
    )));



    // アンダーラインの色を指定するセッティング&コントロール
    $wp_customize->add_setting('under_line_color', array(
        'default' => '#000',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'under_line_color', array(
        'label' => 'サイドメニューとアーカイブ名のアンダーラインの色',
        'section' => 'colors',
        'settings' => 'under_line_color',
        'priority' => 22,
    )));

    // ナビゲーション背景の色を指定するセッティング&コントロール
    $wp_customize->add_setting('nav_background_color', array(
        'default' => '#000',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nav_background_color', array(
        'label' => 'ナビゲーション背景',
        'section' => 'colors',
        'settings' => 'nav_background_color',
        'priority' => 20,
    )));

    // ナビゲーション の文字色

    $wp_customize->add_setting('nav_text_color', array(
        'default' => '#fff',
    ));


    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nav_text_color', array(
        'label' => 'ナビゲーションの文字色',
        'section' => 'colors',
        'settings' => 'nav_text_color',
        'priority' => 20,
    )));


    //ナビゲーションのhover時の文字色変更のセッティング＆コントロール
    $wp_customize->add_setting('nav_hover_color', array(
        'default' => '#7b7b7b',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nav_hover_color', array(
        'label' => 'ナビゲーションhover時の文字色',
        'section' => 'colors',
        'settings' => 'nav_hover_color',
        'priority' => 21,
    )));

    //ナビゲーションのhover時の背景色変更のセッティング＆コントロール
    $wp_customize->add_setting('nav_hover_back_color', array(
        'default' => '#fff',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nav_hover_back_color', array(
        'label' => 'ナビゲーションhover時の背景色',
        'section' => 'colors',
        'settings' => 'nav_hover_back_color',
        'priority' => 23,
    )));

    //サイドバーhover時の文字色のセッティング＆コントロール
    $wp_customize->add_setting('side_hover_text_color', array(
        'default' => '#007bff',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'side_hover_text_color', array(
        'label' => 'サイドバーのテキストhover時の文字色',
        'section' => 'colors',
        'settings' => 'side_hover_text_color',
        'priority' => 30,
    )));

    //フッターの背景色のセッティング＆コントロール
    $wp_customize->add_setting('fotter_background_color', array(
        'default' => '#f7f7f7',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'fotter_background_color', array(
        'label' => 'フッターの背景色',
        'section' => 'colors',
        'settings' => 'fotter_background_color',
        'priority' => 40,
    )));

    //コピーライトの文字色のセッティング＆コントロール
    $wp_customize->add_setting('copyright_text_color', array(
        'default' => '#f7f7f7',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'copyright_text_color', array(
        'label' => 'コピーライトの文字色',
        'section' => 'colors',
        'settings' => 'copyright_text_color',
        'priority' => 43,
    )));


    //コピーライトの背景色のセッティング＆コントロール
    $wp_customize->add_setting('copyright_background_color', array(
        'default' => '#000',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'copyright_background_color', array(
        'label' => 'コピーライトの背景色',
        'section' => 'colors',
        'settings' => 'copyright_background_color',
        'priority' => 45,
    )));
}
add_action('customize_register', 'mytheme_customize_register');


function customizer_color()
{
    //変数に各セクションの色を代入
    $under_line_color = get_theme_mod('under_line_color', '#000');
    $nav_background_color = get_theme_mod('nav_background_color', '#000');
    $nav_hover_color = get_theme_mod('nav_hover_color', '#7b7b7b');
    $nav_hover_back_color = get_theme_mod('nav_hover_back_color', '#fff');
    $all_background_color = get_theme_mod('all_background_color', '#007bff');

    $side_hover_text_color = get_theme_mod('side_hover_text_color', '#007bff');
    $nav_text_color = get_theme_mod('nav_text_color', '#fff');
    $description_color = get_theme_mod('description_color', '#7b7b7b');
    $header_h1_color = get_theme_mod('header_h1_color', '#7b7b7b');
    //フッターの背景色
    $fotter_background_color = get_theme_mod('fotter_background_color', '#f7f7f7');
    //コピーライトの文字色
    $copyright_text_color = get_theme_mod('copyright_text_color', '#f7f7f7');

    //コピーライトの背景色
    $copyright_background_color = get_theme_mod('copyright_background_color', '#000'); ?>



<!-- headにスタイルシートを追加 -->
<style type="text/css">
    /* 背景色 */
    body,
    .main-wrapper,
    .main-content,
    .side-bar {
        background-color:
            <?php echo $all_background_color; ?>
        ;
    }

    .wprofile-img {
        background-image: url("<?php echo get_the_profile_img_url(); ?>");
        /* 表示する画像 */
    }

    /* 説明文の文字色 */
    #logo h1 {
        color:
            <?php echo $header_h1_color; ?>
        ;
    }

    /* 説明文の文字色 */
    #logo p {
        color:
            <?php echo $description_color; ?>
        ;
    }


    /* アンダーラインの色のcss */
    .new-archive-title:before,
    .widget .widget-title:before {
        background-color:
            <?php echo $under_line_color; ?>
        ;
    }

    /* ナビゲーション背景のcss */
    nav {
        background-color:
            <?php echo $nav_background_color; ?>
        ;
    }

    /* ナビゲーションの文字色と右線のcss */
    .menu>li>a {
        color:
            <?php echo $nav_text_color; ?>
        ;
    }

    .menu>li {
        border-right: 1px solid
            <?php echo $nav_text_color; ?>
    }

    /* ナビゲーションhover時の文字色 */
    .menu>li>a:hover,
    .menu>li>ul>li:hover>a,
    .menu>li>ul>li>ul>li:hover>a {
        color:
            <?php echo $nav_hover_color; ?>
        ;
    }

    /* ナビゲーションhover時の背景色 */
    .menu li::before {
        background:
            <?php echo $nav_hover_back_color; ?>
        ;
    }

    /* サイドバーhover時の文字色 */
    .widget:hover h3,
    .widget_categories>ul>li>a:hover,
    .widget_categories>ul>li>ul>li>a:hover,
    .widget_archive ul li a:hover {
        color:
            <?php echo $side_hover_text_color; ?>
        ;
    }

    footer {
        background-color:
            <?php echo $fotter_background_color; ?>
        ;
    }

    #copyright {
        background-color:
            <?php echo $copyright_background_color; ?>
        ;
    }

    #copyright p {
        color:
            <?php echo $copyright_text_color; ?>
        ;
        ;
    }
</style>
<?php
}
add_action('wp_head', 'customizer_color');





/* 投稿一覧にIDの列を追加 */
function add_posts_columns_postid($columns)
{
    $columns['postid'] = 'ID';
    echo '';
    return $columns;
}
add_filter('manage_posts_columns', 'add_posts_columns_postid');
add_filter('manage_pages_columns', 'add_posts_columns_postid');

//IDを表示
function custom_posts_columns_postid($column_name, $post_id)
{
    if ('postid' == $column_name) {
        echo $post_id;
    }
}
add_action('manage_posts_custom_column', 'custom_posts_columns_postid', 10, 2);
add_action('manage_pages_custom_column', 'custom_posts_columns_postid', 10, 2);

//ソート可能にする
function sort_posts_columns_postid($columns)
{
    $columns['postid'] = 'ID';
    return $columns;
}
add_filter('manage_edit-post_sortable_columns', 'sort_posts_columns_postid');
add_filter('manage_edit-page_sortable_columns', 'sort_posts_columns_postid');


//カテゴリ・アーカイブウィジェットの投稿数のカッコを取り除く
function remove_post_count_parentheses($output)
{
    $output = preg_replace('/<\/a>.*\((\d+)\)/', '<span class="post-count">$1</span></a>', $output);
    return $output;
}
add_filter('wp_list_categories', 'remove_post_count_parentheses');
add_filter('get_archives_link', 'remove_post_count_parentheses');

//アーカイブ系の名前を変更
function my_archive_title($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_date()) {
        $title = single_cat_title('', false);
    }
    $title = $title. 'に関する記事一覧';
    return $title;
};
add_filter('get_the_archive_title', 'my_archive_title');

//アーカイブタイトルを変更する
function my_theme_archive_title($title)
{
    if (is_post_type_archive() && !is_date()) {
        $title = post_type_archive_title('', false);
    } elseif (is_date()) {
        $date  = single_month_title('', false);
        $point = strpos($date, '月');
        $title = mb_substr($date, $point+1).'年'.mb_substr($date, 0, $point+1);
    }

    return $title;
}

add_filter('get_the_archive_title', 'my_theme_archive_title');
