<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\PaymentsService;

class PaymentsController extends Controller
{
    public function __construct(
        private PaymentsService $service
    ) {}

    // GET /paymentss
    public function index(Request $request, Response $response): void
    {
        $paymentss = $this->service->all();
        $this->view('paymentss.index', compact('paymentss'));
    }

    // GET /paymentss/create
    public function create(Request $request, Response $response): void
    {
        $this->view('paymentss.create');
    }

    // POST /paymentss
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('paymentss.index');
    }

    // GET /paymentss/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('paymentss.show', compact('record'));
    }

    // GET /paymentss/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('paymentss.edit', compact('record'));
    }

    // PUT /paymentss/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('paymentss.index');
    }

    // DELETE /paymentss/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('paymentss.index');
    }
}