@for ($i = 0; $i < 6; $i++)
    <div class="col-md-3 my-2">
        <div class="mb-2" style="
        left: 0%;
        right: 0%;
        top: 0%;
        bottom: 0%;

        background: #FFFFFF;
        /* opacity: 0.1; */
        /* border: 1px solid rgba(0, 0, 0, 0.5); */
        box-sizing: border-box;
        box-shadow: 0px 0px 6px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px">
            <a href="{{ route('blog.article') }}">
                <img src="{{ my_asset('img/homepage/img/banner.jpg') }}" style="
                left: 0%;
                right: 0%;
                top: 0%;
                bottom: 45.11%;
                border-radius: 10px 10px 0px 0px;
                " class="card-img-top" alt="...">
                <div class="container" style="margin-top: 10px;padding-bottom:10px">
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
                    ">Trakhoma yang Tidak Diobati Bisa Sebabkan Komplikasi</p>
                    <p style="
                    left: 5.47%;
                    right: 5.47%;
                    top: 75.08%;
                    bottom: 4.73%;
                    font-family: Open Sans;
                    font-style: normal;
                    font-weight: normal;
                    font-size: 12px;
                    line-height: 16px;
                    color: #424242;
                    ">5 Causes of Fatigue when Wake Up 5 Causes of Fatigue when Wake Up 5 Causes of Fatigue when Wake Up 5 Causes of Fatigue when Wake Up</p>
                </div>
            </a>
        </div>
    </div>
@endfor