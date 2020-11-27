<?php

/*
 * Helper function to return currently logged in user.
 *
 */
if (! function_exists('user')) {
    function user()
    {
        return optional(auth()->user());
    }
}

/*
 * Helper function to Slugify a string.
 *
 */
if (! function_exists('slugify')) {
    function slugify(string $string, array $options = [])
    {
        $slugify = new Cocur\Slugify\Slugify($options);

        return $slugify->slugify($string);
    }
}


/*
 * Helper function to generate a generic (SVG) placeholder image.
 *
 */
if (! function_exists('placeholder')) {
    function placeholder()
    {
        $title = implode(' ', func_get_args());

        $text = collect(func_get_args())->map(function ($line, $lineIdx) {
            $y = 50 + ($lineIdx * 10);
            return "<tspan x='50%' y='$y%'>$line</tspan>";
        })->implode('');

        return <<<EOT
<svg width="100%" height="100%"  role="img"
     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

    <rect width="100%" height="100%" fill="#868e96"/>
    <text pointer-events="none" style="user-select: none" x="50%" y="50%" fill="#dee2e6" text-anchor="middle">
        $text
    </text>
    <title>$title</title>
</svg>
EOT;
    }
}
