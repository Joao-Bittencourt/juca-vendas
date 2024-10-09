<?php

namespace Tests\Unit\Models;

use App\Models\SaleItem;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class SaleItemTest extends TestCase
{
    public function test_sale_item_belongs_to_product(): void
    {
        $saleItem = new SaleItem();
        $this->assertInstanceOf(
            BelongsTo::class,
            $saleItem->product()
        );
    }

    public function test_sale_item_belongs_to_sale(): void
    {
        $saleItem = new SaleItem();
        $this->assertInstanceOf(
            BelongsTo::class,
            $saleItem->sale()
        );
    }
}
