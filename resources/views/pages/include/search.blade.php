<div class="form_seach">
    <form action="{{URL::to('/tim-kiem-san-pham')}}" method="post">
        @csrf
        <div class="seach">
            <div class="seach_input_box">
                <label><i class="fa fa-search" aria-hidden="true"></i></label>
                <input type="text" name="seach_product"placeholder="Tìm kiếm sản phẩm" value="{{$text_search = Session::get('text_search')}}">
            </div>
            <div class="seach_input_btn">
                <input type="submit" name="" value="Tìm Kiếm">
            </div>
        </div>
    </form>
</div>