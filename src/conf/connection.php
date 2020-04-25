<?php

$connectionConnDataVariableExtractedFromDotConnFile = file_get_contents(__BASE_DIR__.'.conn');
$arrConnectionConnDataVariableExtractedFromDotConnFile = (explode(',',$connectionConnDataVariableExtractedFromDotConnFile));
$connectionConnDataVariableExtractedFromDotConnFileDb_name = str_replace(' ','',explode(':',$arrConnectionConnDataVariableExtractedFromDotConnFile[0])[1]);
$connectionConnDataVariableExtractedFromDotConnFileDb_nameUser = str_replace(' ','',explode(':',$arrConnectionConnDataVariableExtractedFromDotConnFile[1])[1]);
$connectionConnDataVariableExtractedFromDotConnFileDb_nameUserPass = str_replace(' ','',explode(':',$arrConnectionConnDataVariableExtractedFromDotConnFile[2])[1]);
$HOST = str_replace(' ','',explode(':',$arrConnectionConnDataVariableExtractedFromDotConnFile[3])[1]);
$conn = new PDO("mysql:host=$HOST;dbname=$connectionConnDataVariableExtractedFromDotConnFileDb_name;charset=utf8", $connectionConnDataVariableExtractedFromDotConnFileDb_nameUser, $connectionConnDataVariableExtractedFromDotConnFileDb_nameUserPass, array(PDO::ATTR_PERSISTENT => true));
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->exec("set names utf8");
