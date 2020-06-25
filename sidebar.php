<div class="side-bar">
    <?php if (get_theme_mod('profile_img')): ?>
    <section class="widget">
        <div class="wprofile-img">
        </div>
        <div class="wprofile-name">
            　<h3 class="widget-title"><?php echo get_option('profile_name', 'NO NAME'); ?>
            </h3>
        </div>
        <div class="wprofile-content">
            <p><?php echo get_option('profile_text', 'NO DESCRIPTION'); ?>
            </p>
        </div>

        <?php if (get_option('twitter_url_text')): ?>
        <div id="wprofile-twitter-wrapper">
            <div class="wprofile-twitter">
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