<?php

namespace Tests\Unit\Models;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class SaleTest extends TestCase
{
    public function test_sale_belongs_to_customer(): void
    {
        $sale = new Sale();
        $this->assertInstanceOf(
            BelongsTo::class,
            $sale->customer()
        );
    }

    public function test_sale_belongs_to_salesman(): void
    {
        $sale = new Sale();
        $this->assertInstanceOf(
            BelongsTo::class,
            $sale->salesman()
        );
    }

    public function test_sale_has_many_sale_items(): void
    {
        $sale = new Sale();
        $this->assertInstanceOf(
            HasMany::class,
            $sale->saleItems()
        );
    }

    public function test_sale_get_actions(): void
    {
        $sale = (new Sale())->factory()->create();
        $this->assertIsArray($sale->getActions());
    }
}
