@foreach ($blogs as $key => $blog)

    <div class="col-lg-3">
        <div class="card mb-2" style="box-shadow: 0px 0px 6px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px">
            <a href="{{ route('detail.blog', encrypt($blog->id)) }}" class="text-center p-0 m-0">
                <img class="img-fluid" src="{{ my_asset($blog->thumbnail) }}" width="" height="130" style="
                    border-radius: 10px 10px 0px 0px; 
                    max-height: 130px; max-width: 255px;" >
                <div class="mt-3 p-2">
                    <p style="
                        left: 5.47%;
                        right: 5.47%;
                        top: 58.04%;
                        bottom: 28.08%;
                        font-family: Open Sans;
                        font-style: normal;
                        font-weight: 600;
                        font-size: 16px;
                        line-height: 22px;
                        color: #212121;
                        ">{{ $blog->title }}</p>
                    <p style="
                        left: 5.47%;
                        right: 5.47%;
                        top: 75.08%;
                        bottom: 4.73%;
                        font-family: Open Sans;
                        font-style: normal;
                        font-weight: normal;
                        font-size: 14px;
                        line-height: 16px;
                        color: #424242;
                        ">
                        {{ $blog->subtitle }}    
                    </p>
                </div>
            </a>
        </div>
    </div>
@endforeach
