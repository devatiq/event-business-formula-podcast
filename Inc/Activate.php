<?php
namespace EBFP;

class Activate {
    public static function activate() {
        // Code to run on plugin activation (e.g., create database tables)
        flush_rewrite_rules();
    }
}