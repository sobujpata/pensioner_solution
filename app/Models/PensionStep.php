<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PensionStep extends Model
{
    protected $fillable = [
        "bdno",
        "rank",
        "name",
        "trade",
        "retd_type",
        "last_unit",
        "dob",
        "nid",
        "mobile_no",
        "sod",
        "sos",

        "reg_ser_no",
        "subs_dspf",
        "sub_dspf_amount",
        "dsp_cheque",
        "rec_dspf_amount",
        "sub_lump",
        "sub_lump_amount",
        "lump_cheque",
        "rec_lump_amount",
        "cmb",
        "rec",

        "rec_from_sfc",
        "sent_for_lpc",
        "lpc_rcvd",
        "assesment_ready",
        "assesment_sfc_audit",
        "audit_rcvd",
        "senc_sent_dtefin",
        "senc_rcvd_dtefin",
        "commbill_to_sfc",
        "comm_amount_sent",
        "cheque_rcvd",
        "comm_amount",
        "remarks",
    ];
}
