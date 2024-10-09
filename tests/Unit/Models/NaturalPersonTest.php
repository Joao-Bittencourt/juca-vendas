<?php

namespace Tests\Unit\Models;

use App\Models\NaturalPerson;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class NaturalPersonTest extends TestCase
{
    public function test_natural_person_belongs_to_customer(): void
    {
        $naturalPerson = new NaturalPerson();
        $this->assertInstanceOf(
            BelongsTo::class,
            $naturalPerson->customer()
        );
    }

    public function test_natural_person_get_actions(): void
    {
        $naturalPerson = (new NaturalPerson())->factory()->create();
        $this->assertIsArray($naturalPerson->getActions());
    }
}
