<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expensecategory_id')->index();
            $table->unsignedBigInteger('payment_type_id')->index();
            $table->text('description');
            $table->string('amount');
            $table->date('expense_date');
            $table->timestamps();
            $table->foreign('expensecategory_id')
            ->references('id')
            ->on('expense_categories')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreign('payment_type_id')
            ->references('id')
            ->on('payment_types')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
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
        Schema::dropIfExists('expenses');
    }
}
