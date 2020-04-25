<?php

namespace fwTools\all;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use stdClass;

class Models {
    const key = 'name';

    public function getAll() {
        foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'models/')), '/\.php$/') as $phpFile) {
            $obj = new stdClass();
            $obj->name = basename($phpFile->getFileName(), '.php');
            yield $obj;
        }
    }
}
