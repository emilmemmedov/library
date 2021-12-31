<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * Class CustomerResource
 * @package App\Http\Resources
 */
class LibrarianResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'completed_orders_count' => $this->getOrdersCount($this->getRelation('orders'), true),
            'non_completed_orders_count' => $this->getOrdersCount($this->getRelation('orders'), false)
        ];
    }

    private function getOrdersCount(Collection $orders, bool $completed): int
    {
        if ($completed){
            return $orders->whereNotNull('return_date')->count();
        }
        return $orders->whereNull('return_date')->count();}
}
