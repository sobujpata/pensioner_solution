<?php

namespace App\Http\Controllers;

use App\Models\PensionStatus;
use App\Models\PensionStep;
use Illuminate\Http\Request;

class PensionInfoController extends Controller
{
    public function index(){
        return view("pages.dashboard.pensioner-list");
    }

    public function pensionerAdminlist(){
        $pensioners = PensionStep::all();

        return response()->json($pensioners);
    }

    public function pensionerCreate(Request $request)
    {
        // dd($request);
        try {
            $validated = $request->validate([
                // Validation rules here...
                'bdno' => 'required|string|max:10',
                'rank' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'trade' => 'nullable|string|max:255',
                'retd_type' => 'nullable|string|max:255',
                'last_unit' => 'nullable|string|max:255',
                'dob' => 'nullable|date',
                'nid' => 'nullable|string|max:20',
                'mobile_no' => 'nullable|string|max:15',
                'sod' => 'nullable|date',
                'sos' => 'nullable|date',
                'reg_ser_no' => 'nullable|string|max:255',
                'subs_dspf' => 'nullable|date',
                'sub_dspf_amount' => 'nullable|numeric',
                'dsp_cheque' => 'nullable|date',
                'rec_dspf_amount' => 'nullable|numeric',
                'sub_lump' => 'nullable|date',
                'sub_lump_amount' => 'nullable|numeric',
                'lump_cheque' => 'nullable|date',
                'rec_lump_amount' => 'nullable|numeric',
                'cmb' => 'nullable|date',
                'rec' => 'nullable|date',
                'rec_from_sfc' => 'nullable|date',
                'sent_for_lpc' => 'nullable|date',
                'lpc_rcvd' => 'nullable|date',
                'assesment_ready' => 'nullable|date',
                'assesment_sfc_audit' => 'nullable|date',
                'audit_rcvd' => 'nullable|date',
                'senc_sent_dtefin' => 'nullable|date',
                'senc_rcvd_dtefin' => 'nullable|date',
                'commbill_to_sfc' => 'nullable|date',
                'comm_amount_sent' => 'nullable|numeric',
                'cheque_rcvd' => 'nullable|date',
                'comm_amount' => 'nullable|numeric',
                'status' => 'required|string|max:255',
                'remarks' => 'nullable|string|max:255',
            ]);

            $pensioner = PensionStep::create($validated);

            return response()->json([
                'pensioner' => $pensioner,
                'message' => "Pensioner created successfully",
                'status' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "An error occurred",
                'error' => $e->getMessage(),
                'status' => 'error',
            ], 500);
        }
    }

    public function pensionerById(Request $request){
        $id = $request->input('id');

        $pensioner = PensionStep::find($id);

        return response()->json($pensioner);
    }

    public function pensionerUpdate(Request $request){
        // dd($request);
        $id=$request->input('id');
        try {
            $validated = $request->validate([
                // Validation rules here...
                'id' => 'required|integer',
                'bdno' => 'required|string|max:10',
                'rank' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'trade' => 'nullable|string|max:255',
                'retd_type' => 'nullable|string|max:255',
                'last_unit' => 'nullable|string|max:255',
                'dob' => 'nullable|date',
                'nid' => 'nullable|string|max:20',
                'mobile_no' => 'nullable|string|max:15',
                'sod' => 'nullable|date',
                'sos' => 'nullable|date',
                'reg_ser_no' => 'nullable|string|max:255',
                'subs_dspf' => 'nullable|date',
                'sub_dspf_amount' => 'nullable|numeric',
                'dsp_cheque' => 'nullable|date',
                'rec_dspf_amount' => 'nullable|numeric',
                'sub_lump' => 'nullable|date',
                'sub_lump_amount' => 'nullable|numeric',
                'lump_cheque' => 'nullable|date',
                'rec_lump_amount' => 'nullable|numeric',
                'cmb' => 'nullable|date',
                'rec' => 'nullable|date',
                'rec_from_sfc' => 'nullable|date',
                'sent_for_lpc' => 'nullable|date',
                'lpc_rcvd' => 'nullable|date',
                'assesment_ready' => 'nullable|date',
                'assesment_sfc_audit' => 'nullable|date',
                'audit_rcvd' => 'nullable|date',
                'senc_sent_dtefin' => 'nullable|date',
                'senc_rcvd_dtefin' => 'nullable|date',
                'commbill_to_sfc' => 'nullable|date',
                'comm_amount_sent' => 'nullable|numeric',
                'cheque_rcvd' => 'nullable|date',
                'comm_amount' => 'nullable|numeric',
                'status' => 'required|string|max:255',
                'remarks' => 'nullable|string|max:255',
            ]);

            $pensioner = PensionStep::where('id', $id)->update($validated);

            return response()->json([
                'pensioner' => $pensioner,
                'message' => "Pensioner updated successfully",
                'status' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "An error occurred",
                'error' => $e->getMessage(),
                'status' => 'error',
            ], 500);
        }
    }

    public function pensionerDelete(Request $request){
        $id = $request->input('id');

        $deletePensioner = PensionStep::where('id', $id)->delete();

        return response()->json($deletePensioner);
    }





}
