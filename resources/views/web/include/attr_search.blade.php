<div class="col-12 order-2 order-lg-1">
    <!--sidebar-categores-box end  -->
    <!--sidebar-categores-box start  -->
    <div class="sidebar-categores-box">
        <div class="sidebar-title">
            <h2>Lọc</h2>
        </div>

        @if(!empty(request()->toArray()['list_attr_search']))
            <!-- btn-clear-all start -->
            <button class="btn-clear-all mb-sm-30 mb-xs-30" id="btn-clear-all-search">Xóa tất cả bộ lọc</button>
            <!-- btn-clear-all end -->
            <form action="" id="form-attr-search-base">
                @foreach(request()->toArray() as $keyRq => $valueRq)
                    @if($keyRq != 'list_attr_search')
                        <input type="hidden" name="{{ $keyRq }}" value="{{ $valueRq }}">
                    @endif
                @endforeach
            </form>
        @endif

        <form action="" id="form-attr-search">
            @foreach(request()->toArray() as $keyRq => $valueRq)
                @if($keyRq != 'list_attr_search')
                    <input type="hidden" name="{{ $keyRq }}" value="{{ $valueRq }}">
                @endif
            @endforeach
        </form>



        @foreach(getListAttrSearch($listProductId ?? []) as $attrId => $item)
            <!-- filter-sub-area start -->
            <div class="filter-sub-area">
                <h5 class="filter-sub-titel">{{ $item['title'] }}</h5>
                <div class="categori-checkbox">
                    <form action="#">
                        <ul>
                            @foreach(array_unique($item['list_search']) as $search)
                                @if(!empty(request()->list_attr_search[$attrId]) && in_array($search, request()->list_attr_search[$attrId]))
                                    <li><input form="form-attr-search" class="list_attr_search" name="list_attr_search[{{ $attrId }}][]" type="checkbox" checked value="{{ $search }}">
                                        <a href="#">{{ $search }}</a>
                                    </li>
                                @else
                                    <li><input form="form-attr-search" class="list_attr_search" name="list_attr_search[{{ $attrId }}][]" type="checkbox" value="{{ $search }}">
                                        <a href="#">{{ $search }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>
            <!-- filter-sub-area end -->
        @endforeach
    </div>
    <!--sidebar-categores-box end  -->
</div>

@section('js_attr_search')
    <script>
        $(document).ready(function () {
            $('.list_attr_search').change(function () {
                $('#form-attr-search').submit();
            });

            $('#btn-clear-all-search').click(function () {
                $('#form-attr-search-base').submit();
            });
        });
    </script>
@endsection
