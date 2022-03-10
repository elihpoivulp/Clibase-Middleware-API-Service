<?php

if (!function_exists('load_asset')) {
    function load_asset($asset_filename) {
        return base_url('app_assets/' . trim($asset_filename, '/'));
    }
}