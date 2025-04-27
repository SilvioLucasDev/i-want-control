<?php declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('monthly_project_controls', function (Blueprint $table): void {
            $table->id();
            $table->string('month');
            $table->string('year');
            $table->unsignedBigInteger('hourly_rate');
            $table->time('total_hours_worked')->default('00:00:00');
            $table->unsignedBigInteger('total_receivable')->default(0);

            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->unique(['month', 'year', 'project_id'], 'monthly_project_controls_unique');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_project_controls');
    }
};
