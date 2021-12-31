<?php

namespace App\Http\Controllers;

use App\Models\Reader;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    use ApiResponder;

    public function index(Request $request): JsonResponse
    {
        $this->authorize('get-reader');

        $readers = Reader::query()
            ->with([
                'completedOrders.book.author',
                'nonCompletedOrders.book.author'
            ])
            ->paginate($request->get('per_page') ?? config('defaults.per_page'));

        return $this->successResponse($readers);
    }

    public function show($id): JsonResponse
    {
        $readers = Reader::query()
            ->with([
                'completedOrders.book.author',
                'nonCompletedOrders.book.author'
            ])
            ->findOrFail($id);

        return $this->successResponse($readers);
    }
}
