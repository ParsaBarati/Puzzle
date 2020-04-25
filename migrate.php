<?php
include 'src/autoload.php';
if ($conn->query(file_get_contents('puzzle_db.sql'))) {
    print 'migration done successfully';
} else {
    print 'migration failed';
}
