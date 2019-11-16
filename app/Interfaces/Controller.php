<?php

namespace App\Interfaces;

abstract class Controller {

    const viewFileRootFolder = ROOT_DIR . '/resource/view/';
    const masterFile = 'layout/master.php';

    public static function render($filePath, $data = array()) {
        ob_start();
        $absoludePath = self::viewFileRootFolder . $filePath;
        if (is_file($absoludePath)) {
            extract($data);

            require_once(self::viewFileRootFolder . $filePath);

            $_CONTENT = ob_get_clean(); // inject content to master file

            require_once(self::viewFileRootFolder . self::masterFile);
            die();
        } else throw new \Exception("File " . $absoludePath . " not exist");
    }
}
