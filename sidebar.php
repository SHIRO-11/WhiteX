<div class="side-bar">
    <!-- プロフィール画像が設定されているなら表示 -->
    <?php if (get_theme_mod('profile_img')): ?>
    <section class="widget">
        <div class="wprofile-img">
        </div>
        <div class="wprofile-name">
            　<h4 class="widget-title"><?php echo get_option('profile_name', 'NO NAME'); ?>
            </h4>
        </div>
        <div class="wprofile-content">
            <!-- プロフィールのテキスト（自己紹介分）をカスタマイザーから呼び出す 第二引数は設定されていない時に表示するテキスト-->
            <p><?php echo get_option('profile_text', 'NO DESCRIPTION'); ?>
            </p>
        </div>
        <!-- TwitterのURLが設定されているなら表示 -->
        <?php if (get_option('twitter_url_text')): ?>
        <div id="wprofile-twitter-wrapper">
            <div class="wprofile-twitter">
                <!-- TwitterのURLを呼び出す -->
                <a
                    href="<?php echo get_option('twitter_url_text'); ?>">
                    Twitter
                </a>
            </div>
        </div>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <?php dynamic_sidebar('primary-widget-area');//ウィジェットエリア「デモサイトのサイドバー」を表示する?>
</div>