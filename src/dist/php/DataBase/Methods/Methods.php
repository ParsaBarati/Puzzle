<?php
namespace FwDBInteraction\Primitive\Methods;
if (!trait_exists('Methods')) {
    trait Methods {
        protected function GenUpdate(array $cols) {
            $fields = "";
            foreach ($cols as $field => $value) {
                if ($value instanceof \Str) {
                    $value = $value->__toString();
                }
                if ($field instanceof \Str) {
                    $field = $field->__toString();
                }
                $fields .= " `$field` = '$value' ,";
            }
            $fields = substr($fields, 0, strlen($fields) - 1);
            return $fields;
        }

        protected function GenInsert(array $cols) {
            $fields = "";
            $values = "";
            foreach ($cols as $key => $value) {
                if ($value instanceof \Str) {
                    $value = $value->__toString();
                }
                if ($key instanceof \Str) {
                    $key = $key->__toString();
                }
                $fields .= " $key,";
                $values .= "'$value',";
            }
            $fields = substr($fields, 0, strlen($fields) - 1);
            $values = substr($values, 0, strlen($values) - 1);
            return "(" . $fields . ") VALUES (" . $values . ")";
        }
    }
}
