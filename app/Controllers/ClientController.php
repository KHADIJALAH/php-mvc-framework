<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Core\Request;
use app\Core\Response;
use app\Core\Application;
use app\Models\Client;
use app\Models\Invoice;
use app\Middleware\AuthMiddleware;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function index(Request $request, Response $response): string
    {
        $this->setLayout('app');
        $clients = Client::findByUser(Application::$app->user->id);
        return $this->renderWithLayout('clients/index', [
            'title' => 'Clients', 'clients' => $clients, 'activePage' => 'clients',
        ]);
    }

    public function create(Request $request, Response $response): string
    {
        $this->setLayout('app');
        return $this->renderWithLayout('clients/create', ['title' => 'Add Client', 'activePage' => 'clients']);
    }

    public function store(Request $request, Response $response): void
    {
        $client = new Client();
        $client->loadData($request->getBody());
        $client->user_id = Application::$app->user->id;
        if ($client->validate() && $client->save()) {
            Application::$app->session->setFlash('success', 'Client added!');
            $response->redirect('/clients');
        } else {
            Application::$app->session->setFlash('error', 'Name is required.');
            $response->redirect('/clients/create');
        }
    }

    public function show(Request $request, Response $response): string
    {
        $this->setLayout('app');
        $id = (int)$request->getRouteParam('id');
        $uid = Application::$app->user->id;
        $stmt = Application::$app->db->prepare("SELECT * FROM clients WHERE id = :id AND user_id = :uid");
        $stmt->execute(['id' => $id, 'uid' => $uid]);
        $client = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$client) { Application::$app->session->setFlash('error', 'Client not found.'); $response->redirect('/clients'); return ''; }
        $invoices = Invoice::findByUser($uid);
        $clientInvoices = array_values(array_filter($invoices, fn($inv) => (int)$inv['client_id'] === $id));
        return $this->renderWithLayout('clients/show', [
            'title' => $client['name'], 'client' => $client, 'invoices' => $clientInvoices, 'activePage' => 'clients',
        ]);
    }

    public function edit(Request $request, Response $response): string
    {
        $this->setLayout('app');
        $id = (int)$request->getRouteParam('id');
        $stmt = Application::$app->db->prepare("SELECT * FROM clients WHERE id = :id AND user_id = :uid");
        $stmt->execute(['id' => $id, 'uid' => Application::$app->user->id]);
        $client = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$client) { $response->redirect('/clients'); return ''; }
        return $this->renderWithLayout('clients/edit', ['title' => 'Edit Client', 'client' => $client, 'activePage' => 'clients']);
    }

    public function update(Request $request, Response $response): void
    {
        $id = (int)$request->getRouteParam('id');
        $client = new Client();
        $client->loadData($request->getBody());
        $client->id = $id;
        $client->user_id = Application::$app->user->id;
        $client->update();
        Application::$app->session->setFlash('success', 'Client updated!');
        $response->redirect('/clients/' . $id);
    }

    public function delete(Request $request, Response $response): void
    {
        $id = (int)$request->getRouteParam('id');
        Application::$app->db->prepare("DELETE FROM clients WHERE id = :id AND user_id = :uid")
            ->execute(['id' => $id, 'uid' => Application::$app->user->id]);
        Application::$app->session->setFlash('success', 'Client deleted.');
        $response->redirect('/clients');
    }
}
