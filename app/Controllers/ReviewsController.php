<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\ReviewsService;

class ReviewsController extends Controller
{
    public function __construct(
        private ReviewsService $service
    ) {}

    // GET /reviewss
    public function index(Request $request, Response $response): void
    {
        $reviewss = $this->service->all();
        $this->view('reviewss.index', compact('reviewss'));
    }

    // GET /reviewss/create
    public function create(Request $request, Response $response): void
    {
        $this->view('reviewss.create');
    }

    // POST /reviewss
    public function store(Request $request, Response $response): void
    {
        $this->service->create($request->all());
        $this->redirectRoute('reviewss.index');
    }

    // GET /reviewss/{id}
    public function show(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('reviewss.show', compact('record'));
    }

    // GET /reviewss/{id}/edit
    public function edit(Request $request, Response $response, string $id): void
    {
        $record = $this->service->find($id);
        $this->view('reviewss.edit', compact('record'));
    }

    // PUT /reviewss/{id}
    public function update(Request $request, Response $response, string $id): void
    {
        $this->service->update($id, $request->all());
        $this->redirectRoute('reviewss.index');
    }

    // DELETE /reviewss/{id}
    public function destroy(Request $request, Response $response, string $id): void
    {
        $this->service->delete($id);
        $this->redirectRoute('reviewss.index');
    }
}