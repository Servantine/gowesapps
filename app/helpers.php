<?php
// app/helpers.php

if (!function_exists('renderStars')) {
    function renderStars($rating)
    {
        $rating = floatval($rating);
        $output = '';
        
        $fullStars = floor($rating);
        $halfStar = ($rating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

        for ($i = 0; $i < $fullStars; $i++) {
            $output .= '<i class="bi bi-star-fill"></i>';
        }

        if ($halfStar) {
            $output .= '<i class="bi bi-star-half"></i>';
        }

        for ($i = 0; $i < $emptyStars; $i++) {
            $output .= '<i class="bi bi-star"></i>';
        }

        return $output;
    }
}