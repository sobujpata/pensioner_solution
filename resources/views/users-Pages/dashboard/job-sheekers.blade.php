@extends('layout.app1')
@section('content')
<div class="container-md" style="margin-top: 80px;">
    <div class="row my-4" style="margin-top: 85px;">
        <div class="col-md-12 bg-white padding-0">
			<h2 align="center"><span style="padding: 5px 10px; background: #1cc88a; color: white; border-radius: 5px;">Job Seekers List With CV</a></b</span></h2>
		</div>
	</div>
	<table id="customers" class="example1 table table-striped table-hover">
		<thead align="center" bgcolor="#1cc88a" style="color:white;">
			<th>S/No</th>
			<th>Photo</th>
			<th>Particular</th>
			<th>Experience</th>
			<th>Job Choice</th>
			<th>Job Area</th>
			<th>View CV</th>
		</thead>
		<tfoot align="center" bgcolor="#1cc88a" style="color:white;" id="welfare">
			<th>S/No</th>
			<th>Photo</th>
			<th>Particular</th>
			<th>Experience</th>
			<th>Job Choice</th>
			<th>Job Area</th>
			<th>View CV</th>
		</tfoot>
	<tbody>
    @php
        $i = 1;
    @endphp
        @foreach ($data as $item)
            <tr bgcolor='#B5E3FF'>
                <td style='text-align: center; vertical-align:middle;'> {{$i}}</td>
                <td style='text-align: center; vertical-align:middle;'><img src="{{$user_data->profile_image}}" alt="" style="height: 80px; width: 70px; border:3px solid #B2B8B7; border-radius: 2px;"></td>
                <td style='text-align: center; vertical-align:middle;'>BD/{{$user_data->bdno}}, {{$user_data->rank}} {{$user_data->fname}},<br> {{$user_data->trade}}, {{$user_data->mobile}},<br> {{$user_data->email}}<?php //echo $row['bdno'];?></td>
                <td style='text-align: center; vertical-align:middle;' >{{$item->experience}}</td>
                <td style="text-align: center; vertical-align:middle;">{{$item->jobchoice}}</td>
                <td style='text-align: center; vertical-align:middle;'>{{$item->jobarea}}</td>
                <td style="text-align: center; vertical-align:middle;"><a href="{{$item->resume}}" target="_blank"><i class="fa-4x fa fa-file-pdf" style=" color:red"></i></a></td>
            </tr>
        @endforeach



	</table>
    {{$data->links()}}
</div>
@endsection


