<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Core\Request;
use app\Core\Response;

class HomeController extends Controller
{
    public function index(Request $request, Response $response): string
    {
        $this->setLayout('main');
        return $this->renderWithLayout('home/index', [
            'title' => 'Welcome to PHP MVC Framework'
        ]);
    }

    public function about(Request $request, Response $response): string
    {
        $this->setLayout('main');
        return $this->renderWithLayout('home/about', [
            'title' => 'About Us'
        ]);
    }

    public function contact(Request $request, Response $response): string
    {
        $this->setLayout('main');
        return $this->renderWithLayout('home/contact', [
            'title' => 'Contact Us'
        ]);
    }

    public function contactPost(Request $request, Response $response): string
    {
        $body = $request->getBody();

        // Here you would typically send an email or save to database
        setFlash('success', 'Thank you for your message! We will get back to you soon.');

        return $response->redirect('/contact');
    }
}
