<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pension_steps', function (Blueprint $table) {
            $table->id();
            $table->string('bdno', 10)->unique();
            $table->string('rank', 20);
            $table->string('name', 50);
            $table->string('trade', 50);
            $table->string('retd_type', 50)->nullable();
            $table->string('last_unit', 20)->nullable();
            $table->date('dob')->nullable();
            $table->string('nid', 20)->nullable();
            $table->string('mobile_no', 20)->nullable();
            $table->date('sod')->nullable();
            $table->date('sos')->nullable();
            $table->string('reg_ser_no', 20)->nullable();
            $table->date('subs_dspf')->nullable();
            $table->string('sub_dspf_amount', 20)->nullable();
            $table->string('rec_dspf_amount', 20)->nullable();
            $table->date('sub_lump')->nullable();
            $table->string('sub_lump_amount', 20)->nullable();
            $table->string('rec_lump_amount', 20)->nullable();
            $table->date('cmb')->nullable();
            $table->date('rec')->nullable();
            $table->string('dsp_cheque', 20)->nullable();
            $table->string('lump_cheque', 20)->nullable();
            $table->date('sent_for_lpc')->nullable();
            $table->date('lpc_rcvd')->nullable();
            $table->date('assesment_ready')->nullable();
            $table->date('assesment_sfc_audit')->nullable();
            $table->date('audit_rcvd')->nullable();
            $table->date('senc_sent_dtefin')->nullable();
            $table->date('senc_rcvd_dtefin')->nullable();
            $table->date('commbill_to_sfc')->nullable();
            $table->date('rec_from_sfc')->nullable();
            $table->date('cheque_rcvd')->nullable();
            $table->date('comm_amount_sent')->nullable();
            $table->string('comm_amount', 20)->nullable();
            $table->string('remarks', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pension_steps');
    }
};
