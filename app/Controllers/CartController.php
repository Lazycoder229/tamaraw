<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\CartService;

class CartController extends Controller
{
    public function __construct(
        private CartService $service
    ) {}

    // GET /carts
    public function index(Request $request, Response $response): void
    {
        $carts = $this->service->all();
        $this->view('carts.index', compact('carts'));
    }

    // GET /carts/create
    public function create(Request $request, Response $response): void
    {
        $this->view('carts.create');
    }

    // POST /carts
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('carts.index');
    }

    // GET /carts/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('carts.show', compact('record'));
    }

    // GET /carts/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('carts.edit', compact('record'));
    }

    // PUT /carts/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('carts.index');
    }

    // DELETE /carts/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('carts.index');
    }
}