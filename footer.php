</main>
<footer class="footer">
    <div class="wrapper">
        <div class="row">
            <div class="col">
                <nav class="footer-nav">
                    <?php
                    $args = array(
                        'theme_location' => 'footer-menu',
                        'container' => 'ul',
                        'items_wrap' => '%3$s'
                    );
                    ?>
                    <?php wp_nav_menu($args); ?>
                </nav>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>

</body>

</html>