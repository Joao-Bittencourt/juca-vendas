<?php

namespace Tests\Unit\Models;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class BrandTest extends TestCase
{
    public function test_brand_has_many_products()
    {
        $brand = new Brand();
        $this->assertInstanceOf(
            HasMany::class,
            $brand->product()
        );
    }

    public function test_brand_get_actions()
    {
        $brand = (new Brand())->factory()->create();
        $this->assertIsArray($brand->getActions());
    }
}
