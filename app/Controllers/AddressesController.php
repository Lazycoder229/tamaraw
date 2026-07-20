<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\AddressesService;

class AddressesController extends Controller
{
    public function __construct(
        private AddressesService $service
    ) {}

    // GET /addressess
    public function index(Request $request, Response $response): void
    {
        $addressess = $this->service->all();
        $this->view('addressess.index', compact('addressess'));
    }

    // GET /addressess/create
    public function create(Request $request, Response $response): void
    {
        $this->view('addressess.create');
    }

    // POST /addressess
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('addressess.index');
    }

    // GET /addressess/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('addressess.show', compact('record'));
    }

    // GET /addressess/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('addressess.edit', compact('record'));
    }

    // PUT /addressess/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('addressess.index');
    }

    // DELETE /addressess/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('addressess.index');
    }
}