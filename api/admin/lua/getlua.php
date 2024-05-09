<?php
$printmessage = array();

$files = scandir(__DIR__ . '/../../../lua');

// Supprimer les entrées . et ..
$files = array_diff($files, array('.', '..'));

foreach ($files as $file) {
    if (is_dir(__DIR__ . '/../../../lua/' . $file)) {
        if (file_exists(__DIR__ . '/../../../lua/' . $file . '/config/version')) {
            $printmessage[$file] = file_get_contents(__DIR__ . '/../../../lua/' . $file . '/config/version');
        } else {
            $printmessage[$file] = '0.0.0';
        }
    }
}
return array('status_code' => 200, 'message' => '', 'data' => $printmessage);