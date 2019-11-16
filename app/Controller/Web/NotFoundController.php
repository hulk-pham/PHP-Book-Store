<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 11/16/19
 * Time: 5:10 PM
 */

namespace App\Controller\Web;

use App\Controller\Controller;

class NotFoundController extends Controller {

    public static function index($request) {
        self::render('page/404.php');
    }
}
