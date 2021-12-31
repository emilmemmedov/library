<?php

namespace App\Http\Controllers;

use App\Http\Resources\LibrarianResource;
use App\Models\Librarian;
use App\Models\LibrarianShift;
use App\Traits\ApiResponder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LibrarianController extends Controller
{
    use ApiResponder;

    /**
     * @throws ValidationException
     * @throws AuthorizationException
     */
    public function statistic(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->authorize('get-librarian');

        $this->validate($request, [
            'date_from' => 'required',
            'date_to' => 'required'
        ]);

        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $shifts = LibrarianShift::query()->where('librarian_id', Auth::user()->id)->pluck('day');

        $librarians = Librarian::query()
            ->with([
                'orders' => function($query) use ($dateFrom, $dateTo) {
                    $query->where(function ($query) use ($dateTo, $dateFrom) {
                        $query
                            ->where('created_at', '>=', $dateFrom)
                            ->where('created_at', '<=', $dateTo);
                    });
                    $query->with([
                       'book',
                       'reader'
                    ]);
                }
            ])
            ->paginate($request->get('per_page') ?? config('defaults.per_page'));

        $resource = LibrarianResource::collection($librarians);
        return $this->successResponse($resource->response()->getData());
    }
}
