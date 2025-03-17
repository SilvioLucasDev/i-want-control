<?php declare(strict_types = 1);

namespace Database\Seeders;

use App\Expense\Models\Investment;
use App\Expense\Models\PaymentMethod;
use App\Expense\Models\Project;
use App\User\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            PaymentMethodSeeder::class,
            InvestmentSeeder::class,
            ProjectSeeder::class,
        ]);

        User::factory(10)->create()->each(function ($user): void {
            Project::factory(2)->create(['user_id' => $user->id]);
            Investment::factory(2)->create(['user_id' => $user->id]);
            PaymentMethod::factory(2)->create(['user_id' => $user->id]);
        });
    }
}
