<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\ProductsService;

class ProductsController extends Controller
{
    public function __construct(
        private ProductsService $service
    ) {}

    // GET /productss
    public function index(Request $request, Response $response): void
    {
        $productss = $this->service->all();
        $this->view('productss.index', compact('productss'));
    }

    // GET /productss/create
    public function create(Request $request, Response $response): void
    {
        $this->view('productss.create');
    }

    // POST /productss
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('productss.index');
    }

    // GET /productss/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('productss.show', compact('record'));
    }

    // GET /productss/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('productss.edit', compact('record'));
    }

    // PUT /productss/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('productss.index');
    }

    // DELETE /productss/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('productss.index');
    }
}