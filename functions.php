<?php

/**
 * ウィジェットエリアを定義します。
 */
register_sidebar(array(

  'name'          => 'デモサイトのサイドバー',
  'id'            => 'primary-widget-area',
  'description'   => 'サイドバーに表示されるウィジェットエリアです。',
  'before_widget' => '<section id="%1$s" class="widget %2$s">',
  'after_widget'  => '</section>',
  'before_title'  => '<h3 class="widget-title">',
  'after_title'   => '</h3>',

));

// アイキャッチ画像を有効にする。
add_theme_support('post-thumbnails');

// カスタムメニュー機能を使用可能
register_nav_menu('main-menu', 'Main Menu');

//テーマカスタマイザーに項目を追加
function mytheme_customize_register($wp_customize)
{

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
}
add_action('customize_register', 'mytheme_customize_register');


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
