<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\Order_Status_LogsService;

class Order_Status_LogsController extends Controller
{
    public function __construct(
        private Order_Status_LogsService $service
    ) {}

    // GET /order_status_logss
    public function index(Request $request, Response $response): void
    {
        $order_status_logss = $this->service->all();
        $this->view('order_status_logss.index', compact('order_status_logss'));
    }

    // GET /order_status_logss/create
    public function create(Request $request, Response $response): void
    {
        $this->view('order_status_logss.create');
    }

    // POST /order_status_logss
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('order_status_logss.index');
    }

    // GET /order_status_logss/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('order_status_logss.show', compact('record'));
    }

    // GET /order_status_logss/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('order_status_logss.edit', compact('record'));
    }

    // PUT /order_status_logss/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('order_status_logss.index');
    }

    // DELETE /order_status_logss/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('order_status_logss.index');
    }
}