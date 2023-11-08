<?php

namespace Rainte\Laravel\Models;

use Illuminate\Pagination\LengthAwarePaginator;

class Paginator extends LengthAwarePaginator
{
    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return [
            config('rainte.PAGE_NO_AT') => $this->currentPage(),
            config('rainte.PAGE_SIZE_AT') => $this->perPage(),
            'total' => $this->total(),
            'list' => $this->items->toArray(),
        ];
    }
}
