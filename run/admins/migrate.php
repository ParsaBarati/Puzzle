<?php

include '../../src/autoload.php';
$query = file_get_contents('../utils/admins.util');
if ($conn->query($query)) {
    print 'admins took place successfully!';
} else {
    print 'creating admins table encountered an error!';
}