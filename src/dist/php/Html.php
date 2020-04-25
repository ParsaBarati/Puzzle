<?php

if (!class_exists('Tags')) {
    class Tags {
        private $debug = false;
        private $disableAll = false;

        protected function __construct() {
            return $this;
        }

        public function Select(string $name, string $id, string $options, bool $required = true, bool $disabled = false, string $classList = 'form-control', bool $multiple = false) {
            if ($this->debugState() == true) $required = false;
            if ($this->isDisableAll() == true) {
                $disabled = true;
                $required = false;
            }
            if ($this->fill == true) {
                if (!$multiple) {
                    if (((object)$this->getData()->$name)) {
                        $options = str_replace('value="' . $this->getData()->$name . '"', 'value="' . $this->getData()->$name . '" selected', $options);
                    }
                } else {
                    $tmp_name = removeAfter($name, '[');
                    if ($data = is_json($this->getData()->$tmp_name, true, true)) {
                        foreach ($data as $datum) {
                            $options = str_replace('value="' . $datum . '"', 'value="' . $datum . '" selected', $options);
                        }
                    }
                }
            }
            return '<select ' . ($multiple ? 'multiple="multiple"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' ' . (strlen($name) > 0 ? 'name="' . $name . '"' : '') . ' id="' . $id . '" autocomplete="off">' . $options . '</select>';
        }

        public function Option(string $value, string $name, string $data_value = '', string $fw_id = '') {
            return '<option fw_id="' . $fw_id . '" data-value="' . $data_value . '" value="' . $value . '">' . $name . '</option>';
        }

        public function Label(string $data, string $for = '', string $id = '', string $classList = '') {
            return '<label class="' . $classList . '" id="' . $id . '" ' . (strlen($for) > 0 ? 'for="' . $for . '"' : '') . '>' . $data . '</label>';
        }

        public function self() {
            return new self();
        }

        public function ImageInput(string $name = 'image', string $accept = 'image/*', int $check_width = 150, int $check_height = 150, string $check_required = 'true', string $id = 'putSameWithName', bool $required = true, bool $disabled = false, string $classList = 'form-control') {
            if ($id === 'putSameWithName') $id = $name;
            if ($this->debugState() == true) $required = false;
            if ($this->isDisableAll() == true) {
                $disabled = true;
                $required = false;
            }
            $file = end(explode('/', str_replace(__SOURCE__, '', debug_backtrace()[0]['file'])));
            $res = '';
            if ($this->fill == true) {
                $thisView = (endsWith(removeAfter($this->getThis(), '?'), '.php') ? removeAfter($this->getThis(), '?') : removeAfter($this->getThis(), '?') . '.php');
                $images = is_json(CallAPI('POST', str_replace('views/', '', str_replace($thisView, endsWith($this->getControllerPath(), '.php') ? $this->getControllerPath() : $this->getControllerPath() . '.php', 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'])), array("View_class_request" => 'getUploadsList')), true);
                if ($images) {
                    $res = '<img width="150" height="150" src="' . str_replace('../', '', $images->$name) . $this->getData()->$name . '">';
                }
                $required = false;
            }
            return (strpos($file, 'delete') !== false ? '' : '<input check-width="' . $check_width . '" check-height="' . $check_height . '" check-required="' . $check_required . '" accept="' . $accept . '"  type="file" name="' . $name . '" id="' . $id . '" ' . ($required ? 'required' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '">' . '<script>$("#' . $id . '").checkImage()</script>') . $res;
        }

        public function Input(string $name, string $id = 'putSameWithName', $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control', string $type = 'text', string $attrs = '') {
            if ($this->debugState() == true) $required = false;
            if ($this->isDisableAll() == true) {
                $disabled = true;
                $required = false;
            }
            if ($id === 'putSameWithName') $id = $name;
            if ($this->fill == true) {
                if (!strlen($value) > 0) {
                    if (endsWith($name, ']')) {
                        $tmp_name = removeAfter($name, '[');
                        $tmp_name = str_replace($tmp_name, '', str_replace('[', '', str_replace(']', '', $name)));
                        if ($data = is_json($this->getData()->{removeAfter($name, '[')}, true, true)) {
                            $value = $data[$tmp_name];
                        }
                    } elseif (((object)$this->getData()->$name)) {
                        $value = $this->getData()->$name;
                    }
                } elseif ($type === 'checkbox' || $type == 'radio') {
                    if (endsWith($name, ']')) {
                        $tmp_name = removeAfter($name, '[');
                        if ((is_string($this->getData()->$tmp_name) || is_numeric($this->getData()->$tmp_name)) and !is_json($this->getData()->$tmp_name)) {
                            if ($value == $this->getData()->$tmp_name) {
                                $attrs .= ' checked ';
                            }
                        } elseif ($data = is_json($this->getData()->$tmp_name, true, true)) {
                            if (in_array($value, $data)) {
                                $attrs .= ' checked ';
                            }
                        }
                    } else {
                        if ($data = is_json($this->getData()->$name, true, true)) {
                            if (in_array($value, $data)) {
                                $attrs .= ' checked ';
                            }
                        } elseif ((is_string($this->getData()->$name) || is_numeric($this->getData()->$name))) {
                            if ($value == $this->getData()->$name) {
                                $attrs .= ' checked ';
                            }
                        }
                    }
                }
            }
            if ($name == 'password') {
                $file = end(explode('/', str_replace(__SOURCE__, '', debug_backtrace()[0]['file'])));
                $res = '';
                if (strpos($file, 'delete') !== false) {
                    $required = false;
                } elseif (strpos($file, 'edit') !== false) {
                    $required = false;
                }
                $value = '';
            }
            return '<input ' . $attrs . ' type="' . $type . '" ' . (strlen($value) > 0 ? 'value="' . $value . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off">';
        }
        public function Number(string $name, string $id = 'putSameWithName', $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control', string $type = 'text', string $attrs = '') {
            if ($this->debugState() == true) $required = false;
            if ($this->isDisableAll() == true) {
                $disabled = true;
                $required = false;
            }
            if ($id === 'putSameWithName') $id = $name;
            if ($this->fill == true) {
                if (!strlen($value) > 0) {
                    if (endsWith($name, ']')) {
                        $tmp_name = removeAfter($name, '[');
                        $tmp_name = str_replace($tmp_name, '', str_replace('[', '', str_replace(']', '', $name)));
                        if ($data = is_json($this->getData()->{removeAfter($name, '[')}, true, true)) {
                            $value = $data[$tmp_name];
                        }
                    } elseif (((object)$this->getData()->$name)) {
                        $value = $this->getData()->$name;
                    }
                }
            }
            if ($name == 'password') {
                $file = end(explode('/', str_replace(__SOURCE__, '', debug_backtrace()[0]['file'])));
                $res = '';
                if (strpos($file, 'delete') !== false) {
                    $required = false;
                } elseif (strpos($file, 'edit') !== false) {
                    $required = false;
                }
                $value = '';
            }
            return '<input ' . $attrs . ' type="' . $type . '" ' . (strlen($value) > 0 ? 'value="' . $value . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off">'.'<script>$("#'.$id.'").checkNumber()</script>';
        }
        public function English(string $name, string $id = 'putSameWithName', $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control', string $type = 'text', string $attrs = '') {
            if ($this->debugState() == true) $required = false;
            if ($this->isDisableAll() == true) {
                $disabled = true;
                $required = false;
            }
            if ($id === 'putSameWithName') $id = $name;
            if ($this->fill == true) {
                if (!strlen($value) > 0) {
                    if (endsWith($name, ']')) {
                        $tmp_name = removeAfter($name, '[');
                        $tmp_name = str_replace($tmp_name, '', str_replace('[', '', str_replace(']', '', $name)));
                        if ($data = is_json($this->getData()->{removeAfter($name, '[')}, true, true)) {
                            $value = $data[$tmp_name];
                        }
                    } elseif (((object)$this->getData()->$name)) {
                        $value = $this->getData()->$name;
                    }
                }
            }
            if ($name == 'password') {
                $file = end(explode('/', str_replace(__SOURCE__, '', debug_backtrace()[0]['file'])));
                $res = '';
                if (strpos($file, 'delete') !== false) {
                    $required = false;
                } elseif (strpos($file, 'edit') !== false) {
                    $required = false;
                }
                $value = '';
            }
            return '<input ' . $attrs . ' type="' . $type . '" ' . (strlen($value) > 0 ? 'value="' . $value . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off">'.'<script>$("#'.$id.'").checkEnglish()</script>';
        }

        public function NumberInput(string $name, float $min = 0, float $max = 1, float $steps = 0.25, string $id = 'putSameWithName', string $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control') {
            if ($this->debugState() == true) $required = false;
            if ($this->isDisableAll() == true) {
                $disabled = true;
                $required = false;
            }
            if ($id === 'putSameWithName') $id = $name;
            if ($this->fill == true) {
                if (((object)$this->getData()->$name)) $value = $this->getData()->$name;
            }
            return '<input ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" ' . (strlen($value) > 0 ? 'value="' . $value . '"' : '') . ' type="number" min="' . $min . '" step="' . $steps . '" max="' . $max . '">';
        }

        public function TextArea(string $name, string $id, $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control',string $attrs = '') {
            if ($this->debugState() == true) $required = false;
            if ($this->isDisableAll() == true) {
                $disabled = true;
                $required = false;
            }
            if ($id === 'putSameWithName') $id = $name;
            if ($this->fill == true) {
                if (((object)$this->getData()->$name)) {
                    $value = $this->getData()->$name;
                }
            }
            return '<textarea '.$attrs.' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off">' . $value . '</textarea>';
        }

        public function Price(string $name, string $id, string $price_unit = 'تومان', $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control') {
            if ($this->debugState() == true) $required = false;
            if ($this->isDisableAll() == true) {
                $disabled = true;
                $required = false;
            }
            if ($id === 'putSameWithName') $id = $name;
            if ($this->fill == true) {
                if (((object)$this->getData()->$name)) $value = $this->getData()->$name;
            }
            return '<fw-price ' . (strlen($value) > 0 ? 'value="' . number_format($value) . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off" price-unit=' . $price_unit . '>';
        }


        public function Mobile(string $name, string $id, $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control') {
            if ($this->debugState() == true) $required = false;
            if ($this->isDisableAll() == true) {
                $disabled = true;
                $required = false;
            }
            if ($id === 'putSameWithName') $id = $name;
            if ($this->fill == true) {
                if (((object)$this->getData()->$name)) $value = MobileFormat($this->getData()->$name);
            }
            return '<fw-mobile dir="ltr" ' . (strlen($value) > 0 ? 'value="' . $value . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off">';
        }

        public function Tel(string $name, string $id, string $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control') {
            if ($this->debugState() == true) $required = false;
            if ($this->isDisableAll() == true) {
                $disabled = true;
                $required = false;
            }
            if ($id === 'putSameWithName') $id = $name;
            if ($this->fill == true) {
                if (((object)$this->getData()->$name)) $value = TelFormat($this->getData()->$name);
            }
            return '<fw-tell  dir="ltr" ' . (strlen($value) > 0 ? 'value="' . $value . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off">';
        }

        /**
         * @return bool
         */
        private function debugState(): bool {
            return $this->debug;
        }

        public function isDebug() {
            $this->debug = true;
        }

        /**
         * @return bool
         */
        private function isDisableAll(): bool {
            return $this->disableAll;
        }

        /**
         */
        public function doDisableAll() {
            $this->disableAll = true;
        }
    }
}
if (!class_exists('Html')) {
    class Html extends Tags {
        public $Tags;

        protected function __construct() {
            $this->Tags = parent::__construct();
            return $this;
        }

        public function topBtn(string $link, string $title, string $icon = 'fa fa-refresh', string $color = 'primary', bool $outline = true, string $id = '') {
            return '<a ' . (strlen($id) > 0 ? 'id="' . $id . '"' : '') . ' rel="' . $link . '" class="btn btn-' . ($outline ? 'outline-' : '') . $color . ' pull-left m-2 ajax"><i
                                class="' . $icon . '"></i> ' . $title . ' </a>';
        }

        public function InputGroup(string $inputName, string $inputId, string $inputGroupAppend, bool $required = true, string $value = '') {
            if ($this->fill == true) {
                if (isset($this->getData()->$inputName)) $value = $this->getData()->$inputName;
            }
            return '<div class="input-group">
                                <input value="' . $value . '" class="form-control" name="' . $inputName . '" id="' . $inputId . '"
                                       autocomplete="off" ' . ($required ? 'required' : '') . '>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                    ' . $inputGroupAppend . '
                                    </span>
                                </div>
                            </div>';
        }

        public function FormGroupStart(int $col = 4) {
            return '<div class="form-group col-md-' . $col . '">';
        }

        public function FormGroupEnd() {
            return '</div>';
        }


        public function CheckBoxToggle(string $labelText, string $inputName, string $inputID = '', string $inputValue = '1', bool $required = true, int $col_md_ = 4, bool $checked = false) {

            return ' <div class="d-flex row m-2">
                                    ' . parent::Label($labelText, $inputID, '', 'm-2') . parent::Input($inputName, $inputID, $inputValue, $required, false, 'form-control bs-toggle', 'checkbox', ($checked ? 'checked' : '')) . '</div>';
        }


    }
}
