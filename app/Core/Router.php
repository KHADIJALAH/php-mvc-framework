<?php

namespace app\Core;

class Router
{
    protected array $routes = [];
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, $callback): self
    {
        $this->routes['get'][$path] = $callback;
        return $this;
    }

    public function post(string $path, $callback): self
    {
        $this->routes['post'][$path] = $callback;
        return $this;
    }

    public function put(string $path, $callback): self
    {
        $this->routes['put'][$path] = $callback;
        return $this;
    }

    public function delete(string $path, $callback): self
    {
        $this->routes['delete'][$path] = $callback;
        return $this;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        // Check for dynamic routes
        if ($callback === false) {
            foreach ($this->routes[$method] ?? [] as $route => $handler) {
                $pattern = $this->convertRouteToRegex($route);
                if (preg_match($pattern, $path, $matches)) {
                    array_shift($matches);
                    $callback = $handler;
                    $this->request->setRouteParams($matches);
                    break;
                }
            }
        }

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView('errors/404');
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];

            // Execute middlewares
            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }

            $callback[0] = $controller;
        }

        return call_user_func($callback, $this->request, $this->response);
    }

    protected function convertRouteToRegex(string $route): string
    {
        $route = preg_replace('/\{([a-zA-Z]+)\}/', '(?P<$1>[^/]+)', $route);
        return '#^' . $route . '$#';
    }

    public function renderView(string $view, array $params = []): string
    {
        return Application::$app->controller
            ? Application::$app->controller->render($view, $params)
            : $this->renderOnlyView($view, $params);
    }

    public function renderOnlyView(string $view, array $params = []): string
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once BASE_PATH . "/app/Views/$view.php";
        return ob_get_clean();
    }
}
