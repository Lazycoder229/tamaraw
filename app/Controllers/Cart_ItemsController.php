<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\Cart_ItemsService;

class Cart_ItemsController extends Controller
{
    public function __construct(
        private Cart_ItemsService $service
    ) {}

    // GET /cart_itemss
    public function index(Request $request, Response $response): void
    {
        $cart_itemss = $this->service->all();
        $this->view('cart_itemss.index', compact('cart_itemss'));
    }

    // GET /cart_itemss/create
    public function create(Request $request, Response $response): void
    {
        $this->view('cart_itemss.create');
    }

    // POST /cart_itemss
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('cart_itemss.index');
    }

    // GET /cart_itemss/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('cart_itemss.show', compact('record'));
    }

    // GET /cart_itemss/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('cart_itemss.edit', compact('record'));
    }

    // PUT /cart_itemss/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('cart_itemss.index');
    }

    // DELETE /cart_itemss/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('cart_itemss.index');
    }
}