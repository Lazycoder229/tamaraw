<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\CategoriesService;

class CategoriesController extends Controller
{
    public function __construct(
        private CategoriesService $service
    ) {}

    // GET /categoriess
    public function index(Request $request, Response $response): void
    {
        $categoriess = $this->service->all();
        $this->view('categoriess.index', compact('categoriess'));
    }

    // GET /categoriess/create
    public function create(Request $request, Response $response): void
    {
        $this->view('categoriess.create');
    }

    // POST /categoriess
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('categoriess.index');
    }

    // GET /categoriess/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('categoriess.show', compact('record'));
    }

    // GET /categoriess/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('categoriess.edit', compact('record'));
    }

    // PUT /categoriess/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('categoriess.index');
    }

    // DELETE /categoriess/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('categoriess.index');
    }
}