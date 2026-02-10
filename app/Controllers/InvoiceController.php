<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Core\Request;
use app\Core\Response;
use app\Core\Application;
use app\Models\Invoice;
use app\Models\InvoiceItem;
use app\Models\Client;
use app\Models\Product;
use app\Middleware\AuthMiddleware;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function index(Request $request, Response $response): string
    {
        $this->setLayout('app');
        $userId = Application::$app->user->id;
        $status = $request->get('status');
        $invoices = Invoice::findByUser($userId, $status ?: null);
        return $this->renderWithLayout('invoices/index', [
            'title' => 'Invoices', 'invoices' => $invoices, 'currentStatus' => $status, 'activePage' => 'invoices',
        ]);
    }

    public function create(Request $request, Response $response): string
    {
        $this->setLayout('app');
        $userId = Application::$app->user->id;
        return $this->renderWithLayout('invoices/create', [
            'title' => 'New Invoice', 'clients' => Client::findByUser($userId),
            'products' => Product::findByUser($userId), 'invoiceNumber' => Invoice::generateNumber($userId),
            'activePage' => 'invoices',
        ]);
    }

    public function store(Request $request, Response $response): void
    {
        $userId = Application::$app->user->id;
        $body = $request->getBody();
        $invoice = new Invoice();
        $invoice->user_id = $userId;
        $invoice->client_id = (int)($body['client_id'] ?? 0);
        $invoice->invoice_number = $body['invoice_number'] ?? '';
        $invoice->status = $body['status'] ?? 'draft';
        $invoice->issue_date = $body['issue_date'] ?? date('Y-m-d');
        $invoice->due_date = $body['due_date'] ?? date('Y-m-d', strtotime('+30 days'));
        $invoice->tax_rate = (float)($body['tax_rate'] ?? 0);
        $invoice->notes = $body['notes'] ?? '';

        if ($invoice->validate() && $invoice->save()) {
            $invoice->id = (int)Application::$app->db->pdo->lastInsertId();
            $descriptions = is_array($body['item_description'] ?? null) ? $body['item_description'] : [];
            $quantities = is_array($body['item_quantity'] ?? null) ? $body['item_quantity'] : [];
            $prices = is_array($body['item_price'] ?? null) ? $body['item_price'] : [];
            $productIds = is_array($body['item_product_id'] ?? null) ? $body['item_product_id'] : [];
            for ($i = 0; $i < count($descriptions); $i++) {
                if (empty($descriptions[$i])) continue;
                $item = new InvoiceItem();
                $item->invoice_id = $invoice->id;
                $item->product_id = !empty($productIds[$i]) ? (int)$productIds[$i] : null;
                $item->description = $descriptions[$i];
                $item->quantity = (float)($quantities[$i] ?? 1);
                $item->unit_price = (float)($prices[$i] ?? 0);
                $item->total = $item->quantity * $item->unit_price;
                $item->save();
            }
            $invoice->recalculate();
            Application::$app->session->setFlash('success', 'Invoice created successfully!');
            $response->redirect('/invoices');
        } else {
            Application::$app->session->setFlash('error', 'Please fill all required fields.');
            $response->redirect('/invoices/create');
        }
    }

    public function show(Request $request, Response $response): string
    {
        $this->setLayout('app');
        $id = (int)$request->getRouteParam('id');
        $invoice = Invoice::findByIdWithDetails($id);
        if (!$invoice || (int)$invoice['user_id'] !== Application::$app->user->id) {
            Application::$app->session->setFlash('error', 'Invoice not found.');
            $response->redirect('/invoices');
            return '';
        }
        return $this->renderWithLayout('invoices/show', [
            'title' => 'Invoice ' . $invoice['invoice_number'], 'invoice' => $invoice, 'activePage' => 'invoices',
        ]);
    }

    public function edit(Request $request, Response $response): string
    {
        $this->setLayout('app');
        $id = (int)$request->getRouteParam('id');
        $userId = Application::$app->user->id;
        $invoice = Invoice::findByIdWithDetails($id);
        if (!$invoice || (int)$invoice['user_id'] !== $userId) {
            Application::$app->session->setFlash('error', 'Invoice not found.');
            $response->redirect('/invoices');
            return '';
        }
        return $this->renderWithLayout('invoices/edit', [
            'title' => 'Edit Invoice', 'invoice' => $invoice,
            'clients' => Client::findByUser($userId), 'products' => Product::findByUser($userId),
            'activePage' => 'invoices',
        ]);
    }

    public function update(Request $request, Response $response): void
    {
        $id = (int)$request->getRouteParam('id');
        $userId = Application::$app->user->id;
        $existing = Invoice::findByIdWithDetails($id);
        if (!$existing || (int)$existing['user_id'] !== $userId) {
            $response->redirect('/invoices');
            return;
        }
        $body = $request->getBody();
        $invoice = new Invoice();
        $invoice->id = $id;
        $invoice->user_id = $userId;
        $invoice->client_id = (int)($body['client_id'] ?? $existing['client_id']);
        $invoice->invoice_number = $body['invoice_number'] ?? $existing['invoice_number'];
        $invoice->status = $body['status'] ?? $existing['status'];
        $invoice->issue_date = $body['issue_date'] ?? $existing['issue_date'];
        $invoice->due_date = $body['due_date'] ?? $existing['due_date'];
        $invoice->tax_rate = (float)($body['tax_rate'] ?? $existing['tax_rate']);
        $invoice->notes = $body['notes'] ?? $existing['notes'];
        $invoice->subtotal = (float)$existing['subtotal'];
        $invoice->tax_amount = (float)$existing['tax_amount'];
        $invoice->total = (float)$existing['total'];
        $invoice->update();
        InvoiceItem::deleteByInvoice($id);
        $descriptions = is_array($body['item_description'] ?? null) ? $body['item_description'] : [];
        $quantities = is_array($body['item_quantity'] ?? null) ? $body['item_quantity'] : [];
        $prices = is_array($body['item_price'] ?? null) ? $body['item_price'] : [];
        $productIds = is_array($body['item_product_id'] ?? null) ? $body['item_product_id'] : [];
        for ($i = 0; $i < count($descriptions); $i++) {
            if (empty($descriptions[$i])) continue;
            $item = new InvoiceItem();
            $item->invoice_id = $id;
            $item->product_id = !empty($productIds[$i]) ? (int)$productIds[$i] : null;
            $item->description = $descriptions[$i];
            $item->quantity = (float)($quantities[$i] ?? 1);
            $item->unit_price = (float)($prices[$i] ?? 0);
            $item->total = $item->quantity * $item->unit_price;
            $item->save();
        }
        $invoice->recalculate();
        Application::$app->session->setFlash('success', 'Invoice updated!');
        $response->redirect('/invoices/' . $id);
    }

    public function delete(Request $request, Response $response): void
    {
        $id = (int)$request->getRouteParam('id');
        Application::$app->db->prepare("DELETE FROM invoices WHERE id = :id AND user_id = :uid")
            ->execute(['id' => $id, 'uid' => Application::$app->user->id]);
        Application::$app->session->setFlash('success', 'Invoice deleted.');
        $response->redirect('/invoices');
    }

    public function updateStatus(Request $request, Response $response): void
    {
        $id = (int)$request->getRouteParam('id');
        $status = $request->getBody()['status'] ?? '';
        if (in_array($status, ['draft', 'pending', 'paid', 'overdue'])) {
            Application::$app->db->prepare("UPDATE invoices SET status = :status WHERE id = :id AND user_id = :uid")
                ->execute(['status' => $status, 'id' => $id, 'uid' => Application::$app->user->id]);
            Application::$app->session->setFlash('success', 'Status updated to ' . ucfirst($status));
        }
        $response->redirect('/invoices/' . $id);
    }
}
