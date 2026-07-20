<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\Farmer_ProfilesService;

class Farmer_ProfilesController extends Controller
{
    public function __construct(
        private Farmer_ProfilesService $service
    ) {}

    // GET /farmer_profiless
    public function index(Request $request, Response $response): void
    {
        $farmer_profiless = $this->service->all();
        $this->view('farmer_profiless.index', compact('farmer_profiless'));
    }

    // GET /farmer_profiless/create
    public function create(Request $request, Response $response): void
    {
        $this->view('farmer_profiless.create');
    }

    // POST /farmer_profiless
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('farmer_profiless.index');
    }

    // GET /farmer_profiless/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('farmer_profiless.show', compact('record'));
    }

    // GET /farmer_profiless/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('farmer_profiless.edit', compact('record'));
    }

    // PUT /farmer_profiless/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('farmer_profiless.index');
    }

    // DELETE /farmer_profiless/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('farmer_profiless.index');
    }
}