<?php
include '../../models/DATABASE.php';
$path = '../../models/';
$tables = array();
$allFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
$phpFiles = new RegexIterator($allFiles, '/\.php$/');
foreach ($phpFiles as $phpFile) {
    if ($phpFile->getRealPath() != '/home/doponder/public_html/admin/models/DATABASE.php' and $phpFile->getPath() != '../../models/Club'){
        $filename = $phpFile->getFileName();
        include $path.explode("/models/",$phpFile->getRealPath())[1];
    }

    $content = file_get_contents($phpFile->getRealPath());
    $tokens = token_get_all($content);
    $namespace = '';
    for ($index = 0; isset($tokens[$index]); $index++) {
        if (!isset($tokens[$index][0])) {
            continue;
        }
        if (T_NAMESPACE === $tokens[$index][0]) {
            $index += 2; // Skip namespace keyword and whitespace
            while (isset($tokens[$index]) && is_array($tokens[$index])) {
                $namespace .= $tokens[$index++][1];
            }
        }
        if (T_CLASS === $tokens[$index][0] && T_WHITESPACE === $tokens[$index + 1][0] && T_STRING === $tokens[$index + 2][0]) {
            $index += 2; // Skip class keyword and whitespace
            if ($namespace == 'model') {
                $fqcns[] = $namespace . '\\' . $tokens[$index][1];
            }
            # break if you have one class per file (psr-4 compliant)
            # otherwise you'll need to handle class constants (Foo::class)
            break;
        }
    }
}
$db_name = 'INFORMATION_SCHEMA';
$username = "doponder_user";
$pass = "110591356";
$db = mysqli_connect('localhost', $username, $pass) or trigger_error(mysqli_error($db), E_USER_ERROR);
$db->select_db($db_name);
$db->query("SET NAMES 'utf8'");
$db->query("SET CHARACTER SET utf8");
$db->query("SET SESSION collation_connection = 'utf8_unicode_ci'");
if (is_object($fqcns) or is_array($fqcns)) {
    foreach ($fqcns as $fqcn) {
        $fqcnFilter = str_replace("model\\", '', $fqcn);
        if ($fqcnFilter != 'Front' and $fqcnFilter != 'Users') {
            $instance = new $fqcn;
            $tblName = $instance::table;
            $tables[$tblName] = array();
            $query = $db->query("select * from COLUMNS where `TABLE_NAME` = '$tblName'");
            while ($row = $query->fetch_object()) {
                $tables[$tblName][] = $row->COLUMN_NAME;
            }
        }
    }
}
echo json_encode($tables);
