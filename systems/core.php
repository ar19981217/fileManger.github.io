<?php
echo $_SERVER['HTTP_HOST']. '/' . $_POST['pathName'];
if ($_POST['status'] == 'back'){
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/' . $_POST['pathName'];
}else{
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/' . $_POST['pathName'];
}

$handle = opendir($folder);
$arr = [
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
    echo "<ul class='folder-list'>";
    while (false !== ($entry = readdir($handle))) {
        if ($_SERVER['DOCUMENT_ROOT'] . '/' == $folder) {
            if ($entry != '.' && $entry != '..') {
                if (is_dir($folder . '/' . $entry)) {
                    echo "<li><img class='type' src='../img/folder/iconfinder_folder_299060.png' alt=''>$entry</li>";
                } else {
                    foreach ($arr as $key => $value) {
                        if (pathinfo($entry, PATHINFO_EXTENSION) == $value) {
                            echo "<li class='file'><img class='type' src='../img/iconFile/" . $typeFileArray[$value] . "' alt=''>$entry</li>";
                        }
                    }
                }
            }
        } else {
            if ($entry != '..') {
                if ($entry == '.') {
                    echo "<li class='back'><img class='type' src='../img/return.png' alt=''>$entry</li>";
                } else {
                    if (is_dir($folder . '/' . $entry)) {
                        echo "<li><img class='type' src='../img/folder/iconfinder_folder_299060.png' alt=''>$entry</li>";
                    } else {
                        foreach ($arr as $key => $value) {
                            if (pathinfo($entry, PATHINFO_EXTENSION) == $value) {
                                echo "<li class='file'><img class='type' src='../img/iconFile/" . $typeFileArray[$value] . "' alt=''>$entry</li>";
                            }
                        }
                    }
                }
            }
        }
    }

    echo '</ul>';
    closedir($handle);
    $arr = [$_SERVER['DOCUMENT_ROOT']];
}
