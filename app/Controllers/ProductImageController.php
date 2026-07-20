<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\ProductImageService;

class ProductImageController extends Controller
{
    public function __construct(
        private ProductImageService $service
    ) {}

    // GET /productimages
    public function index(Request $request, Response $response): void
    {
        $productimages = $this->service->all();
        $this->view('productimages.index', compact('productimages'));
    }

    // GET /productimages/create
    public function create(Request $request, Response $response): void
    {
        $this->view('productimages.create');
    }

    // POST /productimages
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('productimages.index');
    }

    // GET /productimages/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('productimages.show', compact('record'));
    }

    // GET /productimages/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('productimages.edit', compact('record'));
    }

    // PUT /productimages/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('productimages.index');
    }

    // DELETE /productimages/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('productimages.index');
    }
}