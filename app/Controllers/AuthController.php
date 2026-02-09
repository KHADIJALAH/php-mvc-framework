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
        $this->registerMiddleware(new AuthMiddleware(['profile', 'settings']));
    }

    public function login(Request $request, Response $response): string
    {
        if (!Application::isGuest()) {
            return $response->redirect('/dashboard');
        }
        $this->setLayout('auth');
        return $this->renderWithLayout('auth/login', ['title' => 'Login']);
    }

    public function loginPost(Request $request, Response $response)
    {
        $body = $request->getBody();
        $user = User::findOne(['email' => $body['email'] ?? '']);
        if (!$user || !password_verify($body['password'] ?? '', $user->password)) {
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
        return $this->renderWithLayout('auth/register', ['title' => 'Register']);
    }

    public function registerPost(Request $request, Response $response)
    {
        $user = new User();
        $body = $request->getBody();
        $user->loadData($body);
        if ($body['password'] !== ($body['password_confirm'] ?? '')) {
            setFlash('error', 'Passwords do not match');
            return $response->redirect('/register');
        }
        $existingUser = User::findOne(['email' => $user->email]);
        if ($existingUser) {
            setFlash('error', 'Email already exists');
            return $response->redirect('/register');
        }
        if ($user->validate() && $user->save()) {
            Application::$app->login($user);
            setFlash('success', 'Welcome to InvoiceFlow!');
            return $response->redirect('/dashboard');
        }
        $errors = array_map(fn($e) => $e[0], $user->errors);
        setFlash('error', implode(', ', $errors));
        return $response->redirect('/register');
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        setFlash('success', 'You have been logged out');
        return $response->redirect('/login');
    }

    public function profile(Request $request, Response $response): string
    {
        $this->setLayout('app');
        return $this->renderWithLayout('auth/profile', [
            'title' => 'My Profile', 'user' => Application::$app->user, 'activePage' => 'settings',
        ]);
    }

    public function settings(Request $request, Response $response): string
    {
        $this->setLayout('app');
        return $this->renderWithLayout('settings/index', [
            'title' => 'Settings', 'user' => Application::$app->user, 'activePage' => 'settings',
        ]);
    }

    public function profileUpdate(Request $request, Response $response): void
    {
        $user = Application::$app->user;
        $body = $request->getBody();
        if (!empty($body['name'])) {
            Application::$app->db->prepare("UPDATE users SET name = :name WHERE id = :id")
                ->execute(['name' => $body['name'], 'id' => $user->id]);
        }
        Application::$app->session->setFlash('success', 'Profile updated!');
        $response->redirect('/profile');
    }

    public function settingsUpdate(Request $request, Response $response): void
    {
        $user = Application::$app->user;
        $body = $request->getBody();
        if (!empty($body['name'])) {
            Application::$app->db->prepare("UPDATE users SET name = :name WHERE id = :id")
                ->execute(['name' => $body['name'], 'id' => $user->id]);
        }
        Application::$app->session->setFlash('success', 'Settings saved!');
        $response->redirect('/settings');
    }
}
