<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\Ai_Chat_SessionsService;

class Ai_Chat_SessionsController extends Controller
{
    public function __construct(
        private Ai_Chat_SessionsService $service
    ) {}

    // GET /ai_chat_sessionss
    public function index(Request $request, Response $response): void
    {
        $ai_chat_sessionss = $this->service->all();
        $this->view('ai_chat_sessionss.index', compact('ai_chat_sessionss'));
    }

    // GET /ai_chat_sessionss/create
    public function create(Request $request, Response $response): void
    {
        $this->view('ai_chat_sessionss.create');
    }

    // POST /ai_chat_sessionss
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('ai_chat_sessionss.index');
    }

    // GET /ai_chat_sessionss/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('ai_chat_sessionss.show', compact('record'));
    }

    // GET /ai_chat_sessionss/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('ai_chat_sessionss.edit', compact('record'));
    }

    // PUT /ai_chat_sessionss/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('ai_chat_sessionss.index');
    }

    // DELETE /ai_chat_sessionss/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('ai_chat_sessionss.index');
    }
}