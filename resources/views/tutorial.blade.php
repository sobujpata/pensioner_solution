@extends("layout.app2")
@section("content")
<div class="container pt-md-6 px-0 pt-4">
    <div class="row mt-md-2">
        <h2 id="" class="tutorial_header transform_header col-sm mt-5">{{$tutorial->title ?? ''}}</h2>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm my-3">
            <video class="tutorial_video transform_header" controls>
                <source src="{{$tutorial->vedio_url ?? ''}}" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>

</div>
@endsection
