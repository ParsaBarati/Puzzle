<?php
$ConfigDataVariableExtractedFromDotConfigFile = file_get_contents(__BASE_DIR__.'.config');
$ConfigDataVariableExtractedFromDotConfigFileArr = (explode(',',$ConfigDataVariableExtractedFromDotConfigFile));
$ConfigDataVariableExtractedFromDotConfigFileDevelopment = str_replace(' ','',explode(':',$ConfigDataVariableExtractedFromDotConfigFileArr[0])[1]);
$ConfigDataVariableExtractedFromDotConfigFileDebug= str_replace(' ','',explode(':',$ConfigDataVariableExtractedFromDotConfigFileArr[1])[1]);
$ConfigDataVariableExtractedFromDotConfigFileProd = str_replace('','',explode(':',$ConfigDataVariableExtractedFromDotConfigFileArr[2])[1]);
$ConfigDataVariableExtractedFromDotConfigFileProjectName = str_replace(' ','',explode(':',$ConfigDataVariableExtractedFromDotConfigFileArr[3])[1]);
$ConfigDataVariableExtractedFromDotConfigFileDarkMode = str_replace(' ','',explode(':',$ConfigDataVariableExtractedFromDotConfigFileArr[4])[1]);
$DEVELOPMENT = $ConfigDataVariableExtractedFromDotConfigFileDevelopment == 'true' ? true : false;
$DEBUG = $ConfigDataVariableExtractedFromDotConfigFileDebug == 'true' ? true : false;
$PROD = $ConfigDataVariableExtractedFromDotConfigFileProd == 'true' ? true : false;
$DARK_MODE = $ConfigDataVariableExtractedFromDotConfigFileDarkMode == 'true' ? true : false;
$PROJECT__NAME = $ConfigDataVariableExtractedFromDotConfigFileProjectName != '' ? $ConfigDataVariableExtractedFromDotConfigFileProjectName : 'پروژه';
