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
        Schema::create('posting_project_activities', function (Blueprint $table): void {
            $table->id();
            $table->string('scope');
            $table->string('description');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('duration');

            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('monthly_project_control_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posting_project_activities');
    }
};
