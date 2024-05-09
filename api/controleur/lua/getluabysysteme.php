<?php
$printmessage = array();

function getLuaFiles($origin, $dir, &$listFiles) {
    $_files = scandir($origin . $dir);
    $listFiles[$dir] = array();
    foreach ($_files as $file) {
        if (is_dir($origin . $dir . $file)) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            getLuaFiles($origin, $dir . $file . '/', $listFiles);
        } else {
            $listFiles[$dir][] = $file;
            //$listFiles[$dir][$file] = hash('sha256', file_get_contents($origin . $dir . $file));
        }
    }
}
$listFiles = array();
if (!isset($_GET['systeme'])) {
    return array('status_code' => 400, 'message' => 'Bad Request');
}
if (!file_exists(__DIR__ . '/../../../lua/' . $_GET['systeme'])) {
    return array('status_code' => 404, 'message' => 'Not Found');
}
if (!is_dir(__DIR__ . '/../../../lua/' . $_GET['systeme'])) {
    return array('status_code' => 400, 'message' => 'Bad Request');
}
getLuaFiles(__DIR__ . '/../../../lua/' . $_GET['systeme'], "/", $listFiles);
return array('status_code' => 200, 'message' => '', 'data' => $listFiles);