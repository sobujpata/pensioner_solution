<style>
    .container{
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif, SolaimanLipi !important;
        font-size: 16px;
    }
</style>
<div class="container" style="margin-top: 80px;">
    <div class="table-header">
        <h3 class="text-bold text-decoration-underline">@if($category->name=="সাধারণ জ্ঞাতব্য")
                                প্রায়শ জিজ্ঞাসিত সাধারণ জ্ঞাতব্য প্রশ্নাবলী এবং উত্তর
                            @elseif ($category->name=="পেনশন")
                                {{$category->name}} সংক্রান্ত প্রায়শ জিজ্ঞাসিত প্রশ্নাবলী এবং উত্তর
                            @elseif ($category->name=="ওয়েলফেয়ার")
                                {{$category->name}} সংক্রান্ত প্রায়শ জিজ্ঞাসিত প্রশ্নাবলী এবং উত্তর
                            @endif
                            </h3>
    </div>

<hr>
    <div class="row faq">
        @php
            $count = 1
        @endphp
        @foreach ($faqs as $faq)
            <span class="d-inline-flex gap-1 text-left">
                <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample{{ $count }}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $count }}">
                    {{$count++ }}. {{$faq->name}}
                </a>
            </span>
            <div class="collapse pb-3" id="collapseExample{{ $count - 1 }}">
                <div class="card card-body" style="text-align: left !important; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif, SolaimanLipi !important;">
                    {!! $faq->description !!}<br><br><span class="text-primary">সেবা প্রদানকারীঃ {{$faq->respective_section}}</span>
                </div>
            </div>
        @endforeach

    </div>
</div>







