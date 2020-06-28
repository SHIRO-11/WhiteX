<?php get_header(); //header.phpを取得
?>

<div class="main-wrapper">
    <div class="main-content">
        <div class="main-article">
            <div class="no-content">
                <h2>投稿がみつかりませんでした。</h2>
                <p><a
                        href="<?php echo esc_url(home_url('/')); ?>">トップページに戻る</a>
                </p>
            </div>
        </div>

        <?php get_sidebar(); //sidebar.phpを取得?>
    </div>

</div>

<?php get_footer(); //footer.phpを取得　PHPで終了するので閉じタグは不要です
