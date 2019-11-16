<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 11/16/19
 * Time: 3:16 PM
 */

namespace App\Controller\Web;


use App\Application\Request;
use App\Controller\Controller;

class HomeController extends Controller {

    public static function index(Request $request) {
        self::render('page/home.php', ["page" => "Haha"]);
    }
}
