<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\Inventory_LogsService;

class Inventory_LogsController extends Controller
{
    public function __construct(
        private Inventory_LogsService $service
    ) {}

    // GET /inventory_logss
    public function index(Request $request, Response $response): void
    {
        $inventory_logss = $this->service->all();
        $this->view('inventory_logss.index', compact('inventory_logss'));
    }

    // GET /inventory_logss/create
    public function create(Request $request, Response $response): void
    {
        $this->view('inventory_logss.create');
    }

    // POST /inventory_logss
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('inventory_logss.index');
    }

    // GET /inventory_logss/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('inventory_logss.show', compact('record'));
    }

    // GET /inventory_logss/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('inventory_logss.edit', compact('record'));
    }

    // PUT /inventory_logss/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('inventory_logss.index');
    }

    // DELETE /inventory_logss/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('inventory_logss.index');
    }
}