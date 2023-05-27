{{--<section class="product-area li-laptop-product Special-product pt-60 pb-45">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <form action="">--}}
{{--                    @foreach(request()->toArray() as $keyRq => $valueRq)--}}
{{--                        @if($keyRq != 'list_attr_search')--}}
{{--                            <input type="hidden" name="{{ $keyRq }}" value="{{ $valueRq }}">--}}
{{--                        @endif--}}
{{--                    @endforeach--}}

{{--                    <div class="row">--}}
{{--                        @foreach(getListAttrSearch() as $attrId => $item)--}}
{{--                            <div class="col">--}}
{{--                                <label for="">{{ $item['title'] }}</label>--}}
{{--                                <select class="form-control" name="list_attr_search[{{ $attrId }}]">--}}
{{--                                    <option value="">---</option>--}}
{{--                                    @foreach($item['list_search'] as $search)--}}
{{--                                        @if(!empty(request()->list_attr_search[$attrId]) && $search == request()->list_attr_search[$attrId])--}}
{{--                                            <option selected value="{{ $search }}">{{ $search }}</option>--}}
{{--                                        @else--}}
{{--                                            <option value="{{ $search }}">{{ $search }}</option>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                    <div class="row mt-5">--}}
{{--                        <div class="col-12 text-right">--}}
{{--                            <button class="btn btn-primary">Lọc</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
