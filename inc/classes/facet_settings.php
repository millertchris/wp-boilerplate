<?php

class facet_settings {
    // =========================================================================
    // ADDING SUPPORT FOR FACETWP
    // =========================================================================
    static function main_query() {
        add_filter('facetwp_is_main_query', function ($bool, $query) {
            return (true === $query->get('facetwp')) ? true : $bool;
        }, 10, 2);
    }
}
