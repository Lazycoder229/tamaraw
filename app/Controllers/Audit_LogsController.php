<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\Audit_LogsService;

class Audit_LogsController extends Controller
{
    public function __construct(
        private Audit_LogsService $service
    ) {}

    // GET /audit_logss
    public function index(Request $request, Response $response): void
    {
        $audit_logss = $this->service->all();
        $this->view('audit_logss.index', compact('audit_logss'));
    }

    // GET /audit_logss/create
    public function create(Request $request, Response $response): void
    {
        $this->view('audit_logss.create');
    }

    // POST /audit_logss
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('audit_logss.index');
    }

    // GET /audit_logss/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('audit_logss.show', compact('record'));
    }

    // GET /audit_logss/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('audit_logss.edit', compact('record'));
    }

    // PUT /audit_logss/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('audit_logss.index');
    }

    // DELETE /audit_logss/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('audit_logss.index');
    }
}