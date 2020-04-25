<?php

define('__SOURCE__', substr(__DIR__, 0, strpos(__DIR__, 'src') + 3) . DIRECTORY_SEPARATOR);
foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'dist/php/Database/')), '/\.php$/') as $phpFile) {
    include __SOURCE__ . "dist/php/Database/" . explode("/dist/php/Database/", $phpFile->getRealPath())[1];
}
