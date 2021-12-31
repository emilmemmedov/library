<?php
namespace App\Services;

use App\Exceptions\InvalidOrderException;
use App\Models\Order;
use App\Models\Reader;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderService
{
    /**
     * @var Builder|Model
     */
    private $order;

    public function makeOrder(Request $request)
    {
        if ($this->isOrderable()){
            $this->order = Order::query()->create([
                'reader_id' => Auth::user()->id,
                'librarian_id' => $request->get('librarian_id'),
                'book_id' => $request->get('book_id'),
                'borrow_limit' => $request->get('borrow_limit'),
                'price' => $request->get('price'),
                'borrow_date' => $request->get('borrow_date')
            ]);
        }
    }

    public function getOrder()
    {
        return $this->order;
    }

    private function isOrderable(): bool
    {
        $user = Reader::query()
            ->with([
                'completedOrders',
                'nonCompletedOrders'
            ])
            ->findOrFail(Auth::user()->id);

        if ($user->getRelation('nonCompletedOrders')){
            if ($this->notCompleted($user->getRelation('nonCompletedOrders')))
            throw new InvalidOrderException('you have order already');
        }

        if ($user->getRelation('completedOrders')){
            if ($this->isDelayed($user->getRelation('completedOrders'))){
                throw new InvalidOrderException('you have delayed order. we can not give you book');
            }
        }
        return true;
    }

    private function isDelayed($completedOrders): bool
    {
        foreach ($completedOrders as $order){
            $borrow_limit = $order['borrow_limit'];
            if (Carbon::make($order['borrow_date'])->addHours($borrow_limit) < $order['return_date']){
                return true;
            }
        }
        return false;
    }

    private function notCompleted($notCompletedOrders): int
    {
        return count($notCompletedOrders);
    }
}
