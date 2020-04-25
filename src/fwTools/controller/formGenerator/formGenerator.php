<?php
include '../../../autoload.php';
if (isset($_REQUEST['controller_type'])) {
    switch ($_REQUEST['controller_type']) {
        case "make":
            $tblName = 'tbl' . $_POST['tblName'];
            $template_data = $conn->query("select * from template_data");
            if ($template_data) {
                $conn->query("-- phpMyAdmin SQL Dump
                -- version 4.9.4
                -- https://www.phpmyadmin.net/
                --
                -- Host: localhost:3306
                -- Generation Time: Apr 25, 2020 at 11:18 AM
                -- Server version: 10.3.22-MariaDB
                -- PHP Version: 7.3.6
                
                SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
                SET AUTOCOMMIT = 0;
                START TRANSACTION;
                SET time_zone = \"+00:00\";
                
                
                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                /*!40101 SET NAMES utf8mb4 */;
                
                --
                -- Database: `puzzle_db`
                --
                
                -- --------------------------------------------------------
                
                --
                -- Table structure for table `template_data`
                --
                
                CREATE TABLE `template_data` (
                  `template_id` int(11) NOT NULL,
                  `tbl_name` mediumtext COLLATE utf8_persian_ci NOT NULL,
                  `column_data` longtext COLLATE utf8_persian_ci NOT NULL,
                  `label_data` longtext COLLATE utf8_persian_ci NOT NULL,
                   `type_data` longtext COLLATE utf8_persian_ci NOT NULL,
                  `join_data` longtext COLLATE utf8_persian_ci DEFAULT NULL,
                  `form_data` longtext COLLATE utf8_persian_ci NOT NULL,
                  `image_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
                  `validation_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
                
                --
                -- Dumping data for table `template_data`
                --
                
                --
                -- Indexes for dumped tables
                --
                
                --
                -- Indexes for table `template_data`
                --
                ALTER TABLE `template_data`
                  ADD PRIMARY KEY (`template_id`);
                
                --
                -- AUTO_INCREMENT for dumped tables
                --
                
                --
                -- AUTO_INCREMENT for table `template_data`
                --
                ALTER TABLE `template_data`
                  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
                COMMIT;
                
                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
                ");
            }
            $tmpTableName = strtolower($_POST['tblName']);
            $primary_key = endsWith($tmpTableName, 's') ? substr($tmpTableName, 0, strlen($tmpTableName) - 1) : $tmpTableName;
            $primary_key .= '_id';
            $names = $_POST['name'];
            $types = $_POST['type'];
            $col_typs = $_POST['col_type'];
            $labels = $_POST['label'];
            $sizes = $_POST['slider'];
            $validations = $_POST['validations'];
            $imageData = $_POST['imageData'];
            $column_data = array();
            $label_data = array();
            $type_data = array();
            $join_data = array();
            $form_data = array();
            $image_data = array();
            $validation_data = array();
            if (sizeof($names) == sizeof($types) and sizeof($types) == sizeof($labels)) {
                $query = "CREATE TABLE $tblName (
                                    $primary_key INT(11) AUTO_INCREMENT PRIMARY KEY,";
                foreach ($names as $index => $name) {
                    $query .= "
                        $name $types[$index](150),
                                ";
                    $column_data[$name] = $types[$index];
                    $label_data[$name] = $labels[$index];
                    $type_data[$name] = $col_typs[$index];
                    $join_data[$name] = isset($_POST['class'][$index]) ? $_POST['class'][$index] : '*';
                    $form_data[$name] = $sizes[$index];
                    $validation_data[$name] = isset($validations[$index]) ? $validations[$index] : 'ImageInput';
                    if (isset($imageData[$index])) {
                        $image_data[$name] = ($imageData[$index]);
                    }
                }
                $query = trim($query);
                $query = substr($query, 0, strlen($query) - 1);
                $query .= '  )';
                $column_data = json_encode($column_data, JSON_UNESCAPED_UNICODE);
                $label_data = json_encode($label_data, JSON_UNESCAPED_UNICODE);
                $type_data = json_encode($type_data, JSON_UNESCAPED_UNICODE);
                $join_data = json_encode($join_data, JSON_UNESCAPED_UNICODE);
                $image_data = json_encode($image_data, JSON_UNESCAPED_UNICODE);
                $validation_data = json_encode($validation_data, JSON_UNESCAPED_UNICODE);
                $form_data = json_encode($form_data, JSON_UNESCAPED_UNICODE);
                $res = $conn->query("
                    insert into template_data 
                        (tbl_name,
                         column_data,
                         label_data,
                         type_data,
                         join_data,
                         image_data,
                         validation_data,
                         form_data)
                      VALUES ('$tblName',
                              '$column_data',
                              '$label_data',
                              '$type_data', 
                              '$join_data',
                              '$image_data',
                              '$validation_data',
                              '$form_data')");
                if ($res and $conn->query($query)) {
                    echo showSuccessMsg('جدول' . $tmpTableName, 'ساخت');
                } else {
                    echo showErrorMsg('جدول' . $tmpTableName, 'ساخت');
                }
            }
            break;
    }
}
