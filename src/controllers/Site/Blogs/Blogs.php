<?php

use model\Blogs;
include '../../../autoload.php';
$Controller = new Controller(new \model\Blogs(), $_REQUEST, 'بلاگ');
$Controller->Uploads(array('icon' => '../../../images/blogs/','image' => '../../../images/blogs/'),$_FILES);
function getByUri($uri){
    $Blogs = new Blogs();
    if ($uri != '') {
        $blog = $Blogs->getByUri($uri);
        if ($blog){
            return jsonEncode($blog);
        } else {
            return jsonEncode(array("status" => 'false'));
        }
    } else {
        return jsonEncode(array('status' => 'no uri'));
    }
}
$Controller->addMethod('byUri','getByUri',array($_REQUEST['uri']));
$Controller->do();
$Controller->castOutput();
