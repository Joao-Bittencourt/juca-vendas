<?php

namespace Tests\Unit\Models;

use App\Models\JuridicalPerson;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class JuridicalPersonTest extends TestCase
{
    public function test_juridical_person_belongs_to_customer(): void
    {
        $juridicalPerson = new JuridicalPerson();
        $this->assertInstanceOf(
            BelongsTo::class,
            $juridicalPerson->customer()
        );
    }

    public function test_juridical_person_get_actions(): void
    {
        $juridicalPerson = (new JuridicalPerson())->factory()->create();
        $this->assertIsArray($juridicalPerson->getActions());
    }
}
