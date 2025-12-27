<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('brands')->insert($this->brands());
        DB::table('payment_methods')->insert($this->paymentMethods());
        DB::table('customers')->insert($this->customers());

        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
    }

    private function brands(): array
    {
        return [
            ['name' => 'Sem marca', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];
    }

    private function paymentMethods(): array
    {
        return [
            ['name' => 'Dinheiro', 'number_max_installments' => 1, 'show_on_store' => 1, 'show_on_finance' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'PIX', 'number_max_installments' => 1, 'show_on_store' => 1, 'show_on_finance' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Cartão de Credito', 'number_max_installments' => 6, 'show_on_store' => 1, 'show_on_finance' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Cartão de Debito', 'number_max_installments' => 1, 'show_on_store' => 1, 'show_on_finance' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Boleto', 'number_max_installments' => 12, 'show_on_store' => 1, 'show_on_finance' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Transferencia', 'number_max_installments' => 1, 'show_on_store' => 0, 'show_on_finance' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];
    }

    private function customers(): array
    {
        return [
            ['name' => 'Cliente sem cadastro', 'email' => 'email@example.com', 'customer_type' => 'N', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];
    }
}
