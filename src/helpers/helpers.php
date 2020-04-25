<?php

use helpers\SimpleImage;

header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Tehran');

function showSuccessMsg($name, $type) {
    return '<div class="alert alert-success alert-dismissible mrt20">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fa fa-check"></i> ' . $type . ' ' . $name . ' با موفقیت انجام شد!</h5>
				  </div>';
}

function delete_all_between($beginning, $end, $string) {
    $beginningPos = strpos($string, $beginning);
    $endPos = strpos($string, $end);
    if ($beginningPos === false || $endPos === false) {
        return $string;
    }

    $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

    return delete_all_between($beginning, $end, str_replace($textToDelete, '', $string));
}

function showImage($path, $alt = 'تصویر', $width = 150, $height = 150) {
    if (file_exists($path)) {
        return '<img alt="' . $alt . '" src="' . $path . '" width="' . $width . ' height="' . $height . ' ">';
    } else {
        foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'images/')), "/$path/") as $file) {
            return '<img alt="' . $alt . '" src="' . str_replace(__SOURCE__, '', $file->getRealPath()) . '" width="' . $width . ' height="' . $height . ' ">';
        }

    }
}

function navItem($name = 'لینک', $link = 'undefined.php', $icon = 'fa fa-circle', int $padding_right = 2, $hasArrow = false, $show = true) {
    if ($show) {
        return '<li class="nav-item pr-' . $padding_right . '">
                <a rel="' . $link . '" class="nav-link ajax">
                    <i class="nav-icon ' . $icon . '"></i>
                    <p>
                        ' . $name . '
                        ' . ($hasArrow ? '<i class="right fa fa-angle-left"></i>' : '') . '
                    </p>
                </a>
            </li>';
    } else
        return null;
}

function navItemHasTreeView(string $name = 'undefined.php', string $icon = 'fa fa-stack-exchange', string $children = '', $padding_right = 0, $show = true) {
    if ($show) {
        return '<li class="nav-item has-treeview pr-' . $padding_right . '">
        <a href="#" class="nav-link">
            <i class="nav-icon ' . $icon . '"></i>
            <p>
                ' . $name . '
                <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            ' . $children . '
        </ul>
    </li>';
    } else
        return null;
}

function toStr($arg) {
    if (is_array($arg) || is_object($arg)) {
        $arg = (array)$arg;
        foreach ($arg as $key => $value) {
            $arg[$key] = toStr($value);
        }
    } elseif (is_string($arg)) {
        $arg = new Str($arg);
    }
    return $arg;
}

function deStr($arg) {
    if (is_array($arg)) {
        $arg = (array)$arg;
        foreach ($arg as $key => $value) {
            $value = deStr($value);
            $arg[$key] = $value;
        }
    } elseif ($arg instanceof Str){
        $arg = $arg->getValue();
    }
    return $arg;
}

function is_json($string, $return_data = false, $assoc = false) {
    if (!is_string($string)) return false;
    $data = json_decode($string, $assoc);
    return (json_last_error() == JSON_ERROR_NONE) ? is_array($data) || is_object($data) ? ($return_data ? $data : TRUE) : FALSE : FALSE;
}

function removeAfter($string, $character) {
    return substr($string, 0, strpos($string, $character));
}

function showErrorMsg($name, $type) {
    global $conn;
    return '<div class="alert alert-danger  alert-dismissible mrt20">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fa fa-ban"></i> ' . $type . ' ' . $name . ' با خطا مواجه شد!</h5>
					<p>لطفا مجددا تلاش کنید. در صورت تکرار خطا با مدیر سیستمتماس بگیرید</p>
					<br>
					<p>جزئیات این خطا: ' . $conn->error . '</p>
				  </div>';
}

function showResult($method, $name, $type) {
    if ($method) {
        return showSuccessMsg($name, $type);
    } else {
        return showErrorMsg($name, $type);
    }
}

function cs_decode($string) {
    return explode(',', $string);
}

function cs_encode($array) {
    return implode(',', $array);
}

function MobileFormat($mobile) {

    $mobile = substr_replace(substr_replace(substr_replace(substr_replace($mobile, " ", 9, 0), " ", 7, 0), ") ", 4, 0), "(", 0, 0);
    return $mobile;
}

function TelFormat($tel) {
    $tel = substr_replace(substr_replace(substr_replace(substr_replace(substr_replace($tel, " ", 9, 0), " ", 7, 0), " ", 5, 0), ") ", 3, 0), "(", 0, 0);
    return $tel;
}

function CorrectMobile($mobile) {
    $mobile = preg_replace('/[^0-9]/', '', $mobile);
    return $mobile;
}

function CallAPI($method, $url, $data = false) {
    $curl = curl_init();
    $method = strtoupper($method);
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "REQUEST":
            curl_setopt($curl, CURLOPT_POSTFIELDS, 1);

            if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data) $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

$JDATE = new JDF();
function checkAll(array $array, bool $csrfValidate = false, $encodeChildren = false) {
    global $JDATE;
    if ($csrfValidate) {
        $array = csrf_validate($array);
        if ($array == false) return false;
    }
    $array = cleanMe($array);
    foreach ($array as $key => $value) {
        $key1 = strtolower($key);
        if (strpos($key1, 'mobile') !== false) {
            $array[$key] = CorrectMobile($value);
        }
        if (strpos($key1, 'tel') !== false) {
            $array[$key] = CorrectMobile($value);
        }
        if ($key1 == 'pass' or $key1 == 'password') {
            $array[$key] = sha1(md5($value));
        }
        if ($key1 == 'date' or $key == 'birthday') {
            $array[$key] = $JDATE->persianStrToTime($value);
        }
        if ($encodeChildren) {
            if ($key == 'checkImage') {
                unset($array[$key]);
            } else if (is_array($value) || is_object($value)) {
                $array[$key] = json_encode($value);
            }
        }
        if (strpos($key1, 'date') != false) {
            $array[$key] = $JDATE->persianStrToTime($value);
        }
        if ($key1 == "birthday") {
            $array[$key] = $JDATE->persianStrToTime($value);
        }
        if ($key == 'checkImage') {
            unset($array[$key]);
        }
    }
    return $array;
}

function cleanMe($string) {
    if (is_array($string)) {
        $arr = array();
        foreach ($string as $key => $str) {
            $arr[$key] = cleanme($str);
        }
        return $arr;
    } else {
        return htmlspecialchars($string);
    }

}

function character_limiter($str, $n = 500, $end_char = '&#8230;') {
    if (strlen($str) < $n) {
        return $str;
    }

    $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

    if (strlen($str) <= $n) {
        return $str;
    }

    $out = "";
    foreach (explode(' ', trim($str)) as $val) {
        $out .= $val . ' ';

        if (strlen($out) >= $n) {
            $out = trim($out);
            return (strlen($out) == strlen($str)) ? $out : $out . $end_char;
        }
    }
    return null;
}

function generateRandomString($length = 5, $onlyNumbers = false) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if ($onlyNumbers == true) {
        $characters = '0123456789';
    }
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function passwordGenerator() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$^%&*';
    $charactersLength = strlen($characters);
    $randomString = '';
    while (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$^%&*-]).{12,}$/', $randomString)) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function upload($file, $path, $customName = '') {
    $exploded = explode(".", $file['name']);
    $fileName = $customName . time() . "." . end($exploded);
    $path = $path . $fileName;
    if (move_uploaded_file($file['tmp_name'], $path)) {
        return $fileName;
    }
    return false;
}

function uploadImage($file, $checkImage, $path, bool $resize = false, string $extraName = '') {
    include "image.php";
    $target_dir = endsWith($path, '/') ? $path : $path . '/';
    $exploded = explode(".", $file['name']);
    $ext = end($exploded);
    $fileName = $extraName . time() . "." . $ext;
    $target_file = $target_dir . $fileName;
    $image = new SimpleImage();
    $image->load($file['tmp_name']);
    if ($resize) {
        $image->resizeCheckImage($checkImage);
    }
    $image->save($target_file);
    return $fileName;
}

function is_odd($number) {
    if (!is_numeric($number)) {
        throw new Error('Number input is nut numeric');
    } else {
        if ($number % 2 == 0) {
            return true;
        } else {
            return false;
        }
    }
}

function is_even($number) {
    if (!is_numeric($number)) {
        throw new Error('Number input is not numeric');
    } else {
        if ($number % 2 == 0) {
            return false;
        } else {
            return true;
        }
    }
}

function checkImage($array) {
    if (is_array($array['checkImage'])) {
        return $array['checkImage'];
    }
    return false;
}

function jsonEncode($generator) {
    $output = array();
    foreach ($generator as $key => $item) {
        $output[$key] = $item;
    }
    $output = deStr($output);
    return json_encode($output);
}

function controllerType($type = 'add') {
    return hiddenInput($type);
}

function fa_to_en($number) {
    if (empty($number)) return '0';

    $en = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $fa = array("۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹");

    return str_replace($fa, $en, $number);
}

function en_to_fa($number) {
    if (empty($number)) return '۰';

    $en = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $fa = array("۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹");

    return str_replace($en, $fa, $number);

}

function optOfArray($array, string $key = '', string $name = '', bool $isJson = false) {
    $res = '';
    foreach (($isJson ? json_decode($array) : $array) as $keyOfArray => $object) {
        $res .= '<option value="' . $object->$key . '">' . $object->$name . '</option>';
    }
    return $res;
}

function UniqueOfClass($class, $uniqueField, $strToUpper = false, $length = 7, $onlyNumbers = false, $strToLower = false) {
    global $conn;
    $table = $class::table;
    do {

        $resNum = generateRandomString($length, $onlyNumbers);
        $search = $conn->query("select * from $table where `$uniqueField` = '$resNum'");
        if ($search->rowCount() < 1) {
            break;
        }
    } while (true);
    if ($strToUpper === true) return strtoupper($resNum); elseif ($strToLower === true) return strtolower($resNum);
    else
        return $resNum;
}

function checkBoxCheck($condition) {
    return $condition ? 'checked' : '';
}

function selectChecked($condition) {
    return $condition ? ' selected ' : '';
}

/**
 * @param string $table
 * @param string $name
 * @param string $key
 * @param string $keyValue
 * @param bool $emptyOpt
 * @param bool $secName
 * @param bool $Condition
 * @param bool $isTheKeyArray
 * @param bool $join_class
 * @param string $display_name
 * @param bool $foreignKey
 * @return string
 */
function select(string $table, string $name, string $key, $keyValue = '0', bool $emptyOpt = true, $secName = false, $Condition = false, $isTheKeyArray = false, $join_class = false, string $display_name = '', string $displaNameSplitor = ' - ', $foreignKey = false) {
    if ($emptyOpt == true) {
        $options = '<option value="" selected disabled>لطفا یک مورد را انتخاب کنید</option>';
    } else {
        $options = '';
    }
    global $conn;
    $query = "SELECT * FROM `$table`";
    if ($Condition) {
        $query .= $Condition;
    }
    $result = $conn->query($query);
    while ($item = $result->fetchObject()) {
        $options .= '<option 
                 ' . selectChecked(($isTheKeyArray ? (in_array($item->$key, (array)$keyValue)) : ($item->$key == $keyValue))) . '
                 value="' . $item->$key . '">
                 ' . $item->$name . " " . ($secName ? $item->$secName : '') . ($join_class ? $displaNameSplitor . join_class($join_class, (!$foreignKey ? $item->{$join_class::key} : $item->$foreignKey), $display_name) : '') . '</option>';
    }
    return $options;
}

function selectByClass($class, string $name, $keyValue = '0', bool $emptyOpt = true, $secName = false, string $Condition_where = '', $isTheKeyArray = false, $join_class = false, string $display_name = '', string $displaNameSplitor = ' - ', $foreignKey = false): string {
    if ($emptyOpt == true) {
        $options = '<option value="" selected disabled>لطفا یک مورد را انتخاب کنید</option>';
    } else {
        $options = '';
    }
    $key = $class::key;
    if (strlen($Condition_where) > 0) {
        $res = $class->getAllConditioned((string)$Condition_where);
    } else {
        $res = $class->getAll();
    }
    foreach ($res as $item) {
        $options .= '<option ' . selectChecked(($isTheKeyArray ? (in_array($item->$key, (array)$keyValue)) : ($item->$key == $keyValue))) . '  value="' . $item->$key . '"> ' . $item->$name . " " . ($secName ? $item->$secName : '') . ($join_class ? $displaNameSplitor . join_class($join_class, (!$foreignKey ? $item->{$join_class::key} : $item->$foreignKey), $display_name) : '') . '</option>';
    }
    return $options;
}

function joins($tableName, $key, $keyValue, $displayName = false) {
    global $conn;
    return $displayName ? $conn->query("select * from " . $tableName . " where $key = $keyValue")->fetchObject()->$displayName : $conn->query("select * from " . $tableName . " where $key = $keyValue")->fetchObject();
}

function join_class($class, $keyValue, $displayName = false) {
    global $conn;
    $tableName = $class::table;
    $key = $class::key;
    return $displayName ? $conn->query("select * from " . $tableName . " where $key = $keyValue")->fetchObject()->$displayName : $conn->query("select * from " . $tableName . " where $key = $keyValue")->fetchObject();
}

class IconCenter {
    public $icon;
    public $picker;

    function __construct() {
        $this->icon = null;
        $this->picker = null;
    }

    function iconCenter($inputValue = false, string $pathToImages = 'images', string $inputName = 'icon_id') {
        global $conn;
        $query = "SELECT * FROM `tblIcons`";
        $result = $conn->query($query);
        $options = '<div id="iconCenterPicker">';
        while ($row = $result->fetchObject()) {
            $options .= '<img src="' . $pathToImages . '/IconCenter/' . $row->image . '" alt="' . $row->icon_id . '">';
        }
        $options .= '</div>';
        if ($inputValue) {
            $options .= '<input value="' . $inputValue . '" type="hidden" id="iconCenterInput" name="' . $inputName . '">';
            return $options;
        }
        $options .= '<input type="hidden" value="" id="iconCenterInput" name="' . $inputName . '">';
        $this->setPicker($options);
        return $this->picker;
    }

    protected function setPicker($picker) {
        $this->picker = $picker;
    }

    function getIcon(string $id, $path = 'images') {
        global $conn;
        $res = $conn->query("SELECT * FROM tblIcons where icon_id = '$id'")->fetchObject();
        $this->setIcon('<img style="width: 65px;height: auto" src="' . $path . '/IconCenter/' . $res->image . '" alt="' . $res->icon_id . '">');
        return $this->icon;
    }

    protected function setIcon($icon) {
        $this->icon = $icon;
    }
}

function ValidateRequestForPageLoad($dataFromPost, $assoc = false) {
    if (isset($dataFromPost['timeStampForAjaxRequest'])) {
        if (round($dataFromPost['timeStampForAjaxRequest'] / 1000) > time() - 100 and round($dataFromPost['timeStampForAjaxRequest'] / 1000) < time() + 100) {
            return json_decode($dataFromPost['data'], $assoc);
        }
    }
    echo '<script>location.replace("index.php")</script>';
}

function CheckLoadedDataFromAjaxCall($data) {
    if (is_array($data) or is_object($data)) {
        return null;
    }
    return $data;
}


class JDF {
    public function persianStrToTime($string) {
        if (is_array($string)) {
            $arr = array();
            foreach ($string as $key => $str) {
                $arr[$key] = $this->persianStrToTime($str);
            }
            return $arr;
        } else {
            if (!$this->isValidTimeStamp($string)) {
                $MonthDayNum = 1;
                $MonthNumber = 1;
                $Minute = 0;
                $Hour = 0;
                $Year = 1399;
                $String = str_replace("ب ظ", "", $string);
                $String = str_replace("ق ظ", "", $String);
                $MonthDays = array(0 => '۰', 1 => '۱', 2 => '۲', 3 => '۳', 4 => '۴', 5 => '۵', 6 => '۶', 7 => '۷', 8 => '۸', 9 => '۹', 10 => '۱۰', 11 => '۱۱', 12 => '۱۲', 13 => '۱۳', 14 => '۱۴', 15 => '۱۵', 16 => '۱۶', 17 => '۱۷', 18 => '۱۸', 19 => '۱۹', 20 => '۲۰', 21 => '۲۱', 22 => '۲۲', 23 => '۲۳', 24 => '۲۴', 25 => '۲۵', 26 => '۲۶', 27 => '۲۷', 28 => '۲۸', 29 => '۲۹', 30 => '۳۰', 31 => '۳۱');
                $weekDays = array('شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهار شنبه', 'پنج‌شنبه', 'جمعه');
                $arrayOfMonths = array(1 => 'فروردین', 2 => 'اردیبهشت', 3 => 'خرداد', 4 => 'تیر', 5 => 'مرداد', 6 => 'شهریور', 7 => 'مهر', 8 => 'آبان', 9 => 'آذر', 10 => 'دی', 11 => 'بهمن', 12 => 'اسفند');
                foreach ($arrayOfMonths as $monthNum => $month) {
                    if (strpos($String, $month)) {
                        $MonthNumber = $monthNum;
                        $String = str_replace($month, "", $String);
                    }
                }
                $hasWeekDay = false;
                foreach ($weekDays as $weekDay) {
                    if (strpos($string, $weekDay)) {
                        $hasWeekDay = true;
                    }
                }
                if ($hasWeekDay == true) {
                    $String = str_replace($weekDays[1], "", $String);
                    $String = str_replace($weekDays[2], "", $String);
                    $String = str_replace($weekDays[3], "", $String);
                    $String = str_replace($weekDays[4], "", $String);
                    $String = str_replace($weekDays[5], "", $String);
                    $String = str_replace($weekDays[6], "", $String);
                    $String = str_replace($weekDays[0], "", $String);
                }
                foreach ($MonthDays as $monthDay => $day) {
                    $String = str_replace($day, $monthDay, $String);
                }
                $arrayOFNums = [1 => "01", 2 => "02", 3 => "03", 4 => "04", 5 => "05", 6 => "06", 7 => "07", 8 => "08", 9 => "09"];
                $demo = [];
                foreach ($arrayOFNums as $num => $OFNum) {
//         array_push($demo,strpos($String,$OFNum));
                    if (strpos($String, $OFNum) != false) {
                        $String = str_replace(" " . $OFNum . " ", $num, $String);
                        $MonthDayNum = $num;
                    } else {
                        foreach ($MonthDays as $monthDayNum => $monthDay) {
                            $monthDayNum = (string)$monthDayNum;
                            $String = str_replace($monthDay, $monthDayNum, $String);
                            if (strpos($String, " " . $monthDayNum . " ") !== false) {
                                $String = str_replace(" " . $monthDayNum . " ", "", $String);
                                $MonthDayNum = $monthDayNum;
                            }
                        }
                    }

                }


                $MonthDayNum = (int)$MonthDayNum;
                for ($i = 1000; $i <= 1500; $i++) {
                    $i = (string)$i;
                    if (strpos($String, $i) != false) {
                        $String = str_replace($i, '', $String);
                        $Year = $i;
                    }
                }
                if (strpos($String, ':')) {
                    $dist = str_replace(" ", "", $String);
                    $Minute = end(explode(":", $dist));
                    settype($Minute, 'integer');
                    $Hour = explode(":", $dist)[0];
                    settype($Hour, 'integer');
                }
                $gregTime = $this->jalali_to_gregorian($Year, $MonthNumber, $MonthDayNum);
                return mktime($Hour, $Minute, 0, $gregTime[1], $gregTime[2], $gregTime[0]);
            } else {
                return $string;
            }
        }
    }

    private function isValidTimeStamp($timestamp) {
        return ((string)(int)$timestamp === $timestamp) && ($timestamp <= PHP_INT_MAX) && ($timestamp >= ~PHP_INT_MAX);
    }

    public function jalali_to_gregorian($j_y, $j_m, $j_d) {

        $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


        $jy = $j_y - 979;

        $jm = $j_m - 1;

        $jd = $j_d - 1;


        $j_day_no = 365 * $jy + $this->div($jy, 33) * 8 + $this->div($jy % 33 + 3, 4);

        for ($i = 0; $i < $jm; ++$i)

            $j_day_no += $j_days_in_month[$i];


        $j_day_no += $jd;


        $g_day_no = $j_day_no + 79;


        $gy = 1600 + 400 * $this->div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */

        $g_day_no = $g_day_no % 146097;


        $leap = true;

        if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */ {

            $g_day_no--;

            $gy += 100 * $this->div($g_day_no, 36524); /* 36524 = 365*100 + 100/4 - 100/100 */

            $g_day_no = $g_day_no % 36524;


            if ($g_day_no >= 365)

                $g_day_no++;

            else

                $leap = false;

        }


        $gy += 4 * $this->div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */

        $g_day_no %= 1461;


        if ($g_day_no >= 366) {

            $leap = false;


            $g_day_no--;

            $gy += $this->div($g_day_no, 365);

            $g_day_no = $g_day_no % 365;

        }


        for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)

            $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);

        $gm = $i + 1;

        $gd = $g_day_no + 1;


        return array($gy, $gm, $gd);

    }

    private function div($a, $b) {

        return (int)($a / $b);

    }

    private function jmaketime($hour = "", $minute = "", $second = "", $jmonth = "", $jday = "", $jyear = "") {

        if (!$hour && !$minute && !$second && !$jmonth && !$jmonth && !$jday && !$jyear)

            return time();

        list($year, $month, $day) = $this->jalali_to_gregorian($jyear, $jmonth, $jday);

        return mktime($hour, $minute, $second, $month, $day, $year);

    }

    private function jcheckdate($month, $day, $year) {

        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

        if ($month <= 12 && $month > 0) {

            if ($j_days_in_month[$month - 1] >= $day && $day > 0)

                return 1;

            if ($this->is_kabise($year))

                echo "Asdsd";

            if ($this->is_kabise($year) && $j_days_in_month[$month - 1] == 31)

                return 1;

        }


        return 0;


    }

    private function is_kabise($year) {

        if ($year % 4 == 0 && $year % 100 != 0)

            return true;

        return false;

    }

    private function jgetdate($timestamp = "") {

        if ($timestamp == "")

            $timestamp = time();


        return array(

            0 => $timestamp,

            "seconds" => $this->jdate("s", $timestamp),

            "minutes" => $this->jdate("i", $timestamp),

            "hours" => $this->jdate("G", $timestamp),

            "mday" => $this->jdate("j", $timestamp),

            "wday" => $this->jdate("w", $timestamp),

            "mon" => $this->jdate("n", $timestamp),

            "year" => $this->jdate("Y", $timestamp),

            "yday" => $this->days_of_year($this->jdate("m", $timestamp), $this->jdate("d", $timestamp), $this->jdate("Y", $timestamp)),

            "weekday" => $this->jdate("l", $timestamp),

            "month" => $this->jdate("F", $timestamp),

        );

    }

    public function jdate($type, $maket = "now") {
        $transnumber = 0;
        $TZhours = 0;
        $TZminute = 0;
        $need = "";
        $result1 = "";
        $result = "";
        if ($maket == "now") {
            $year = date("Y");
            $month = date("m");
            $day = date("d");
            list($jyear, $jmonth, $jday) = $this->gregorian_to_jalali($year, $month, $day);
            $maket = mktime(date("H") + $TZhours, date("i") + $TZminute, date("s"), date("m"), date("d"), date("Y"));
        } else {
            $maket += $TZhours * 3600 + $TZminute * 60;
            $date = date("Y-m-d", $maket);
            list($year, $month, $day) = preg_split('/-/', $date);
            list($jyear, $jmonth, $jday) = $this->gregorian_to_jalali($year, $month, $day);
        }
        $need = $maket;
        $year = date("Y", $need);
        $month = date("m", $need);
        $day = date("d", $need);
        $i = 0;
        $subtype = "";
        $subtypetemp = "";
        list($jyear, $jmonth, $jday) = $this->gregorian_to_jalali($year, $month, $day);

        while ($i < strlen($type)) {

            $subtype = substr($type, $i, 1);

            if ($subtypetemp == "\\") {

                $result .= $subtype;

                $i++;

                continue;

            }


            switch ($subtype) {


                case "A":

                    $result1 = date("a", $need);

                    if ($result1 == "pm") $result .= "&#1576;&#1593;&#1583;&#1575;&#1586;&#1592;&#1607;&#1585;";

                    else $result .= "&#1602;&#1576;&#1604;&#8207;&#1575;&#1586;&#1592;&#1607;&#1585;";

                    break;


                case "a":

                    $result1 = date("a", $need);

                    if ($result1 == "pm") $result .= "&#1576;&#46;&#1592;";

                    else $result .= "&#1602;&#46;&#1592;";

                    break;

                case "d":

                    if ($jday < 10) $result1 = "0" . $jday;

                    else    $result1 = $jday;

                    if ($transnumber == 1) $result .= $this->Convertnumber2farsi($result1);

                    else $result .= $result1;

                    break;

                case "D":

                    $result1 = date("D", $need);

                    if ($result1 == "Thu") $result1 = "&#1662;";

                    else if ($result1 == "Sat") $result1 = "&#1588;";

                    else if ($result1 == "Sun") $result1 = "&#1609;";

                    else if ($result1 == "Mon") $result1 = "&#1583;";

                    else if ($result1 == "Tue") $result1 = "&#1587;";

                    else if ($result1 == "Wed") $result1 = "&#1670;";

                    else if ($result1 == "Thu") $result1 = "&#1662;";

                    else if ($result1 == "Fri") $result1 = "&#1580;";

                    $result .= $result1;

                    break;

                case"F":

                    $result .= $this->monthname($jmonth);

                    break;

                case "g":

                    $result1 = date("g", $need);

                    if ($transnumber == 1) $result .= $this->Convertnumber2farsi($result1);

                    else $result .= $result1;

                    break;

                case "G":

                    $result1 = date("G", $need);

                    if ($transnumber == 1) $result .= $this->Convertnumber2farsi($result1);

                    else $result .= $result1;

                    break;

                case "h":

                    $result1 = date("h", $need);

                    if ($transnumber == 1) $result .= $this->Convertnumber2farsi($result1);

                    else $result .= $result1;

                    break;

                case "H":

                    $result1 = date("H", $need);

                    if ($transnumber == 1) $result .= $this->Convertnumber2farsi($result1);

                    else $result .= $result1;

                    break;

                case "i":

                    $result1 = date("i", $need);

                    if ($transnumber == 1) $result .= $this->Convertnumber2farsi($result1);

                    else $result .= $result1;

                    break;

                case "j":

                    $result1 = $jday;

                    if ($transnumber == 1) $result .= $this->Convertnumber2farsi($result1);

                    else $result .= $result1;

                    break;

                case "l":

                    $result1 = date("l", $need);

                    if ($result1 == "Saturday") $result1 = "&#1588;&#1606;&#1576;&#1607;";

                    else if ($result1 == "Sunday") $result1 = "&#1610;&#1603;&#1588;&#1606;&#1576;&#1607;";

                    else if ($result1 == "Monday") $result1 = "&#1583;&#1608;&#1588;&#1606;&#1576;&#1607;";

                    else if ($result1 == "Tuesday") $result1 = "&#1587;&#1607;&#32;&#1588;&#1606;&#1576;&#1607;";

                    else if ($result1 == "Wednesday") $result1 = "&#1670;&#1607;&#1575;&#1585;&#1588;&#1606;&#1576;&#1607;";

                    else if ($result1 == "Thursday") $result1 = "&#1662;&#1606;&#1580;&#1588;&#1606;&#1576;&#1607;";

                    else if ($result1 == "Friday") $result1 = "&#1580;&#1605;&#1593;&#1607;";

                    $result .= $result1;

                    break;

                case "m":

                    if ($jmonth < 10) $result1 = "0" . $jmonth;

                    else    $result1 = $jmonth;

                    if ($transnumber == 1) $result .= $this->Convertnumber2farsi($result1);

                    else $result .= $result1;

                    break;

                case "M":

                    $result .= $this->short_monthname($jmonth);

                    break;

                case "n":

                    $result1 = $jmonth;

                    if ($transnumber == 1) $result .= $this->Convertnumber2farsi($result1);

                    else $result .= $result1;

                    break;

                case "s":

                    $result1 = date("s", $need);

                    if ($transnumber == 1) $result .= $this->Convertnumber2farsi($result1);

                    else $result .= $result1;

                    break;

                case "S":

                    $result .= "&#1575;&#1605;";

                    break;

                case "t":

                    $result .= $this->mstart($month, $day, $year);

                    break;

                case "w":

                    $result1 = date("w", $need);

                    if ($transnumber == 1) $result .= $this->Convertnumber2farsi($result1);

                    else $result .= $result1;

                    break;

                case "y":

                    $result1 = substr($jyear, 2, 4);

                    if ($transnumber == 1) $result .= $this->Convertnumber2farsi($result1);

                    else $result .= $result1;

                    break;

                case "Y":

                    $result1 = $jyear;

                    if ($transnumber == 1) $result .= $this->Convertnumber2farsi($result1);

                    else $result .= $result1;

                    break;

                case "U" :

                    $result .= time();

                    break;

                case "Z" :

                    $result .= $this->days_of_year($jmonth, $jday, $jyear);

                    break;

                case "L" :

                    list($tmp_year, $tmp_month, $tmp_day) = $this->jalali_to_gregorian(13112, 12, 1);

                    echo $tmp_day;

                    /*if($this->mstart($tmp_month,$tmp_day,$tmp_year)=="31")

                        $result.="1";

                    else

                        $result.="0";

                        */

                    break;

                default:

                    $result .= $subtype;

            }

            $subtypetemp = substr($type, $i, 1);

            $i++;

        }

        return $result;

    }

    public function gregorian_to_jalali($g_y, $g_m, $g_d) {

        $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


        $gy = $g_y - 1600;

        $gm = $g_m - 1;

        $gd = $g_d - 1;


        $g_day_no = 365 * $gy + $this->div($gy + 3, 4) - $this->div($gy + 99, 100) + $this->div($gy + 399, 400);


        for ($i = 0; $i < $gm; ++$i)

            $g_day_no += $g_days_in_month[$i];

        if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0)))

            /* leap and after Feb */

            $g_day_no++;

        $g_day_no += $gd;


        $j_day_no = $g_day_no - 79;


        $j_np = $this->div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */

        $j_day_no = $j_day_no % 12053;


        $jy = 979 + 33 * $j_np + 4 * $this->div($j_day_no, 1461); /* 1461 = 365*4 + 4/4 */


        $j_day_no %= 1461;


        if ($j_day_no >= 366) {

            $jy += $this->div($j_day_no - 1, 365);

            $j_day_no = ($j_day_no - 1) % 365;

        }


        for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)

            $j_day_no -= $j_days_in_month[$i];

        $jm = $i + 1;

        $jd = $j_day_no + 1;


        return array($jy, $jm, $jd);

    }

    private function Convertnumber2farsi($srting) {

        $num0 = "&#1776;";

        $num1 = "&#1777;";

        $num2 = "&#1778;";

        $num3 = "&#1779;";

        $num4 = "&#1780;";

        $num5 = "&#1781;";

        $num6 = "&#1782;";

        $num7 = "&#1783;";

        $num8 = "&#17112;";

        $num9 = "&#1785;";


        $stringtemp = "";

        $len = strlen($srting);

        for ($sub = 0; $sub < $len; $sub++) {

            if (substr($srting, $sub, 1) == "0") $stringtemp .= $num0;

            elseif (substr($srting, $sub, 1) == "1") $stringtemp .= $num1;

            elseif (substr($srting, $sub, 1) == "2") $stringtemp .= $num2;

            elseif (substr($srting, $sub, 1) == "3") $stringtemp .= $num3;

            elseif (substr($srting, $sub, 1) == "4") $stringtemp .= $num4;

            elseif (substr($srting, $sub, 1) == "5") $stringtemp .= $num5;

            elseif (substr($srting, $sub, 1) == "6") $stringtemp .= $num6;

            elseif (substr($srting, $sub, 1) == "7") $stringtemp .= $num7;

            elseif (substr($srting, $sub, 1) == "8") $stringtemp .= $num8;

            elseif (substr($srting, $sub, 1) == "9") $stringtemp .= $num9;

            else $stringtemp .= substr($srting, $sub, 1);


        }

        return $stringtemp;


    }

    private function monthname($month) {


        if ($month == "01") return "&#1601;&#1585;&#1608;&#1585;&#1583;&#1610;&#1606;";


        if ($month == "02") return "&#1575;&#1585;&#1583;&#1610;&#1576;&#1607;&#1588;&#1578;";


        if ($month == "03") return "&#1582;&#1585;&#1583;&#1575;&#1583;";


        if ($month == "04") return "&#1578;&#1610;&#1585;";


        if ($month == "05") return "&#1605;&#1585;&#1583;&#1575;&#1583;";


        if ($month == "06") return "&#1588;&#1607;&#1585;&#1610;&#1608;&#1585;";


        if ($month == "07") return "&#1605;&#1607;&#1585;";


        if ($month == "08") return "&#1570;&#1576;&#1575;&#1606;";


        if ($month == "09") return "&#1570;&#15112;&#1585;";


        if ($month == "10") return "&#1583;&#1610;";


        if ($month == "11") return "&#1576;&#1607;&#1605;&#1606;";


        if ($month == "12") return "&#1575;&#1587;&#1601;&#1606;&#1583;";

    }

    private function short_monthname($month) {


        if ($month == "01") return "&#1601;&#1585;&#1608;";


        if ($month == "02") return "&#1575;&#1585;&#1583;";


        if ($month == "03") return "&#1582;&#1585;&#1583;";


        if ($month == "04") return "&#1578;&#1610;&#1585;";


        if ($month == "05") return "&#1605;&#1585;&#1583;";


        if ($month == "06") return "&#1588;&#1607;&#1585;";


        if ($month == "07") return "&#1605;&#1607;&#1585;";


        if ($month == "08") return "&#1570;&#1576;&#1575;";


        if ($month == "09") return "&#1570;&#15112;&#1585;";


        if ($month == "10") return "&#1583;&#1610;";


        if ($month == "11") return "&#1576;&#1607;&#1605;";


        if ($month == "12") return "&#1575;&#1587;&#1601; ";

    }

    private function mstart($month, $day, $year) {

        list($jyear, $jmonth, $jday) = $this->gregorian_to_jalali($year, $month, $day);

        list($year, $month, $day) = $this->jalali_to_gregorian($jyear, $jmonth, "1");

        $timestamp = mktime(0, 0, 0, $month, $day, $year);

        return date("w", $timestamp);

    }

    private function days_of_year($jmonth, $jday, $jyear) {

        $year = "";

        $month = "";

        $year = "";

        $result = "";

        if ($jmonth == "01")

            return $jday;

        for ($i = 1; $i < $jmonth || $i == 12; $i++) {

            list($year, $month, $day) = $this->jalali_to_gregorian($jyear, $i, "1");

            $result += $this->mstart($month, $day, $year);

        }

        return $result + $jday;

    }
}

function hiddenInput($value = 'add', $name = 'controller_type', $id = '') {
    return '<input ' . (strlen($id) > 0 ? 'id="' . $id . '"' : '') . ' type="hidden" name="' . $name . '" value="' . $value . '">';
}

function price_format(string $price) {
    return en_to_fa(number_format((float)$price)) . ' تومان';
}

function sendSingleSMS($phoneNumber, $text) {
    require_once 'noSoap.php';
    $proxyhost = "";
    $proxyport = "";
    $proxyusername = "";
    $proxypassword = "";
    $client = new nusoap_client('https://tartansms.com/smssendwebserviceforphp.asmx?wsdl', 'wsdl', $proxyhost, $proxyport, $proxyusername, $proxypassword);
    $client->soap_defencoding = 'UTF-8';
    $client->decode_utf8 = false;
    $user = "digchi";
    $pass = "123456";
    $domain = "tartansms";
    $param = array('UserName' => $user, 'Pass' => $pass, 'Domain' => $domain, 'SmsText' => $text, 'MobileNumber' => $phoneNumber, 'SenderNumber' => '30006403868611', 'smsMode' => 'SaveInPhone');
    $result = $send = $client->call('SendSingleSms', array('parameters' => $param), '', '', false, true);
    if ($client->fault) {
        return false;
    } else {
        // Check for errors
        $err = $client->getError();
        if ($err) {
            return false;
        } else {
            // Display the result
            return true;
        }
    }

}

function getIp() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getTime($year = -1, $month = -1, $day = -1, $hour = -1, $minute = -1, $second = -1, $time = -1) {
    if ($time == -1) $time = time();
    if ($year == -1) $year = date('Y', $time);
    if ($month == -1) $month = date('m', $time);
    if ($day == -1) $day = date('d', $time);
    if ($hour == -1) $hour = date('H', $time);
    if ($minute == -1) $minute = date('i', $time);
    if ($second == -1) $second = date('s', $time);
    return mktime($hour, $minute, $second, $month, $day, $year);
}

function isValidMd5($md5 = '') {
    return preg_match('/^[a-f0-9]{32}$/', $md5);
}

function startsWith($haystack, $needle) {
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}
