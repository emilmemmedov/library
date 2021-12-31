<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Traits\ApiResponder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    use ApiResponder;

    public function index(Request $request): JsonResponse
    {
        $books = Book::query()
            ->with('author')
            ->paginate($request->get('per_page') ?? config('defaults.per_page'));

        return $this->successResponse($books);
    }

    /**
     * @throws ValidationException|AuthorizationException
     */
    public function create(Request $request): JsonResponse
    {
        $this->authorize('get-author');

        $this->validate($request, [
            'name' => 'required',
            'author_id' => 'required|exists:users,id',
            'price' => 'required'
        ]);

        Book::query()->create([
            'author_id' =>  $request->get('author_id'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price')
        ]);
        return $this->successResponse('messages.saved');
    }

    public function show($id): JsonResponse
    {
        $book = Book::query()
            ->with('author')
            ->findOrFail($id);

        return $this->successResponse($book);
    }
}
