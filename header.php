<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<?php if (is_search()) { ?>
    <meta name="robots" content="noindex, nofollow">
<?php } ?>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
<?php wp_head(); ?>

</head>

<body <?php body_class('body'); ?>>

    <a href="#main" class="skip-nav">Skip navigation</a>

    <header class="header">
        <div class="wrapper">
            <div class="row">
                <div class="col">
                    <a class="logo" href="/" target="_self">Logo</a>
                </div>
                <div class="col">
                    <nav id="main-menu">
                        <?php
                            $args = array(
                                'theme_location' 	=> 'main-menu',
                                'container' 		=> 'ul',
                                'items_wrap' 		=> '%3$s'
                            );
                        ?>
                        <?php wp_nav_menu($args); ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>

<main id="main">