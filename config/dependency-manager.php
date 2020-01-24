<?php
const PATH_PUBLIC_ASSETS = __DIR__ . '/../public/assets';
const PATH_VENDOR = __DIR__ . '/../vendor';

$dependencies = [
    'bootstrap' => [
        'name' => 'bootstrap',
        'path' => PATH_VENDOR . '/twbs/bootstrap/dist',
    ],
    'jquery' => [
        'name' => 'jquery',
        'path' => PATH_VENDOR . '/../vendor/components/jquery',
    ],
];

foreach ($dependencies as $dependencie => $options) {
    $dir = $options['path'];
    if (is_dir($dir)) {
        $destiny = PATH_PUBLIC_ASSETS . '/' . $options['name'];
        if (is_dir($destiny)) {
            unlink($destiny);
        }
        symlink($dir, $destiny);
    }
}
