<?php

class View extends Html {
    private $data;
    private $referrer;
    private $thisView;
    public $singularName;
    public $pluralName;
    private $controllerPath;
    private $parentUrl;
    private $Html;
    private $key;
    protected $fill = false;

    public function __construct(array $__REQUEST, string $singularName, string $pluralName = '', bool $dataTable = true, bool $checkSelect = true, $checkIcon = true, bool $checkCheckBox = true, bool $fw_tags = true, bool $ajax = true, bool $tooltipShowAndHide = true, string $parentUrl = '') {
        $allFiles = [];
        $views = [];
        $controllers = [];
        foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'views/')), '/\.php$/') as $phpFile) {
            $fileName = $phpFile->getFileName();
            $views[] = (true ? str_replace('.php', '', str_replace(__SOURCE__, '', $phpFile->getRealPath())) : str_replace(__SOURCE__, '', $phpFile->getRealPath()));
            $allFiles[] = (true ? str_replace('.php', '', $fileName) : $fileName);
        }
        foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'controllers/')), '/\.php$/') as $phpFile) {
            $controllers[] = (true ? str_replace('.php', '', str_replace(__SOURCE__, '', $phpFile->getRealPath())) : str_replace(__SOURCE__, '', $phpFile->getRealPath()));
        }
        echo '<script>
                ' . ($ajax ? '$(document).ajaxStart(function () {
                    Pace.restart();
                });
                $.Ajax(' . json_encode($allFiles) . ', ' . json_encode($views) . ', ' . json_encode($controllers) . ')' : '') . '
                ' . ($tooltipShowAndHide ? '$("[data-toggle=tooltip]").tooltip();
                $(".tooltip").hide();' : '') . '
                ' . ($checkSelect ? '$.checkSelect();' : '') . '
                 ' . ($checkIcon ? '$.checkIcon();' : '') . '
                 ' . ($fw_tags ? '$.fw_tags();' : '') . '
                 ' . ($checkCheckBox ? '$.checkCheckBox();' : '') . '
                 ' . ($dataTable ? '$.table(true);' : '') . '
                </script>';
        $this->setHtml(parent::__construct());
        $this->setSingularName($singularName);
        if (strlen($pluralName) == '') {
            $this->setPluralName($singularName . ' ها');
        } else {
            $this->setPluralName($pluralName);
        }
        if (strlen($parentUrl) == '') {
            $this->setParentUrl($parentUrl);
            echo hiddenInput($this->parentUrl, '', 'fw_parentUrl');
        }
        $this->configThis();
        echo hiddenInput($this->thisView, '', 'fw_lastAjaxCallView');
        if (isset($__REQUEST['controller_key'])) {
            $this->setKey(trim(str_replace('controller_key: ', '', $__REQUEST['controller_key'])));
            unset($__REQUEST['controller_key']);
        }
        $this->setData($this->dataCheck($__REQUEST));
        if (!isset($__REQUEST['controller'])) {
            $this->setControllerPath('controllers/' . str_replace('add', '', str_replace('edit', '', str_replace('delete', '', str_replace('view', '', $this->thisView)))));
        } else {
            $this->setControllerPath(strtok($__REQUEST['controller'], '?'));
        }
        echo hiddenInput($this->getPluralName(), '', 'fw_current_page_title');

    }

    public function breadcrumbs() {
        echo '<section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>مدیریت ' . $this->getPluralName() . '</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-left">
                                    <li class="breadcrumb-item"><a href="index.php">خانه</a></li>
                                    <li class="breadcrumb-item active">مدیریت ' . $this->getPluralName() . '</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>';
    }

    public function submit() {
        echo '<script>$.submit("' . $this->getControllerPath() . '")</script>';
    }

    public function refresh(bool $echo = true) {
        if ($echo) echo $this->topBtn($this->getThis(), 'تازه سازی'); else
            return $this->topBtn($this->getThis(), 'تازه سازی');
    }

    public function refreshAndBack() {
        $this->backBtn();
        $this->refresh();
    }

    public function currentDir() {
        $data = explode(DIRECTORY_SEPARATOR, $this->thisView);
        array_pop($data);
        return implode(DIRECTORY_SEPARATOR, $data) . DIRECTORY_SEPARATOR;
    }

    public function refreshAndAdd() {
        $this->refresh();
        $this->addBtn();
    }

    public function backBtn(bool $echo = true, string $path = '') {
        if ($echo) echo $this->topBtn((strlen($path) > 0 ? $path : $this->referrer()), 'بازگشت', 'fa fa-arrow-left', 'warning', true, 'fw_back_btn'); else
            return $this->topBtn((strlen($path) > 0 ? $path : $this->referrer()), 'بازگشت', 'fa fa-arrow-left', 'warning', true, 'fw_back_btn');
    }

    public function addBtn(bool $echo = true) {
        $link = explode('/', $this->thisView);
        $link[sizeof($link) - 1] = 'add' . end($link);
        $link = implode('/', $link);
        if ($echo) echo $this->topBtn($link, 'افزودن ' . $this->getSingularName(), 'fa fa-plus'); else
            return $this->topBtn($link, 'افزودن ' . $this->getSingularName(), 'fa fa-plus');
    }

    private function dataCheck(array $__REQUEST) {
        if (isset($__REQUEST['timeStampForAjaxRequest'])) {
            if (round($__REQUEST['timeStampForAjaxRequest']->toString() / 1000) > time() - 100 or round($__REQUEST['timeStampForAjaxRequest']->toString() / 1000) < time() + 100) {
                $this->configureReferrer($__REQUEST);
                return json_decode($__REQUEST['data'], false);
            }
            echo '<script>location.replace("index.php")</script>';
        }
        echo '<script>location.replace("index.php")</script>';
    }

    private function configThis() {
        $this->setThisView(explode('views/', $_SERVER['REQUEST_URI'])[1]);
    }


    /**
     * @return mixed
     */
    public function referrer() {
        return $this->referrer;
    }

    /**
     * @param mixed $referrer
     */

    private function setReferrer($referrer) {
        if ($referrer) {
            $this->referrer = $referrer;
        } else {
            $this->referrer = 'undefined.php';
        }
    }

    private function configureReferrer($__REQUEST) {
        if (is_array($__REQUEST)) {
            if (isset($__REQUEST['fw_referrer'])) {
                $this->setReferrer($__REQUEST['fw_referrer']);
                unset($__REQUEST['fw_referrer']);
            } else if ($json = is_json($__REQUEST, true, true)) {
                if (isset($__REQUEST['fw_referrer'])) {
                    $this->setReferrer($__REQUEST['fw_referrer']);
                    unset($__REQUEST['fw_referrer']);
                }
            }
        } else if (is_object($__REQUEST) and isset($__REQUEST->fw_referrer)) {
            $this->setReferrer($__REQUEST->fw_referrer);
            unset($__REQUEST->fw_referrer);
        } else if ($json = is_json($__REQUEST, true, false)) {
            if (isset($__REQUEST->fw_referrer)) {
                $this->setReferrer($__REQUEST->fw_referrer);
                unset($__REQUEST->fw_referrer);
            }
        }
        return $__REQUEST;
    }

    /**
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    private function setData($data) {
        if (is_object($data) and isset($data->fw_referrer)) {
            unset($data->fw_referrer);
        } else if (is_array($data) and isset($data['fw_referrer'])) {
            unset($data['fw_referrer']);
        } else if ($json = is_json($data, true, false)) {
            if (is_object($json) and isset($json->fw_referrer)) unset($json->fw_referrer);
            $data = json_encode($json);
        }
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getThis() {
        return $this->thisView;
    }

    /**
     * @param mixed $thisView
     */
    private function setThisView($thisView) {
        $this->thisView = $thisView;
    }

    /**
     * @return mixed
     */
    public function getSingularName() {
        return $this->singularName;
    }

    /**
     * @param mixed $singularName
     */
    public function setSingularName($singularName) {
        $this->singularName = $singularName;
    }

    /**
     * @return mixed
     */
    public function getPluralName() {
        return $this->pluralName;
    }

    /**
     * @param mixed $pluralName
     */
    public function setPluralName($pluralName) {
        $this->pluralName = $pluralName;
    }

    /**
     * @return mixed
     */
    public function getControllerPath() {
        return $this->controllerPath;
    }

    /**
     * @param mixed $controllerPath
     */
    public function setControllerPath($controllerPath) {
        $this->controllerPath = $controllerPath;
    }

    /**
     * @return Html
     */
    public function Html(): Html {
        return $this->Html;
    }

    /**
     * @param Html $Html
     */
    private function setHtml(Html $Html) {
        $this->Html = $Html;
    }


    /**
     */
    public function doFill() {
        $this->fill = true;
    }

    public function CardFooter() {
        $file = end(explode('/', str_replace(__SOURCE__, '', debug_backtrace()[0]['file'])));
        $res = '';
        if (strpos($file, 'delete') !== false) {
            $res = '<div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-danger pull-left"><i
                                    class="fa fa-trash"></i>
                            حذف ' . $this->getSingularName() . '
                        </button>
                    </div>';
        } elseif (strpos($file, 'edit') !== false) {
            $res = '<div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-success pull-left"><i
                                    class="fa fa-edit"></i>
                            ویرایش ' . $this->getSingularName() . '
                        </button>
                    </div>';
        } elseif (strpos($file, 'add') !== false) {
            $res = '<div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary pull-left"><i
                                    class="fa fa-plus"></i>
                            افزودن ' . $this->getSingularName() . '
                        </button>
                    </div>';
        }
        echo '</div>' . $res . '</form>';
    }

    public function CardTitle() {
        $file = end(explode('/', str_replace(__SOURCE__, '', debug_backtrace()[0]['file'])));
        if (strpos($file, 'delete') !== false) {
            echo '<h3 class="card-title"> حذف ' . $this->getSingularName() . '</h3>';

        } elseif (strpos($file, 'edit') !== false) {
            echo '<h3 class="card-title"> ویرایش ' . $this->getSingularName() . '</h3>';

        } elseif (strpos($file, 'add') !== false) {
            echo '<h3 class="card-title"> افزودن ' . $this->getSingularName() . '</h3>';

        }
    }

    public function FormStart(string $form_primary_key = 'default') {
        $file = end(explode('/', str_replace(__SOURCE__, '', debug_backtrace()[0]['file'])));
        $controller_type = '';
        if (strpos($file, 'delete') !== false) {
            $controller_type = 'delete';

        } elseif (strpos($file, 'edit') !== false) {
            $controller_type = 'edit';

        } elseif (strpos($file, 'add') !== false) {
            $controller_type = 'add';
        }
        if ($controller_type !== 'add') {
            $form_primary_key = $form_primary_key === 'default' ? $this->key : $form_primary_key;
        }
        echo '<form>' . csrf_field($this->thisView) . ($controller_type === 'add' ? '' : hiddenInput($this->getData()->$form_primary_key, (string)$form_primary_key)) . controllerType($controller_type) . '<div class="card-body d-flex flex-wrap table-responsive">';
    }

    /**
     * @return mixed
     */
    public function getKey() {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    private function setKey($key) {
        $this->key = $key;
    }

    public function editAndDelete($data) {
        return $this->editBtn($data) . $this->deleteBtn($data);
    }

    public function editBtn($data) {
        $exploded = explode(DIRECTORY_SEPARATOR, $this->thisView);
        $fileName = end($exploded);
        $edit = 'edit' . $fileName;
        $exploded[sizeof($exploded) - 1] = $edit;
        $edit = implode('/', $exploded);
        $url = $edit . (strpos($edit, '?') === false ? '?' : '&') . $this->getKey() . '=' . $data->{$this->getKey()};
        return $this->actionBtn($url, 'ویرایش', 'fa-edit', 'btn-outline-success');
    }

    public function actionBtn($rel, $name = '', $icon = 'fa-eye', $color = 'btn-info') {
        return '<a rel="' . $rel . '" class="btn ' . $color . ' m-1 ajax" data-toggle="tooltip" title="' . $name . '"><i
                                                class="fa ' . $icon . '"></i> </a>';
    }

    public function deleteBtn($data) {
        $exploded = explode(DIRECTORY_SEPARATOR, $this->thisView);
        $fileName = end($exploded);
        $delete = 'delete' . $fileName;
        $exploded[sizeof($exploded) - 1] = $delete;
        $delete = implode('/', $exploded);
        $url = $delete . (strpos($delete, '?') === false ? '?' : '&') . $this->getKey() . '=' . $data->{$this->getKey()};
        return $this->actionBtn($url, 'حذف', 'fa-trash', 'btn-outline-danger');
    }

    public function show(array $arrayOfIndexed, int $limit = -1, bool $showCount = true, bool $showEdit = true, bool $showDelete = true, string $lastTdOptions = '') {
        $result = '';
        if ($limit > -1) $i = 0;
        foreach ($this->getData() as $item) {
            if ($limit > -1) {
                $i++;
                if ($i > $limit) break;
            }
            $result .= '<tr>' . $showCount ? '<td width="50"></td>' : '';
            foreach ($arrayOfIndexed as $index => $value) {
                if (is_string($index) and is_string($value) and function_exists($index)) {
                    $result .= '<td dir="ltr">' . call_user_func_array($index, array($item->$value)) . '</td>';
                } else {
                    if (is_object($value)) {
                        $result .= '<td dir="ltr">' . join_class($value, $item->{$value::key}, $index) . '</td>';
                    } else {
                        $result .= '<td>' . $item->$value . '</td>';
                    }
                }
            }
            $result .= (($showDelete or $showEdit or $lastTdOptions != '') ? '<td>' . ($showEdit ? $this->editBtn($item) : '') . ($showDelete ? $this->deleteBtn($item) : '') . ($lastTdOptions != '' ? $lastTdOptions : '') . '</td>' : '') . '</tr>';
        }
        return $result;
    }

    /**
     * @return mixed
     */
    private function getParentUrl() {
        return $this->parentUrl;
    }

    /**
     * @param mixed $parentUrl
     */
    private function setParentUrl($parentUrl) {
        $this->parentUrl = $parentUrl;
    }
}
