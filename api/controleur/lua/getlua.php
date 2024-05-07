<?php
$printmessage = array();

$files = scandir(__DIR__ . '/../../../lua');

// Supprimer les entrées . et ..
$files = array_diff($files, array('.', '..'));

foreach ($files as $file) {
    if (is_dir(__DIR__ . '/../../../lua/' . $file)) {
        $printmessage[] = $file;
    }
}
return array('status_code' => 200, 'message' => '', 'data' => $printmessage);