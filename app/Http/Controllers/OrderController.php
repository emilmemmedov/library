<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Traits\ApiResponder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Mockery\Exception;

class OrderController extends Controller
{
    use ApiResponder;

    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @throws ValidationException|AuthorizationException
     */
    public function create(Request $request): JsonResponse
    {
        $this->authorize('get-reader');
        $this->validate($request,[
            'reader_id' => 'required',
            'librarian_id' => 'required',
            'book_id' => 'required',
            'borrow_limit' => 'required',
            'price' => 'required',
            'borrow_date' => 'required'
        ]);

        try {
            $this->orderService->makeOrder($request);
            return $this->successResponse($this->orderService->getOrder());
        }
        catch (Exception $exception){
            return $this->errorResponse($exception->getMessage());
        }
    }
}
