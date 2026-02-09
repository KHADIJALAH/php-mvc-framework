<?php

namespace app\Controllers;

use app\Core\Application;
use app\Core\Controller;
use app\Core\Request;
use app\Core\Response;
use app\Core\User;
use app\Middleware\AuthMiddleware;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response): string
    {
        if (!Application::isGuest()) {
            return $response->redirect('/dashboard');
        }

        $this->setLayout('auth');
        return $this->renderWithLayout('auth/login', [
            'title' => 'Login'
        ]);
    }

    public function loginPost(Request $request, Response $response)
    {
        $body = $request->getBody();
        $email = $body['email'] ?? '';
        $password = $body['password'] ?? '';

        $user = User::findOne(['email' => $email]);

        if (!$user || !password_verify($password, $user->password)) {
            setFlash('error', 'Invalid email or password');
            return $response->redirect('/login');
        }

        Application::$app->login($user);
        setFlash('success', 'Welcome back, ' . $user->name . '!');

        return $response->redirect('/dashboard');
    }

    public function register(Request $request, Response $response): string
    {
        if (!Application::isGuest()) {
            return $response->redirect('/dashboard');
        }

        $this->setLayout('auth');
        return $this->renderWithLayout('auth/register', [
            'title' => 'Register'
        ]);
    }

    public function registerPost(Request $request, Response $response)
    {
        $user = new User();
        $body = $request->getBody();

        $user->loadData($body);

        // Check if passwords match
        if ($body['password'] !== ($body['password_confirm'] ?? '')) {
            setFlash('error', 'Passwords do not match');
            return $response->redirect('/register');
        }

        // Check if email exists
        $existingUser = User::findOne(['email' => $user->email]);
        if ($existingUser) {
            setFlash('error', 'Email already exists');
            return $response->redirect('/register');
        }

        if ($user->validate() && $user->save()) {
            setFlash('success', 'Registration successful! Please login.');
            return $response->redirect('/login');
        }

        $errors = array_map(fn($e) => $e[0], $user->errors);
        setFlash('error', implode(', ', $errors));

        return $response->redirect('/register');
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        setFlash('success', 'You have been logged out');
        return $response->redirect('/');
    }

    public function profile(Request $request, Response $response): string
    {
        $this->setLayout('main');
        return $this->renderWithLayout('auth/profile', [
            'title' => 'My Profile',
            'user' => Application::$app->user
        ]);
    }
}
