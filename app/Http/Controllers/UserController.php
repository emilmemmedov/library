<?php

namespace App\Http\Controllers;

use App\Models\LibrarianShift;
use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    use ApiResponder;

    /**
     * @throws BindingResolutionException
     * @throws ValidationException
     */
    public function create(Request $request): JsonResponse
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'type' => 'required|in,1,2,3',
            'shifts' => 'required_if:type,'.User::LIBRARIAN_TYPE,
            'shifts.*.day' => 'required|in:1,2,3,4,5,6,7',
        ]);

        $user = new User();
        $this->saveUser($user, $request);

        return $this->successResponse($user);
    }

    private function saveUser(User $user, Request $request): JsonResponse
    {
        DB::transaction(function () use ($user, $request) {
            $user->fill([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => app('hash')->make($request->get('password')),
                'type' => $request->get('type')
            ])->save();

            if ($request->get('type') == User::LIBRARIAN_TYPE){
                $this->saveLibrarianShifts($request->get('shifts'), $user->getKey());
            }
        });

        return $this->successResponse('messages.saved');
    }

    private function saveLibrarianShifts($shifts, $userId)
    {
        foreach ($shifts as $shift){
            LibrarianShift::query()->create([
                'day' => $shifts['day'],
                'librarian_id' => $userId
            ]);
        }
    }
}
