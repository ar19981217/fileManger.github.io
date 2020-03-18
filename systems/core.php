<?php
session_start();
class Core
{
    private $arr = [];
    public function __construct()
    {
        $this->getPath();
//        $folder = $_SERVER['DOCUMENT_ROOT'] . '/' . $_POST['pathName'];
//        $arr = array();
//        array_push($arr, $folder);/
//        $_SESSION['s'] = $_SERVER['DOCUMENT_ROOT'] . '/' . $_POST['pathName'];
//        echo $_SESSION['s'];
    }

    private function getPath()
    {
        $folder = $_SERVER['DOCUMENT_ROOT']. '/' . $_POST['path'];
        $post = $_POST['path'];
        $this->arr['path'][] = $post;
        $this->retContent($folder);
//        echo $_SERVER['REQUEST_URI'];
        /*$arr = [];
        array_push($arr, $folder);
//        $this->dd($arr);
        return json_encode($arr);*/
//        $this->dd($_SERVER);
        echo json_encode($this->arr);
    }
    public function retContent($folder)
    {

        $handle = opendir($folder);
        $arrFormat = [
            'js',
            'html',
            'css',
            'txt',
            'php',

        ];
        $typeFileArray = array(
            'js' => 'icons8-javascript-240.png',
            'html' => 'iconfinder_HTML5_100117.png',
            'css' => 'icons8-css-filetype-96.png',
            'txt' => 'iconfinder_File_104851.png',
            'php' => 'php.png'
        );

        if ($handle) {
            while (false !== ($entry = readdir($handle))) {
                if ($_SERVER['DOCUMENT_ROOT'] . '/' == str_replace($folder, '..', '').'/') {
                    if ($entry != '.' && $entry != '..') {
                        if (is_dir($folder . '/' . $entry)) {
                            $this->arr['main']['dir'][] = "<li><img class='type' src='../img/folder/iconfinder_folder_299060.png' alt=''>$entry</li>";
                        } else {
                            foreach ($arrFormat as $key => $value) {
                                if (pathinfo($entry, PATHINFO_EXTENSION) == $value) {
                                    $this->arr['main']['file'][] = "<li class='file'><img class='type' src='../img/iconFile/" . $typeFileArray[$value] . "' alt=''>$entry</li>";
                                }
                            }
                        }
                    }
                } else {
                    if ($entry != '.') {
                        if ($entry == '..') {
                            $this->arr['main']['back'][] = "<li class='back'><img class='type' src='../img/return.png' alt=''>$entry</li>";
                        } else {
                            if (is_dir($folder . '/' . $entry)) {
                                $this->arr['main']['dir'][] = "<li><img class='type' src='../img/folder/iconfinder_folder_299060.png' alt=''>$entry</li>";
                            } else {
                                foreach ($arrFormat as $key => $value) {
                                    if (pathinfo($entry, PATHINFO_EXTENSION) == $value) {
                                        $this->arr['main']['file'][] = "<li class='file'><img class='type' src='../img/iconFile/" . $typeFileArray[$value] . "' alt=''>$entry</li>";
                                    }
                                }
                            }
                        }
                    }
                }
            }

            closedir($handle);
        }

    }
    public function dd($parm)
    {
        echo "<pre>";
        print_r($parm);
        echo "</pre>";
    }
}
$manager = new Core;