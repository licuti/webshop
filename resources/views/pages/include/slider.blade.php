<div class="slide_img">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            {{-- <div class="swiper-slide" style="height: 450px"><img class="image" src="{{asset('public/frontend/images/slide1.png')}}"></div> --}}

            @foreach($show_slide as $key => $slide)
            <div class="swiper-slide">
                <img class="image" src="{{asset('public/images_upload/images_slide/'.$slide->image_slide)}}">
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
    