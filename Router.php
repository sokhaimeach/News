<?php
class Router {
    private array $routes = [];

    public function add(string $path, Closure $handler): void {
        $this->routes[$this->normalizeRoute($path)] = $handler;
    }

    public function dispatch(string $path): void {
        $path = $this->normalizeRoute($path);

        foreach ($this->routes as $route => $handler) {
            $pattern = preg_replace('#\{\w+\}#', '([^\/]+)', $route);

            if (preg_match("#^$pattern$#", $path, $matches)) {
                array_shift($matches);

                if (!empty($matches)) {
                    call_user_func_array($handler, $matches);
                } else {
                    call_user_func($handler);
                }

                return;
            }
        }

        echo 'Page not found!';
    }

    private function normalizeRoute(string $path): string {
        $path = parse_url($path, PHP_URL_PATH) ?: '/';
        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

        if ($base !== '' && str_starts_with($path, $base)) {
            $path = substr($path, strlen($base));
        }

        $path = '/' . trim($path, '/');
        return $path === '' ? '/' : rtrim($path, '/');
    }
}
?>