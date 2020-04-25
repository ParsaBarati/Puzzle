<?php
if (!class_exists('Controller')) {


    class Controller {
        private $model;
        public $output;
        public $name;
        private $methods = array();
        private $doesOwnFunctionOnAdd = false;
        private $doesOwnFunctionOnEdit = false;
        private $debugViews = false;
        private $doesOwnFunctionOnDelete = false;
        private $doesOwnFunctionOnGet = false;
        private $doesOwnFunctionOnGetAll = false;
        public $key;
        private $uploads = array();
        private $checkBoxes = array();
        public $keyValue;
        private $fullCheckArray = array("add" => true, "edit" => true, "delete" => true);
        private $csrfCheckArray = array("add" => true, "edit" => true, "delete" => true);
        private $checkAll = true;
        private $csrfValidate = true;
        public $requestArray = array();
        public $controller_type = null;
        private $__files;
        private $request_type = 'external';
        private $filterGetAll = '';
        private $filterGetAllValue = '';
        private $View_class_request;

        public function __construct($modelInstance, array $__REQUEST, string $name, bool $unsetControllerType = true, array $fullCheckArray = array("add" => true, "edit" => true, "delete" => true), array $csrfCheckArray = array("add" => true, "edit" => true, "delete" => true)) {

            if (isset($__REQUEST['View_class_request'])) {
                $this->setViewClassRequest(deStr($__REQUEST['View_class_request']));
                unset($__REQUEST['View_class_request']);
            }
            $this->setModel($modelInstance);
            $this->setKey($modelInstance::key);
            if (isset($__REQUEST[$this->key()])) {
                $this->setKeyValue($__REQUEST[$this->key()]);
            }
            if (isset($__REQUEST['ajax_type'])) {
                $this->setRequestType($__REQUEST['ajax_type']);
            }
            $this->setOutput(null);
            $this->setName($name);
            $this->setFullCheckArray($fullCheckArray);
            $this->setCsrfCheckArray($csrfCheckArray);
            $this->setMethods(array("add" => function () {
                $this->add();
            }, "edit" => function () {
                $this->edit();
            }, "delete" => function () {
                $this->delete();
            }, "get" => function () {
                $this->get();
            }));
            $this->setRequestArray($__REQUEST, $unsetControllerType);
        }

        public function addField($key, $value) {
            $this->requestArray[$key] = $value;
        }

        private function configureReferrer($__GET) {
            if ($object = is_json($this->output, true, true)) {
                if (isset($__GET['fw_referrer'])) {
                    $object['fw_referrer'] = $__GET['fw_referrer'];
                    $this->setOutput(jsonEncode($object));
                }
            }
        }

        /**
         * @return bool
         */
        public function isCsrfValidated(): bool {
            return $this->csrfValidate;
        }

        /**
         * @param bool $csrfValidate
         */
        public function canCsrfValidate(bool $csrfValidate) {
            $this->csrfValidate = $csrfValidate;
        }

        /**
         * @return bool
         */
        public function isCheckedAll(): bool {
            return $this->checkAll;
        }

        /**
         * @param bool $checkAll
         */
        public function canCheckAll(bool $checkAll) {
            $this->checkAll = $checkAll;
        }

        /**
         * @return array
         */
        public function getMethods(): array {
            return $this->methods;
        }

        /**
         * @param array $methods
         */
        public function setMethods(array $methods) {
            $this->methods = $methods;
        }

        /**
         * @return bool
         */
        public function DoesOwnFunctionOnAdd(): bool {
            return $this->doesOwnFunctionOnAdd;
        }

        /**
         * @param bool $doesOwnFunctionOnAdd
         */
        public function setOwnFunctionOnAdd(bool $doesOwnFunctionOnAdd) {
            $this->doesOwnFunctionOnAdd = $doesOwnFunctionOnAdd;
        }

        /**
         * @return bool
         */
        public function DoesOwnFunctionOnEdit(): bool {
            return $this->doesOwnFunctionOnEdit;
        }

        /**
         * @param bool $doesOwnFunctionOnEdit
         */
        public function setOwnFunctionOnEdit(bool $doesOwnFunctionOnEdit) {
            $this->doesOwnFunctionOnEdit = $doesOwnFunctionOnEdit;
        }

        /**
         * @return bool
         */
        public function DoesOwnFunctionOnDelete(): bool {
            return $this->doesOwnFunctionOnDelete;
        }

        /**
         * @param bool $doesOwnFunctionOnDelete
         */
        public function setOwnFunctionOnDelete(bool $doesOwnFunctionOnDelete) {
            $this->doesOwnFunctionOnDelete = $doesOwnFunctionOnDelete;
        }

        /**
         * @return bool
         */
        public function DoesOwnFunctionOnGet(): bool {
            return $this->doesOwnFunctionOnGet;
        }

        /**
         * @param bool $doesOwnFunctionOnGet
         */
        public function setOwnFunctionOnGet(bool $doesOwnFunctionOnGet) {
            $this->doesOwnFunctionOnGet = $doesOwnFunctionOnGet;
        }

        /**
         * @return bool
         */
        public function DoesOwnFunctionOnGetAll(): bool {
            return $this->doesOwnFunctionOnGetAll;
        }

        /**
         * @param bool $doesOwnFunctionOnGetAll
         */
        public function setOwnFunctionOnGetAll(bool $doesOwnFunctionOnGetAll) {
            $this->doesOwnFunctionOnGetAll = $doesOwnFunctionOnGetAll;
        }

        /**
         * @return mixed
         */
        public function model() {
            return $this->model;
        }

        /**
         * @param mixed $model
         */
        private function setModel($model) {
            $this->model = $model;
        }

        /**
         * @return null
         */
        public function castOutput() {
            $this->configureReferrer($this->requestArray());
            if ($this->debugViews) {
                var_dump($this->output);
            } else {
                echo(($this->getRequestType() === 'internal' ? "controller_key: $this->key ||||||" : '') . $this->output);
            }
        }

        /**
         * @param null $output
         */
        public function setOutput($output) {
            $this->output = $output;
        }

        /**
         * @return mixed
         */
        public function requestArray() {
            return $this->requestArray;
        }

        /**
         * @param mixed $requestArray
         * @param $unsetControllerType
         */
        public function setRequestArray($requestArray, $unsetControllerType = false) {
            if ($unsetControllerType) {
                if (isset($requestArray['controller_type'])) {
                    $this->setControllerType($requestArray['controller_type']);
                    unset($requestArray['controller_type']);
                }
            }
            $this->requestArray = $requestArray;
        }

        /**
         * @return mixed
         */
        public function controller_type() {
            return $this->controller_type;
        }

        /**
         * @param mixed $controller_type
         */
        public function setControllerType($controller_type) {
            $controller_type = deStr($controller_type);
            $this->controller_type = $controller_type;
        }

        /**
         * @return mixed
         */
        public function key() {
            return $this->key;
        }

        /**
         * @param mixed $key
         */
        public function setKey($key) {
            $key = deStr($key);
            $this->key = $key;
        }


        /**
         * @param string $controller_type
         * @param string $functionName
         * @param array $args
         * @param bool $changeOutput
         */
        public function addMethod(string $controller_type, string $functionName, array $args, bool $changeOutput = true) {
            $this->addToMethods($controller_type, $functionName, $args, $changeOutput);
        }

        /**
         * @param string $controller_type
         * @param string $function
         * @param array $args
         * @param $changeOutput
         */
        private function addToMethods(string $controller_type, string $function, array $args, $changeOutput) {
            $this->methods[$controller_type] = function () use ($changeOutput, $function, $args) {
                if ($changeOutput === true) {
                    $this->setOutput(call_user_func_array($function, $args));
                } else {
                    $function(implode(',', $args));
                }
            };
        }

        /**
         * @return mixed
         */
        public function getName() {
            return $this->name;
        }

        /**
         * @param mixed $name
         */
        public function setName($name) {
            $name = deStr($name);
            $this->name = $name;
        }

        public function onAdd(bool $checkAll = true, bool $csrfValidate = true, string $function = '', array $args = array()) {
            if (strlen($function) > 1 and function_exists($function)) {
                $this->addMethod('add', $function, $args);
                $this->setOwnFunctionOnAdd(true);
            } else {
                $this->canCheckAll($checkAll);
                $this->canCsrfValidate($csrfValidate);
            }
        }

        private function add() {
            if ($this->DoesOwnFunctionOnAdd()) {
                $this->getMethods()['add'];
            } else {
                $array = $this->requestArray();
                foreach ($this->getCheckBoxes() as $key => $defaultValue) {
                    if (!isset($array[$key])) {
                        $array[$key] = $defaultValue;
                    }
                }
                foreach ($this->uploads as $name => $path) {
                    if (isset($this->__files[$name]['name']) and strlen($this->__files[$name]['name']) > 0) {
                        $checkImage = checkImage($this->requestArray());
                        if ($checkImage) {
                            $fileName = uploadImage($this->__files[$name], $checkImage, $path, true, $name);
                        } else {
                            $fileName = uploadImage($this->__files[$name], $checkImage, $path, false, $name);
                        }
                        $array[$name] = $fileName;
                    }
                }
                $this->setRequestArray($array);
                $this->setOutput(showResult($this->model()->add($this->getFullCheckField('add') ? checkAll($this->requestArray(), $this->getCsrfCheckField('add') ? true : false, true) : $this->requestArray()), $this->getName(), 'افزودن'));
            }
        }

        private function delete() {
            if ($this->DoesOwnFunctionOnDelete()) {
                $this->getMethods()['delete'];
            } else {
                $deletable = $this->model()->get($this->getKeyValue());
                foreach ($this->uploads as $name => $path) {
                    if ($deletable->$name !== 'default.png' || $deletable->$name !== 'default.jpg') {
                        if (file_exists($path . $deletable->$name)) {
                            unlink($path . $deletable->$name);
                        }
                    }
                }
                $this->setOutput(showResult($this->model()->delete(cleanMe($this->getKeyValue())), $this->getName(), 'حذف'));
            }
        }

        private function edit() {
            if ($this->DoesOwnFunctionOnEdit()) {
                $this->getMethods()['edit'];
            } else {
                $array = $this->requestArray();
                foreach ($this->getCheckBoxes() as $key => $defaultValue) {
                    if (!isset($array[$key])) {
                        $array[$key] = $defaultValue;
                    }
                }
                foreach ($this->uploads as $name => $path) {
                    if (isset($this->__files[$name]) && strlen($this->__files[$name]['name']) > 0) {
                        $deletable = (object)deStr($this->model()->get($this->getKeyValue()));
                        if ($deletable->$name !== 'default.png' || $deletable->$name !== 'default.jpg') {
                            if (file_exists($path . $deletable->$name)) {
                                unlink($path . $deletable->$name);
                            }
                        }
                        $checkImage = checkImage($this->requestArray());
                        if ($checkImage) {
                            $fileName = uploadImage($this->__files[$name], $checkImage, $path, true, $name);
                        } else {
                            $fileName = uploadImage($this->__files[$name], $checkImage, $path, false, $name);
                        }
                        $array[$name] = $fileName;
                    }
                }
                $this->setRequestArray($array);
                $this->setOutput(showResult($this->model()->edit($this->getKeyValue(), $this->getFullCheckField('edit') ? checkAll($this->requestArray(), $this->getCsrfCheckField('edit') ? true : false, true) : $this->requestArray()), $this->getName(), 'ویرایش'));
            }
        }

        private function get() {
            if ($this->DoesOwnFunctionOnGet()) {
                $this->getMethods()['get'];
            } else {
                $this->setOutput(jsonEncode($this->model()->get(cleanMe($this->getKeyValue()))));
            }
        }

        public function do() {
            if (isset($this->View_class_request) && $this->getViewClassRequest() === 'getUploadsList') {
                $this->setOutput(json_encode($this->uploads));
            } else {
                if (strlen($this->controller_type) > 0) {
                    $this->methods[$this->controller_type()]();
                } else {
                    $this->default();
                }
            }
        }

        public function isDebugView() {
            $this->debugViews = true;
        }

        /**
         * @return mixed
         */
        public function getKeyValue() {
            return $this->keyValue;
        }

        /**
         * @param mixed $keyValue
         */
        public function setKeyValue($keyValue) {
            $this->keyValue = $keyValue;
        }

        private function getFullCheckField($field) {
            return $this->getFullCheckArray()[$field];
        }

        private function getCsrfCheckField($field) {
            return $this->getCsrfCheckArray()[$field];
        }

        public function default() {
            if (strlen($this->getFilterGetAll()) > 0) {
                $this->setOutput(jsonEncode($this->model()->getAllFiltered($this->getFilterGetAll(), $this->getFilterGetAllValue())));
            } else {
                $this->setOutput(jsonEncode($this->model()->getAll()));
            }
        }


        /**
         * @return array
         */
        private function getCsrfCheckArray(): array {
            return $this->csrfCheckArray;
        }

        /**
         * @param array $csrfCheckArray
         */
        private function setCsrfCheckArray(array $csrfCheckArray) {
            $this->csrfCheckArray = $csrfCheckArray;
        }

        /**
         * @return array
         */
        private function getFullCheckArray(): array {
            return $this->fullCheckArray;
        }

        /**
         * @param array $fullCheckArray
         */
        private function setFullCheckArray(array $fullCheckArray) {
            $this->fullCheckArray = $fullCheckArray;
        }

        /**
         * @return array
         */
        private function getCheckBoxes(): array {
            return $this->checkBoxes;
        }

        /**
         * @param array $checkBoxes
         */
        public function CheckBoxes(array $checkBoxes) {
            $this->checkBoxes = $checkBoxes;
        }

        /**
         * @return array
         */
        public function seeUploads(): array {
            return $this->uploads;
        }

        /**
         * @param array $uploads
         * @param array $__FILES
         * @return void
         */
        public function Uploads(array $uploads, array $__FILES) {
            $this->setFiles($__FILES);
            $this->uploads = $uploads;
        }

        /**
         * @return string
         */
        private function getRequestType(): string {
            return $this->request_type;
        }

        /**
         * @param string $request_type
         */
        private function setRequestType(string $request_type) {
            $request_type = deStr($request_type);
            $this->request_type = $request_type;
        }

        public function FilterDefault(string $filterField, string $filterFieldInArray = 'sameWithDefaultFilterField') {
            $this->setFilterGetAll($filterField);
            if ($filterFieldInArray === 'sameWithDefaultFilterField') $filterFieldInArray = (((array)$this->requestArray())[$filterField]);
            $this->setFilterGetAllValue($filterFieldInArray);
        }

        /**
         * @return string
         */
        private function getFilterGetAllValue(): string {
            return $this->filterGetAllValue;
        }

        /**
         * @param string $filterGetAllValue
         */
        private function setFilterGetAllValue(string $filterGetAllValue) {
            $filterGetAllValue = deStr($filterGetAllValue);
            $this->filterGetAllValue = $filterGetAllValue;
        }

        /**
         * @return string
         */
        private function getFilterGetAll(): string {
            return $this->filterGetAll;
        }

        /**
         * @param string $filterGetAll
         */
        private function setFilterGetAll(string $filterGetAll) {
            $filterGetAll = deStr($filterGetAll);
            $this->filterGetAll = $filterGetAll;
        }

        /**
         * @return mixed
         */
        private function getViewClassRequest() {
            return $this->View_class_request;
        }

        /**
         * @param mixed $View_class_request
         */
        private function setViewClassRequest($View_class_request) {
            $this->View_class_request = $View_class_request;
        }

        /**
         * @return mixed
         */
        private function getFiles() {
            return $this->__files;
        }

        /**
         * @param mixed $_files
         */
        private function setFiles($_files) {
            $this->__files = $_files;
        }
    }
}
