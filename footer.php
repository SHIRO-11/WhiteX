    <footer>
        <?php dynamic_sidebar('fotter-widget-menu');//ウィジェットエリア「デモサイトのサイドバー」を表示する?>
        <div id="copyright">
            <p>Copyright &copy; <?php bloginfo('name'); ?>
            </p>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS, then Font Awesome -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript"
        src="<?php echo get_template_directory_uri();?>/js/block.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>

    <?php wp_footer(); ?>
    </body>

    </html>