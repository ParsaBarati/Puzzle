<?php
include '../../src/autoload.php';
$stateQuery = file_get_contents('../utils/states.util');
$cityQuery = file_get_contents('../utils/cities.util');
if ($conn->query($stateQuery.$cityQuery)) {
        print 'states and cities took place successfully!';
} else {
    print 'creating states and cities table encountered an error!';
}