<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\OrdersService;

class OrdersController extends Controller
{
    public function __construct(
        private OrdersService $service
    ) {}

    // GET /orderss
    public function index(Request $request, Response $response): void
    {
        $orderss = $this->service->all();
        $this->view('orderss.index', compact('orderss'));
    }

    // GET /orderss/create
    public function create(Request $request, Response $response): void
    {
        $this->view('orderss.create');
    }

    // POST /orderss
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('orderss.index');
    }

    // GET /orderss/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('orderss.show', compact('record'));
    }

    // GET /orderss/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('orderss.edit', compact('record'));
    }

    // PUT /orderss/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('orderss.index');
    }

    // DELETE /orderss/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('orderss.index');
    }
}