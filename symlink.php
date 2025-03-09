<?php
$target = '/home/zozytozy/laravel/storage/app/public'; // The storage directory
$link = '/home/zozytozy/public_html/storage'; // The public_html storage link

if (symlink($target, $link)) {
    echo "Symlink created successfully!";
} else {
    echo "Failed to create symlink. It may already exist.";
}
?>
