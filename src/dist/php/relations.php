<?php

namespace DATABASE;

use Error;
use helpers\numToWord;

trait relations
{
    /**
     * @param $childClass
     * @param bool $foreignKeyValue
     * @param bool $foreignKey
     * @return array
     */
    protected function hasChildrenIn($childClass, $foreignKeyValue = false, $foreignKey = false)
    {
        global $conn;
        $childTableName = $childClass::table;
        $parentTableName = $this::table;
        $parentKeyName = $this::key;
        $theKeyThatTheyWillJoinWith = $foreignKey ? $foreignKey : $childClass::key;
        $query = "SELECT * FROM `$childTableName` as child left join `$parentTableName` as parent on child.$theKeyThatTheyWillJoinWith = parent.$parentKeyName";
        if ($foreignKeyValue) {
            $query .= " where child.$foreignKey = '$foreignKeyValue'";
        }
        $res = $conn->query($query);
        $output = array();
        while ($row = $res->fetchObject()) {
            array_push($output, $row);
        }
        return $output;
    }

    /**
     * @param $parentClass
     * @param bool $foreignKey
     * @param bool $foreignKeyValue
     * @return array
     */
    protected function isChildOf($parentClass, $foreignKey = false, $foreignKeyValue = false, string $filterKey = '', string $filterValue = '')
    {
        global $conn;
        $childTableName = $this::table;
        $parentTableName = $parentClass::table;
        $parentKeyName = $parentClass::key;
        $theKeyThatTheyWillJoinWith = $foreignKey ? $foreignKey : $parentClass::key;
        $query = "SELECT * FROM `$childTableName` as child left join `$parentTableName` as parent on child.$theKeyThatTheyWillJoinWith = parent.$parentKeyName";
        if ($foreignKey) {
            $query .= " where child.$foreignKey = '$foreignKeyValue'";
        }
        if (strlen($filterKey) > 0 and strlen($filterValue) > 0) {
            if (strpos($query,'where') !== false) {
                $query .= " and $filterKey = $filterValue";
            } else {
                $query .= " where $filterKey = $filterValue";
            }
        }
        $res = $conn->query($query);
        $output = array();
        while ($row = $res->fetchObject()) {
            $output[] = $row;
        }
        return  $output;
    }

    /**
     * @param $siblingClass
     * @param $commonKeyForCurrentClass
     * @param $commonKeyForOther
     * @param bool $joinKeyValue
     * @return array
     */
    protected function sharesWith($siblingClass, $commonKeyForCurrentClass, $commonKeyForOther, $joinKeyValue = false)
    {
        global $conn;
        $firstTable = $this::table ? $this::table : '';
        if ($firstTable == '') {
            throw new Error('the current class doesn\'t have the table constant');
        }
        $secTable = $siblingClass::table ? $siblingClass::table : '';
        if ($secTable == '') {
            throw new Error('the sibling class doesn\'t have the table constant');
        }
        $query = "SELECT * FROM `$firstTable` as one left join `$secTable` as sec on one.$commonKeyForCurrentClass = sec.$commonKeyForOther";
        if ($joinKeyValue) {
            $query .= " where one.$commonKeyForCurrentClass = '$joinKeyValue'";
        }
        $res = $conn->query($query);
        $output = array();
        while ($row = $res->fetchObject()) {
            array_push($output, $row);
        }
        return $output;
    }

    /**
     * @param $firstSiblingClass
     * @param $commonKeyForCurrentClass
     * @param $secondSiblingClass
     * @param $commonKeyForSecond
     * @param $commonKeyForThird
     * @param bool $joinKeyValue
     * @return array
     */
    protected function sharesWithTwoClasses($firstSiblingClass, $commonKeyForCurrentClass, $secondSiblingClass, $commonKeyForSecond, $commonKeyForThird, $joinKeyValue = false)
    {
        global $conn;
        $firstTable = $this::table ? $this::table : '';
        if ($firstTable == '') {
            throw new Error('the current class doesn\'t have the table constant');
        }
        $secTable = $firstSiblingClass::table ? $firstSiblingClass::table : '';
        if ($secTable == '') {
            throw new Error('the first sibling class doesn\'t have the table constant');
        }
        $thirdTable = $secondSiblingClass::table ? $secondSiblingClass::table : '';
        if ($thirdTable == '') {
            throw new Error('the second sibling class doesn\'t have the table constant');
        }
        $query = "SELECT * FROM `$firstTable` as one left join `$secTable` as sec on one.$commonKeyForCurrentClass = sec.$commonKeyForSecond left join $thirdTable as third on sec.$commonKeyForSecond = third.$commonKeyForThird";
        if ($joinKeyValue) {
            $query .= " where one.$commonKeyForCurrentClass = '$joinKeyValue'";
        }
        $res = $conn->query($query);
        $output = array();
        while ($row = $res->fetchObject()) {
            array_push($output, $row);
        }
        return $output;
    }
    protected function joinsWithMany($arrayOfClasses) {
        global $conn;
        $table = $this::table;
        foreach ($arrayOfClasses as $foreign_key => $class) {
            if ($foreign_key == 'default')
                $foreign_key = $class::key;
            $classTable = $class::table;

        }
    }
    protected function joinsWithTwo($firstSiblingClass,$secondClass,string $foreign_key_for_first = '', string $foreign_key_for_second = '') {
        global $conn;
        if ($foreign_key_for_first === '')
            $foreign_key_for_first = $firstSiblingClass::key;
        if ($foreign_key_for_second === '')
            $foreign_key_for_second = $secondClass::key;
        $firstSiblingClassKey = $firstSiblingClass::key;
        $secondClassKey = $secondClass::key;
        $firstSiblingClassTable = $firstSiblingClass::table;
        $secondClassTable = $secondClass::table;
        $thisTable = $this::table;
        $query = "SELECT * FROM `$thisTable` as one left join `$firstSiblingClassTable` as sec on one.$foreign_key_for_first = sec.$firstSiblingClassKey left join $secondClassTable as third on one.$foreign_key_for_second = third.$secondClassKey";
        $res = $conn->query($query);
        $output = array();
        while ($row = $res->fetchObject()) {
            array_push($output, $row);
        }
        return $output;
    }
    /**
     * @param array $arrayOfClasses
     * @return array
     */
    protected function sharesWithMany(array $arrayOfClasses)
    {
        global $conn;
        $i = 0;
        $lastFKey = '';
        $query = '';
        foreach ($arrayOfClasses as $foreignKey => $instance) {
            $i++;
            $table = $instance::table;
            if ($i == 1) {
                $query .= "select * from $table as one left join ";
            } else {
                if (is_odd($i)) {
                    $query .= "$table as " . numToWord::convert($i) . " on " . numToWord::convert($i - 1) . ".$lastFKey  = " . numToWord::convert($i) . "." . (strpos($foreignKey,'lastFKey') ? $lastFKey : $foreignKey) . " ";
                } else {
                    $query .= "left join $table as " . numToWord::convert($i) . " on " . numToWord::convert($i - 1) . ".$lastFKey  = " . numToWord::convert($i) . "." . (strpos($foreignKey,'lastFKey') ? $lastFKey : $foreignKey) . " ";
                }
            }
            $lastFKey = strpos($foreignKey,'lastFKey') ? $lastFKey : $foreignKey;
        }
        $res = $conn->query($query);
        $output = array();
        while ($row = $res->fetchObject()) {
            array_push($output, $row);
        }
        return $output;
    }
}
