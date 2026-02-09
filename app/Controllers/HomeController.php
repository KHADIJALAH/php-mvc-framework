<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Core\Request;
use app\Core\Response;
use app\Core\Application;

class HomeController extends Controller
{
    public function index(Request $request, Response $response): string
    {
        if (!Application::isGuest()) {
            $response->redirect('/dashboard');
            return '';
        }
        $response->redirect('/login');
        return '';
    }
}
