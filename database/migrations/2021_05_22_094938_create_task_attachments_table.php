<?php

use App\Constants\DatabaseTableNames;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DatabaseTableNames::TaskAttachments, function (Blueprint $table) {
            $table->id();
            $table->string('file_type');
            $table->string('name')->nullable();
            $table->string('uri');
            $table->unsignedBigInteger('task_id')->nullable();

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
        Schema::dropIfExists(DatabaseTableNames::TaskAttachments);
    }
}
