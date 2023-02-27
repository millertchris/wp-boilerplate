<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
    <?php if (is_search()) { ?>
        <meta name="robots" content="noindex, nofollow">
    <?php } ?>

    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

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
                            'theme_location'     => 'main-menu',
                            'container'         => 'ul',
                            'items_wrap'         => '%3$s'
                        );
                        ?>
                        <?php wp_nav_menu($args); ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <main id="main" class="wrapper">