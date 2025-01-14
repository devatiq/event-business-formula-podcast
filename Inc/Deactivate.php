<?php
namespace EBFP;

class Deactivate {
    public static function deactivate() {
        // Code to run on plugin deactivation (e.g., clean up)
        flush_rewrite_rules();
    }
}