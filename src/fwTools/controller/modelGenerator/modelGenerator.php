<?php
include '../../../autoload.php';
if (isset($_REQUEST['controller_type'])) {
    switch ($_REQUEST['controller_type']) {
        case 'fw_autocomplete':
            $res = $conn->query("select * from INFORMATION_SCHEMA.TABLES where `TABLE_TYPE` = 'BASE TABLE'");
            $output = array();
            while ($row = $res->fetchObject()) {
                $output[] = $row->TABLE_NAME;
            }
            echo json_encode($output);
            break;
        case "make":
            $tblName = $_POST['tblName'];
            $res = $conn->query("select * from template_data where tbl_name = '$tblName'")->fetchObject();
            $labels = json_decode($res->label_data, true);
            $type_data = json_decode($res->type_data, true);
            $form_data = json_decode($res->form_data, true);
            $join_data = json_decode($res->join_data, true);
            $image_data = json_decode($res->image_data, true);
            $validation_data = json_decode($res->validation_data, true);
            $ths = '';
            $arrayOfColumns = [];
            $i = 0;
            $inputs = '';
            $selects = '';
            $arrayOfImages = [];
            foreach ($labels as $key => $datum) {
                if ($type_data[$key] == 'input') {
                    $i++;
                    if ($i <= 3) {
                        $ths .= "<th>$datum</th>";
                        $arrayOfColumns[] = "'" . $key . "'";
                    }
                    switch ($validation_data[$key]) {
                        case 'Mobile':
                            $inputs .= "
                            \$View->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$View->Html()->Label('" . $datum . "') .
                            \$View->Html()->Mobile('" . $key . "','" . $key . "') .
                            \$View->Html()->FormGroupEnd() .
                            ";
                            break;
                        case 'Price':
                            $inputs .= "
                            \$View->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$View->Html()->Label('" . $datum . "') .
                            \$View->Html()->Price('" . $key . "','" . $key . "') .
                            \$View->Html()->FormGroupEnd() .
                            ";
                            break;
                        case 'Tel':
                            $inputs .= "
                            \$View->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$View->Html()->Label('" . $datum . "') .
                            \$View->Html()->Tel('" . $key . "','" . $key . "') .
                            \$View->Html()->FormGroupEnd() .
                            ";
                            break;
                        case 'Number':
                            $inputs .= "
                            \$View->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$View->Html()->Label('" . $datum . "') .
                            \$View->Html()->Number('" . $key . "','" . $key . "') .
                            \$View->Html()->FormGroupEnd() .
                            ";
                            break;
                        case 'English':
                            $inputs .= "
                            \$View->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$View->Html()->Label('" . $datum . "') .
                            \$View->Html()->English('" . $key . "','" . $key . "') .
                            \$View->Html()->FormGroupEnd() .
                            ";
                            break;
                        case 'input':
                        default:
                            $inputs .= "
                            \$View->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$View->Html()->Label('" . $datum . "') .
                            \$View->Html()->Input('" . $key . "') .
                            \$View->Html()->FormGroupEnd() .
                            ";
                            break;
                    }
                } elseif ($type_data[$key] == 'select') {
                    $jClass = $join_data[$key] != '*' ? "new $join_data[$key]()" : "''";
                    $inputs .= "
                            \$View->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$View->Html()->Label('" . $datum . "') .
                            \$View->Html()->Select('" . $key . "', '" . $key . "', $jClass) .
                            \$View->Html()->FormGroupEnd() .
                            ";
                } elseif ($type_data[$key] == 'image') {
                    $arrayOfImages[] = $key;
                    $width = $image_data[$key]['width'];
                    $height = $image_data[$key]['height'];
                    $inputs .= "
                            \$View->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$View->Html()->Label('" . $datum . "') .
                            \$View->Html()->ImageInput('" . $key . "','" . $image_data[$key]['type'] . "',$width,$height).
                            \$View->Html()->FormGroupEnd() .
                            ";
                }
            }
            $inputs = trim($inputs);
            $selects = trim($selects);
            $inputs = endsWith($inputs, '.') ? substr($inputs, 0, strlen($inputs) - 1) : $inputs;
            $selects = $inputs == '' ? endsWith($selects, '.') ? substr($selects, 0, strlen($selects) - 1) : $selects : $selects;
            $address = $_POST['address'];
            $addressArray = explode('/', $address);
            $pathToModels = __SOURCE__ . 'models/';
            $pathToControllers = __SOURCE__ . 'controllers/';
            $pathToViews = __SOURCE__ . 'views/';
            foreach ($addressArray as $item) {
                if (!is_dir($pathToModels . $item)) {
                    mkdir($pathToModels . $item, 0777);
                }
                if (!is_dir($pathToControllers . $item)) {
                    mkdir($pathToControllers . $item, 0777);
                }
                if (!is_dir($pathToViews . $item)) {
                    mkdir($pathToViews . $item, 0777);
                }
                $pathToModels .= $item . '/';
                $pathToControllers .= $item . '/';
                $pathToViews .= $item . '/';
            }
            $path = (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR);
            $backToAutoLoad = '../';
            $num = substr_count('/', $path);
            for ($i = -1; $i <= $num; $i++) {
                $backToAutoLoad .= '../';
            }
            $backToAutoLoad = endsWith($backToAutoLoad, '/') ? substr($backToAutoLoad, 0, strlen($backToAutoLoad) - 1) : $backToAutoLoad;
            $model = fopen(__SOURCE__ . 'models' . DIRECTORY_SEPARATOR . (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . $_POST['name'] . '.php', "w");
            $controller = fopen(__SOURCE__ . 'controllers' . DIRECTORY_SEPARATOR . (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . $_POST['name'] . '.php', "w");
            $view = fopen(__SOURCE__ . 'views' . DIRECTORY_SEPARATOR . (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . $_POST['name'] . '.php', "w");
            $addView = fopen(__SOURCE__ . 'views' . DIRECTORY_SEPARATOR . $path . 'add' . $_POST['name'] . '.php', "w");
            $ediView = fopen(__SOURCE__ . 'views' . DIRECTORY_SEPARATOR . (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . 'edit' . $_POST['name'] . '.php', "w");
            $delView = fopen(__SOURCE__ . 'views' . DIRECTORY_SEPARATOR . (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . 'delete' . $_POST['name'] . '.php', "w");
            $string = "<?php\nnamespace model;\nuse DATABASE\Model;\n";
            $string .= "class " . $_POST["name"] . "  extends Model {\n";
            if (sizeof($arrayOfImages) > 0) {
                $File_ARRAY = 'array(';
                foreach ($arrayOfImages as $image) {
                    $File_ARRAY .= '"' . $image . '" => "' . $backToAutoLoad . 'images/' . $_POST['name'] . '/"';
                }
                $File_ARRAY .= ')';
            }
            if (!is_dir(__SOURCE__.'images/')){
                mkdir(__SOURCE__.'images/',0755);
            }
            if (!is_dir(__SOURCE__.'images/'.$_POST['name'].'/')){
                mkdir(__SOURCE__.'images/'.$_POST['name'].'/',0755);
            }
            $imageString = '';
            if ($File_ARRAY){
                $imageString = "\n\$Controller->Uploads($File_ARRAY,\$_FILES);\n";
            }
            $controllerString = "<?php\ninclude '$backToAutoLoad/autoload.php';\n\$Controller = new Controller(new \model\\" . $_POST["name"] . "(),\$_REQUEST,'" . $_POST["controller_name"] . "');$imageString\n\$Controller->do();\n\$Controller->castOutput();";
            $string .= "     const table = " . "'$tblName';\n";
            $tbKey = $_POST['tblKey'];
            $string .= "     const key = " . "'$tbKey';\n}";
            fwrite($model, $string);
            fwrite($controller, $controllerString);

            fwrite($view, "<?php
include_once '$backToAutoLoad/autoload.php';
\$View = new View(\$_REQUEST,'" . $_POST['controller_name'] . "');
\$View->breadcrumbs();
?>
<section class='content'>
    <div class='row'>
        <div class='col-md-12'>
             <div class='card card-primary card-outline'>
                <div class='card-header'>
                  <?
                \$View->refreshAndAdd();
                    ?>
                </div>
                <div class=\"card-body table-responsive\">
                <table class=\"table table-striped table-bordered\">
                <thead class=\"table-dark\">
                <tr>
                    <th width='50'>ردیف</th>
                    $ths
                    <th width='150'>عملیات</th>
                </tr>
                </thead>
                <tbody>
                <?=\$View->show([" . implode(',', $arrayOfColumns) . "])?>
                </tbody>
                </table>
                </div>
        </div>
    </div>
</section>
                    ");
            fwrite($addView, "<?php
include_once '$backToAutoLoad/autoload.php';
\$View = new View(\$_REQUEST,'" . $_POST['controller_name'] . "');
\$View->breadcrumbs();
\$View->submit();
?>
<section class='content'>
    <div class='row'>
        <div class='col-md-12'>
             <div class='card card-primary card-outline'>
                <div class='card-header'>
                  <?
                  \$View->CardTitle();
                \$View->refreshAndBack();
                    ?>
                </div>
                <?=
                \$View->FormStart().
                " . $selects . $inputs . "
                ?>
                <?
                \$View->CardFooter();
                ?>
        </div>
    </div>
</section>
                    ");
            fwrite($ediView, "<?php
include_once '$backToAutoLoad/autoload.php';
\$View = new View(\$_REQUEST,'" . $_POST['controller_name'] . "');
\$View->breadcrumbs();
\$View->submit();
\$View->doFill();
?>
<section class='content'>
    <div class='row'>
        <div class='col-md-12'>
             <div class='card card-primary card-outline'>
                <div class='card-header'>
                  <?
                  \$View->CardTitle();
                \$View->refreshAndBack();
                    ?>
                </div>
                <?=
                \$View->FormStart().
                " . $selects . $inputs . "
                ?>
                <?
                \$View->CardFooter();
                ?>
        </div>
    </div>
</section>
                    ");
            fwrite($delView, "<?php
include_once '$backToAutoLoad/autoload.php';
\$View = new View(\$_REQUEST,'" . $_POST['controller_name'] . "');
\$View->breadcrumbs();
\$View->submit();
\$View->doFill();
\$View->doDisableAll();
?>
<section class='content'>
    <div class='row'>
        <div class='col-md-12'>
             <div class='card card-primary card-outline'>
                <div class='card-header'>
                  <?
                  \$View->CardTitle();
                \$View->refreshAndBack();
                    ?>
                </div>
                <?=
                \$View->FormStart().
                " . $selects . $inputs . "
                ?>
                <?
                \$View->CardFooter();
                ?>
        </div>
    </div>
</section>
                    ");
            fclose($model);
            fclose($controller);
            fclose($view);
            fclose($delView);
            fclose($ediView);
            fclose($addView);
            $tmp__path = (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . $_POST['name'];
            $tmp__data = file_get_contents(__SOURCE__ . 'layers/SideBar.php');
            $tmp__pos = strpos($tmp__data, '<!-- end -->');
            $newstr = substr_replace($tmp__data, '<?=navItem(\'' . $_POST['controller_name'] . '\', \'' . $tmp__path . '\')?>', $tmp__pos, 0);
            file_put_contents(__SOURCE__ . 'layers/SideBar.php', $newstr);
            echo showResult($model, 'مدل در ' . (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . $_POST['name'] . '.php', 'ساختن');
            break;
        case "getFormData":
            $tblName = $_REQUEST['tblName'];
            $output = array();
            $result = $conn->query("select * from INFORMATION_SCHEMA.COLUMNS as clmn left join INFORMATION_SCHEMA.`TABLES` as tbl on clmn.TABLE_NAME = tbl.TABLE_NAME  where tbl.`TABLE_TYPE` = 'BASE TABLE' and tbl.`TABLE_NAME` = '$tblName'");
            if ($result) {
                while ($res = $result->fetchObject()) {
                    if (strpos($res->COLUMN_COMMENT, "HIDDEN") === false and $res->COLUMN_KEY !== 'PRI') {
                        $type = $res->DATA_TYPE;
                        $info = array("name" => $res->COLUMN_NAME, "label" => $res->COLUMN_COMMENT, "required" => $res->IS_NULLABLE === 'NO' ? true : false);
                        $output[] = $info;
                    }
                }
            } else {
                $output['state'] = 'Not Found';
            }
            echo json_encode($output);
            break;
    }
}
