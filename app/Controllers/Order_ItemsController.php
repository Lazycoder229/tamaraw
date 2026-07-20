<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\Order_ItemsService;

class Order_ItemsController extends Controller
{
    public function __construct(
        private Order_ItemsService $service
    ) {}

    // GET /order_itemss
    public function index(Request $request, Response $response): void
    {
        $order_itemss = $this->service->all();
        $this->view('order_itemss.index', compact('order_itemss'));
    }

    // GET /order_itemss/create
    public function create(Request $request, Response $response): void
    {
        $this->view('order_itemss.create');
    }

    // POST /order_itemss
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('order_itemss.index');
    }

    // GET /order_itemss/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('order_itemss.show', compact('record'));
    }

    // GET /order_itemss/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('order_itemss.edit', compact('record'));
    }

    // PUT /order_itemss/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('order_itemss.index');
    }

    // DELETE /order_itemss/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('order_itemss.index');
    }
}