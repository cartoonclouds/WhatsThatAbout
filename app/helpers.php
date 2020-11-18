<?php
/*
 * Helper function to return currently logged in user.
 *
 */
if (! function_exists('user')) {
    function user() {
        return optional(auth()->user());
    }
}

/*
 * Helper function to user Slugify anywhere.
 *
 */
if (! function_exists('slugify')) {
    function slugify(string $string, array $options = []) {
        $slugify = new Cocur\Slugify\Slugify($options);

        return $slugify->slugify($string);
    }
}
