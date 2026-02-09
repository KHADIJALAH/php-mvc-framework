<?php

namespace app\Core;

class Controller
{
    public string $layout = 'main';
    public string $action = '';
    protected array $middlewares = [];

    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function render(string $view, array $params = []): string
    {
        return Application::$app->router->renderView($view, $params);
    }

    protected function registerMiddleware(Middleware $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    protected function renderWithLayout(string $view, array $params = []): string
    {
        $viewContent = $this->renderViewOnly($view, $params);
        return $this->renderLayout($viewContent, $params);
    }

    protected function renderLayout(string $viewContent, array $params = []): string
    {
        $params['content'] = $viewContent;

        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once BASE_PATH . "/app/Views/layouts/{$this->layout}.php";
        return ob_get_clean();
    }

    protected function renderViewOnly(string $view, array $params = []): string
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once BASE_PATH . "/app/Views/$view.php";
        return ob_get_clean();
    }
}
