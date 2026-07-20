<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\Password_ResetsService;

class Password_ResetsController extends Controller
{
    public function __construct(
        private Password_ResetsService $service
    ) {}

    // GET /password_resetss
    public function index(Request $request, Response $response): void
    {
        $password_resetss = $this->service->all();
        $this->view('password_resetss.index', compact('password_resetss'));
    }

    // GET /password_resetss/create
    public function create(Request $request, Response $response): void
    {
        $this->view('password_resetss.create');
    }

    // POST /password_resetss
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('password_resetss.index');
    }

    // GET /password_resetss/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('password_resetss.show', compact('record'));
    }

    // GET /password_resetss/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('password_resetss.edit', compact('record'));
    }

    // PUT /password_resetss/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('password_resetss.index');
    }

    // DELETE /password_resetss/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('password_resetss.index');
    }
}