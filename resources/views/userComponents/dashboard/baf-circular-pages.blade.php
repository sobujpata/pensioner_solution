<div class="container" style="margin-top:70px;">
    <div class="row">
        <div class="col-12">
            <h3>Circulars From BAF</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
		    <div class="form-group col-lg-12">
			    <table id="tableData" width="100%" class="table table-hover table-striped table-responsive">
                    <thead class="table-dark">
					    <tr>
                            <th>S/No</th>
                            <th>Title</th>
                            <th>Notice</th>
                            <th>Published</th>
                            <th>View</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($baf_ciculars as $item )
                            <tr>
                                <td align="center">{{$i++}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->subject}}</td>
                                <td>{{$item->published_on}}</td>
                                <td style="text-align:center;"><a href="{{$item->file_url}}" class="btn btn-success" target="_blank"><i class="fa fa-eye"></i></a></td>
                                <td>{{$item->remarks}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$baf_ciculars->links()}}
            </div>
        </div>
    </div>
</div>
