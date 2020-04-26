<?php
if (!class_exists('Str')) {
    class Str {
        private $value = '';

        /**
         * @param $name
         * @param $arguments
         * @return string
         */
        public function __call($name, $arguments) {
            return $this->getValue();
        }

        /**
         * @return string
         */
        public function __toString() {
            return $this->getValue();
        }

        /**
         * Str constructor.
         * @param string $string
         */
        public function __construct(string $string) {
            $this->setValue($string);
        }

        public function fistChar() {
            return new Str($this->getValue()[0]);
        }

        public function removeFirst() {
            $this->setValue(substr($this->getValue(), 1, $this->len()));
            return new Str($this->getValue());
        }
        public function removeLast() {
            $this->setValue(substr($this->getValue(), 0, $this->len() - 1));
            return new Str($this->getValue());
        }
        public function removeNth(int $pos) {
            $this->setValue(substr($this->getValue(), 0, $pos).substr($this->getValue(),$pos,$this->len()));
            return new Str($this->getValue());
        }

        public function lastChar() {
            return new Str($this->getValue()[$this->len()]);
        }

        public function nthChar(int $pos) {
            return new Str($this->getValue()[$pos]);
        }

        public function endsWith($needle) {
            $length = strlen($needle);
            if ($length == 0) {
                return true;
            }

            return (substr($this->getValue(), -$length) === $needle);
        }

        public function startsWith($needle) {
            $length = strlen($needle);
            return (substr($this->getValue(), 0, $length) === $needle);
        }

        /**
         * @param string $string
         * @return int
         */
        public function similar_text(string $string) {
            return similar_text($this->getValue(), $string);
        }

        /**
         * @return array
         */
        public function __debugInfo() {
            return array("str" => $this->getValue());
        }

        /**
         * @param $search
         * @param $replace
         * @return string
         */
        public function replace($search, $replace) {
            $this->setValue(str_replace($search, $replace, $this->getValue()));
            return str_replace($search, $replace, $this->getValue());
        }

        /**
         * @param string $delimiter
         * @return array
         */
        public function explode(string $delimiter = '') {
            return explode($delimiter, $this->getValue());
        }

        /**
         * @return string
         */
        public function soundex() {
            return soundex($this->getValue());
        }

        /**
         * @param string $search
         * @param string $resplace
         * @return string|string[]
         */
        public function ireplace(string $search, string $resplace) {
            $this->setValue(str_ireplace($search, $resplace, $this->getValue()));
            return str_ireplace($search, $resplace, $this->getValue());
        }

        /**
         * @param int $length
         * @param string $pad_string
         * @return string
         */
        public function pad(int $length, string $pad_string = '.') {
            $this->setValue(str_pad($this->getValue(), $length, $pad_string));
            return str_pad($this->getValue(), $length, $pad_string);
        }

        /**
         * @param int $multiplier
         * @return string
         */
        public function repeat(int $multiplier) {
            $this->setValue(str_repeat($this->getValue(), $multiplier));
            return str_repeat($this->getValue(), $multiplier);
        }

        /**
         * @return string
         */
        public function shuffle() {
            $this->setValue(str_shuffle($this->getValue()));
            return str_shuffle($this->getValue());
        }

        /**
         * @return int|string[]
         */
        public function word_count() {
            return str_word_count($this->getValue());
        }

        public function strip_tags(string $allow = '') {
            $this->setValue(strip_tags($this->getValue(), $allow));
            return strip_tags($this->getValue(), $allow);
        }

        /**
         * @return string
         */
        public function rev() {
            $this->setValue(strrev($this->getValue()));
            return strrev($this->getValue());
        }

        /**
         * @param string $string
         * @return false|int
         */
        public function pos(string $string) {
            return strpos($this->getValue(), $string);
        }

        /**
         * @return string
         */
        public function Ucwords() {
            return ucwords($this->getValue());
        }

        /**
         * @return string
         */
        public function toUpper() {
            $this->setValue(strtoupper($this->getValue()));
            return strtoupper($this->getValue());
        }

        /**
         * @return string
         */
        public function toLower() {
            $this->setValue(strtolower($this->getValue()));
            return strtolower($this->getValue());
        }

        /**
         * @param string $string
         * @return int
         */
        public function cmp(string $string) {
            return strcmp($this->getValue(), $string);
        }

        /**
         * @param string $string
         * @return false|int
         */
        public function ipos(string $string) {
            return stripos($this->getValue(), $string);
        }

        /**
         * @param string $search
         * @param bool $before_search
         * @return false|string
         */
        public function istr(string $search, bool $before_search = false) {
            return stristr($this->getValue(), $search, $before_search);
        }

        /**
         * @param int $length
         * @return array
         */
        public function split(int $length = 1) {
            return str_split($this->getValue(), $length);
        }

        /**
         * @return int
         */
        public function len() {
            return strlen($this->getValue());
        }

        /**
         * @param string $string
         * @param bool $before_search
         * @return false|string
         */
        public function strstr(string $string, bool $before_search = false) {
            return stristr($this->getValue(), $string, $before_search);
        }

        /**
         * @param string $split
         * @return string
         */
        public function tok(string $split) {
            $this->setValue(strtok($this->getValue(), $split));
            return strtok($this->getValue(), $split);
        }

        /**
         * @param string $charlist
         * @return string
         */
        public function trim(string $charlist) {
            $this->setValue(trim($this->getValue(), $charlist));
            return trim($this->getValue(), $charlist);
        }

        /**
         * @param string $subString
         * @param int $start
         * @param int $length
         * @return int
         */
        public function substr_count(string $subString, int $start = 0, int $length = -1) {
            return substr_count($this->getValue(), $subString, $start, $length > 0 ? $length : $this->len());
        }

        /**
         * @return string
         */
        public function getValue(): string {
            return $this->value;
        }

        /**
         * @param string $value
         */
        private function setValue(string $value) {
            $this->value = $value;
        }
    }
}
