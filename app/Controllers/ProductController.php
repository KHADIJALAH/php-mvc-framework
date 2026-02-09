<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Core\Request;
use app\Core\Response;
use app\Core\Application;
use app\Models\Product;
use app\Middleware\AuthMiddleware;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function index(Request $request, Response $response): string
    {
        $this->setLayout('app');
        $products = Product::findByUser(Application::$app->user->id);
        return $this->renderWithLayout('products/index', [
            'title' => 'Products & Services', 'products' => $products, 'activePage' => 'products',
        ]);
    }

    public function create(Request $request, Response $response): string
    {
        $this->setLayout('app');
        return $this->renderWithLayout('products/create', ['title' => 'Add Product/Service', 'activePage' => 'products']);
    }

    public function store(Request $request, Response $response): void
    {
        $product = new Product();
        $product->loadData($request->getBody());
        $product->user_id = Application::$app->user->id;
        if ($product->validate() && $product->save()) {
            Application::$app->session->setFlash('success', 'Product added!');
            $response->redirect('/products');
        } else {
            Application::$app->session->setFlash('error', 'Failed to add product.');
            $response->redirect('/products/create');
        }
    }

    public function edit(Request $request, Response $response): string
    {
        $this->setLayout('app');
        $id = (int)$request->getRouteParam('id');
        $stmt = Application::$app->db->prepare("SELECT * FROM products WHERE id = :id AND user_id = :uid");
        $stmt->execute(['id' => $id, 'uid' => Application::$app->user->id]);
        $product = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$product) { $response->redirect('/products'); return ''; }
        return $this->renderWithLayout('products/edit', ['title' => 'Edit Product', 'product' => $product, 'activePage' => 'products']);
    }

    public function update(Request $request, Response $response): void
    {
        $id = (int)$request->getRouteParam('id');
        $product = new Product();
        $product->loadData($request->getBody());
        $product->id = $id;
        $product->user_id = Application::$app->user->id;
        $product->update();
        Application::$app->session->setFlash('success', 'Product updated!');
        $response->redirect('/products');
    }

    public function delete(Request $request, Response $response): void
    {
        $id = (int)$request->getRouteParam('id');
        Application::$app->db->prepare("DELETE FROM products WHERE id = :id AND user_id = :uid")
            ->execute(['id' => $id, 'uid' => Application::$app->user->id]);
        Application::$app->session->setFlash('success', 'Product deleted.');
        $response->redirect('/products');
    }
}
