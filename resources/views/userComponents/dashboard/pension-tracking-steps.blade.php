		<style>

        </style>
        <pre></pre>
		<div class="container" style="margin-top: 80px; background-color: #92e6f7 !important;">
				<div class="row">
					<div class="col-lg-12" >
						<div class="form-control bg-success text-white" align="center">
							<b><p style="color:white;font-size:24px; text-transform: uppercase;">Pension Processing Status : Regular</p></b>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-control bg-success text-white" align="center">
							<b>BD/{{$pension_track->bdno}}</b>, <b>{{$pension_track->rank}}</b> <b>{{$pension_track->name}}</b>,
							<b>{{$pension_track->trade}}</b>, <b>Retd Type: {{$pension_track->retd_type}}</b>, <b>Last Unit: {{$pension_track->last_unit}}</b>,
							<b>SOD: {{$pension_track->sod}}</b>, <b>SOS: {{$pension_track->sos}}</b>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-lg-2">
						<div class="form-control bg-success text-white" align="center">
							<b>Steps</b>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control bg-success text-white" align="center">
							<b>Job Description</b>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control bg-success text-white" align="center">
							<b>Job Status</b>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control bg-success text-white" align="center">
							<b>Completion Date</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
							Step-1
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
							Submitted for DSPF ({{$pension_track->sub_dspf_amount}}Tk)
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->subs_dspf !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->subs_dspf !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
							<b>{{ \Carbon\Carbon::parse($pension_track->subs_dspf)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
							Step-2
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
							Submitted for LUMP ({{$pension_track->sub_lump_amount}}TK)
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->sub_lump !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->reg_ser_no !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
							<b>{{ \Carbon\Carbon::parse($pension_track->sub_lump)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
						Step-3
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
							DSPF Cheque Rec ({{$pension_track->rec_dspf_amount}}TK)
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->dsp_cheque !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->subs_dspf !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif

						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
                            <b>{{ \Carbon\Carbon::parse($pension_track->dsp_cheque)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
							Step-4
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
							LUMP Cheque Rec ({{$pension_track->rec_lump_amount}})
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->lump_cheque !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->sub_lump !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif

						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
                            <b>{{ \Carbon\Carbon::parse($pension_track->lump_cheque)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
							Step-5
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
							Medical Docu Sent to CMB
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->cmb !== NULL)
                                {{'Completed'}}
                            @else
                                {{'No'}}
                            @endif

						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
                            <b>{{ \Carbon\Carbon::parse($pension_track->cmb)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
							Step-6
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
							Medical Docu Received from CMB
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->rec !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->cmb !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif

						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
                            <b>{{ \Carbon\Carbon::parse($pension_track->rec)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>


				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
							Step-7
						</div>
					</div>

					<div class="col-lg-4">
						<div class="form-control " align="left">
							Document Sent to SFC (Air) for LPC
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->sent_for_lpc !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->rec !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
                            <b>{{ \Carbon\Carbon::parse($pension_track->sent_for_lpc)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
						Step-8
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
						LPC Received from SFC (Air)
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->lpc_rcvd !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->sent_for_lpc !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif

						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
                            <b>{{ \Carbon\Carbon::parse($pension_track->lpc_rcvd)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
							Step-9
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
							Assessment Prepared By RO
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->assesment_ready !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->lpc_rcvd !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif

						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
                            <b>{{ \Carbon\Carbon::parse($pension_track->assesment_ready)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
							Step-10
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
							Assessment Sent to SFC (Air) for Audit
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->assesment_sfc_audit !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->assesment_ready !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif

						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
                            <b>{{ \Carbon\Carbon::parse($pension_track->assesment_sfc_audit)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
							Step-11
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
							Audit Received By RO From SFC (Air)
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->audit_rcvd !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->assesment_sfc_audit !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif

						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
                            <b>{{ \Carbon\Carbon::parse($pension_track->audit_rcvd)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
							Step-12
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
							Sanction Sent To Air HQ (Dte Fin)
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->senc_sent_dtefin !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->audit_rcvd !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif

						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
                            <b>{{ \Carbon\Carbon::parse($pension_track->senc_sent_dtefin)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
							Step-13
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
							Sanction Received From Air HQ (Dte Fin)
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->senc_rcvd_dtefin !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->senc_sent_dtefin !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif

						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
                            <b>{{ \Carbon\Carbon::parse($pension_track->senc_rcvd_dtefin)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
							Step-14
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
							Commu Bill Sent To SFC ({{$pension_track->comm_amount_sent}}TK)
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->commbill_to_sfc !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->senc_rcvd_dtefin !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif

						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
                            <b>{{ \Carbon\Carbon::parse($pension_track->commbill_to_sfc)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
							Step-15
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
							Commutation Cheque Rcvd from SFC (Air)
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->cheque_rcvd !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->commbill_to_sfc !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif

						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
                            <b>{{ \Carbon\Carbon::parse($pension_track->cheque_rcvd)->format('d-m-Y') }}</b>
						</div>
					</div>
				</div></p>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-control " align="center">
							Step-16
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="left">
							Commutation Received Amount (Taka)
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-control " align="center">
                            @if ($pension_track->comm_amount !== NULL)
                                {{'Completed'}}
                            @elseif($pension_track->cheque_rcvd !== NULL)
                                {{'Under Process'}}
                            @else
                                {{'No'}}
                            @endif

						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-control " align="center">
                            <b>{{ $pension_track->comm_amount }}</b>
						</div>
					</div>
				</div></p>
		</div>

