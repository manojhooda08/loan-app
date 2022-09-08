<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('status_id')->default(1)->constrained()->cascadeOnDelete();
            $table->decimal('loan_amount', 10, 2);
            $table->integer('loan_tenure');
            $table->decimal('loan_intrest_rate', 10, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    // $table->decimal('loan_amount', 15, 2);
    // $table->longText('description')->nullable();

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_applications');
    }
}
