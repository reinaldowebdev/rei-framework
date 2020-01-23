<?php
namespace src\Controllers;

use src\Controller;

class LoginController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogout()
    {
        return $this->render('teste');
    }
}
