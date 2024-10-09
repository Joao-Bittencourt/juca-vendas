<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;

    public function getActions(): array
    {
        $actions = [
            [
                'title' => __('Edit'),
                'class' => 'btn-warning',
                'route' => route('roles.edit', ['role' => $this->id]),
                'icon' => 'fas fa-pencil-alt',
            ],
            [
                'title' => __('Edit Permissions'),
                'class' => 'btn-info',
                'route' => route('roles.add_permission_to_role', ['roleId' => $this->id]),
                'icon' => 'fas fa-user-shield',
            ],
        ];

        return $actions;
    }
}
