<?php

namespace app\Core;

class Application
{
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public ?Controller $controller = null;
    public Database $db;
    public Session $session;
    public ?User $user = null;

    public function __construct(array $config)
    {
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();

        // Initialize database if configured
        if (isset($config['db'])) {
            $this->db = new Database($config['db']);
        }

        // Load user from session
        $userId = $this->session->get('user_id');
        if ($userId) {
            $this->user = User::findById($userId);
        }
    }

    public function run(): void
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode() ?: 500);
            echo $this->router->renderView('errors/error', [
                'exception' => $e,
                'code' => $e->getCode() ?: 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function login(User $user): bool
    {
        $this->user = $user;
        $this->session->set('user_id', $user->id);
        return true;
    }

    public function logout(): void
    {
        $this->user = null;
        $this->session->remove('user_id');
    }

    public static function isGuest(): bool
    {
        return !self::$app->user;
    }
}
