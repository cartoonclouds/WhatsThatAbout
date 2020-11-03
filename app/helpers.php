<?php
/*
 * Helper function to return currently logged in user.
 *
 */
if (! function_exists('user')) {
    function user() {
        return auth()->user();
    }
}
