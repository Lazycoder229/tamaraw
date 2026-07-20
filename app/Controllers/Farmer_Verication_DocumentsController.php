<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\Farmer_Verication_DocumentsService;

class Farmer_Verication_DocumentsController extends Controller
{
    public function __construct(
        private Farmer_Verication_DocumentsService $service
    ) {}

    // GET /farmer_verication_documentss
    public function index(Request $request, Response $response): void
    {
        $farmer_verication_documentss = $this->service->all();
        $this->view('farmer_verication_documentss.index', compact('farmer_verication_documentss'));
    }

    // GET /farmer_verication_documentss/create
    public function create(Request $request, Response $response): void
    {
        $this->view('farmer_verication_documentss.create');
    }

    // POST /farmer_verication_documentss
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('farmer_verication_documentss.index');
    }

    // GET /farmer_verication_documentss/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('farmer_verication_documentss.show', compact('record'));
    }

    // GET /farmer_verication_documentss/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('farmer_verication_documentss.edit', compact('record'));
    }

    // PUT /farmer_verication_documentss/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('farmer_verication_documentss.index');
    }

    // DELETE /farmer_verication_documentss/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('farmer_verication_documentss.index');
    }
}