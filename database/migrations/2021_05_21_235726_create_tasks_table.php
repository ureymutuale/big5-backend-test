<?php

use App\Constants\DatabaseTableNames;
use App\Constants\TaskStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DatabaseTableNames::Tasks, function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->string('description')->nullable(true);
            $table->string('status')->nullable(false)->default(TaskStatus::Pending);

            $table->timestamps();

            $table->index('id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::Tasks);
    }
}
