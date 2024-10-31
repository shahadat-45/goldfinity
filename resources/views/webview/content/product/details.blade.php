@extends('webview.master')

@section('maincontent')
    @section('title')
        {{ env('APP_NAME') }}-{{ $productdetails->ProductName }}
    @endsection

    @section('meta')
        <meta name="description"
              content="Online shopping in Bangladesh for beauty products, men, women, kids, fashion items, clothes, electronics, home appliances, gadgets, watch, many more.">
        <meta name="keywords"
              content="arishatex, online store bd, online shop bd, Organic fruits, Thai, UK, Korea, China, cosmetics, Jewellery, bags, dress, mobile, accessories, automation Products,">


        <meta itemprop="name" content="{{ $productdetails->ProductName }}">
        <meta itemprop="description"
              content="Best online shopping in Bangladesh for beauty products, men, women, kids, fashion items, clothes, electronics, home appliances, gadgets, watch, many more.">
        <meta itemprop="image" content="https://arishatex.com/{{ $productdetails->ProductImage }}">

        <meta property="og:url" content="https://arishatex.com/product/{{$productdetails->ProductSlug}}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $productdetails->ProductName }}">
        <meta property="og:description"
              content="Online shopping in BD for beauty products, men, women, kids, fashion items, clothes, electronics, home appliances, gadgets, watch, many more.">
        <meta property="og:image" content="https://arishatex.com/{{ $productdetails->ProductImage }}">
        <meta property="image" content="https://arishatex.com/{{ $productdetails->ProductImage }}"/>
        <meta property="url" content="https://arishatex.com/product/{{$productdetails->ProductSlug}}">
        <meta itemprop="image" content="https://arishatex.com/{{ $productdetails->ProductImage }}">
        <meta property="twitter:card" content="https://arishatex.com/{{ $productdetails->ProductImage }}"/>
        <meta property="twitter:title" content="{{ $productdetails->ProductName }}"/>
        <meta property="twitter:url" content="https://arishatex.com/product/{{$productdetails->ProductSlug}}">
        <meta name="twitter:image" content="https://arishatex.com/{{ $productdetails->ProductImage }}">
    @endsection
    <style>
        .sizetext {
            color: 000;
            background: #fff;
        }

        .colortext {
            color: #000;
            background: #fff;
        }

        .product {
            margin-top: 4px !important;

        }

        #featureimagess {
            width: 100%;
            padding: 2px;
            padding-top: 0;
            max-height: 200px;
        }

        @media screen and (max-width: 480px) {
            .cat__bg .col-xs-3 {
                width: 20% !important;
            }
        }

        .col-xs-3 {
            width: 20%;
        }

        .cat__img {
            border-radius: 50%;
            margin-bottom: 5px;
        }

        /*   Featured Product */
        .image_thum {
            width: 183px;
            height: 183px;
        }

        .image_thum img {
            width: 100%;
            height: 100%;
            min-height: 140px;
            object-fit: contain;
        }

        .product__item {
            padding: 0;
            padding-top: 0px;
            background: #dedede;
        }
        #buttonminus {
            font-size: 18px;
            border: 1px solid;
            padding: 3px 14px;
            border-radius: 0px;
            height: 34px;
            margin: 0;
            line-height: 4px;
            background: red;
            color: white;
            border: 1px solid red;
        }

        #buttonplus {
            font-size: 18px;
            border: 1px solid;
            padding: 3px 14px;
            border-radius: 0px;
            height: 34px;
            margin: 0;
            line-height: 4px;
            background: green;
            color: white;
            border: 1px solid green;
        }

        @media screen and (max-width: 480px) {
            #productName374 {
                height: 18px;
            }
        }

        #productName374 {
            padding: 0;
            padding-bottom: 0px;
            display: block;
            line-height: 28px;
            color: #6E151C;
            font-size: 12px;
            height: 28px;
            overflow: hidden;
        }

        #productPrice374 {
            padding: 0;
            padding-bottom: 10px;
            display: block;
            height: 28px;
            line-height: 28px;
            color: #6E151C;
            font-size: 14px;
            font-weight: bold;
        }

        .product_form {
            padding: 0;
            display: block;
            height: 21px;
            font-size: 12px;
            font-weight: bold !important;
        }

        /*    Button*/
        button, input, select, textarea {
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        button, html input[type=button], input[type=reset], input[type=submit] {
            -webkit-appearance: button;
            cursor: pointer;
        }

        button, select {
            text-transform: none;
        }

        button {
            overflow: visible;
        }

        button, input, optgroup, select, textarea {
            margin: 0;
            font: inherit;
            color: inherit;
        }

        #relatedCarousel .col-xs-12 {
            width: 100%;
        }
        .weightinfo {
            margin-bottom: 10px; /* Space between options */
        }

        .weight-label {
            cursor: pointer; /* Change cursor to pointer */
            transition: background-color 0.3s, color 0.3s; /* Smooth transition for hover and select */
        }

        input[type="radio"]:checked + .weight-label {
            background-color: #613EEA; /* Change background color when selected */
            color: white; /* Change text color when selected */
            border-color: #4A28B1; /* Darker border when selected */
        }

        input[type="radio"]:not(:checked) + .weight-label:hover {
            background-color: #f0f0f0; /* Optional hover effect for unselected labels */
        }



    </style>
    <!-- Body -->

    <div class="mt-4 body-content" id="top-banner-and-menu">
        <div class='container'>
            <div class='row single-product'>
                <div class='p-0 col-md-12'>
                    <div class="detail-block">
                        <div class="row wow fadeInUp">

                            <div class="col-xs-12 col-sm-12 col-md-6 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">

                                    @if (isset($productdetails->PostImage))
                                        <div id="sync1" class="owl-carousel owl-theme">
                                            <div class="items">
                                                <img class="w-100 h-100"
                                                     src="{{ asset($productdetails->ProductImage) }}" alt=""
                                                     style="border-radius: 4px;">
                                            </div>
                                            @forelse (json_decode($productdetails->PostImage) as $productImage)
                                                <div class="items">
                                                    <img class="w-100 h-100"
                                                         src="{{ asset('public/images/product/slider/') }}/{{ $productImage }}"
                                                         alt="" style="border-radius: 4px;">
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                        <div id="sync2" class="owl-carousel owl-theme" style="padding-top: 10px;">
                                            @forelse (json_decode($productdetails->PostImage) as $productImage)
                                                <div class="items">
                                                    <img class="w-100 h-100"
                                                         style="padding:10px;border:1px solid;border-radius: 4px;"
                                                         src="{{ asset('public/images/product/slider/') }}/{{ $productImage }}"
                                                         alt="">
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    @else
                                        <div class="items">
                                            <img class="w-100 h-100" src="{{ asset($productdetails->ProductImage) }}"
                                                 alt="" style="border-radius: 4px;">
                                        </div>
                                    @endif

                                </div>
                                <!-- /.single-product-gallery -->
                            </div>
                            <!-- /.gallery-holder -->
                            <div class="col-sm-12 col-md-6 product-info-block" id="paddingnone">
                                <div class="product-info">
                                    <h1 class="name"
                                        style="margin-top:16px !important;padding-bottom: 6px;border-bottom: 1px solid #dfd6d6;font-size: 20px !important; line-height: 22px;">
                                        {{ $productdetails->ProductName }}</h1>


                                    <!-- /.rating-reviews -->

                                    <div class="stock-container info-container m-t-10"
                                         style="margin-top:10px;border-bottom: 1px solid #dfd6d6;">
                                        <div class="row" style="margin-bottom:10px;">
                                            <div class="col-2 col-sm-2">
                                                <div class="product-description-label" id="productPricetitle">Price:
                                                </div>
                                            </div>
                                            <div class="col-9 col-sm-9">
                                                <div class="product-price strong-700" id="productPriceAmount">
                                                    @php
                                                        $basicInfo = App\Models\Basicinfo::where('id' , 1)->first();
                                                        $weight = App\Models\Weight::where('product_id' , $productdetails->id)->first();
                                                        $goldPrice = 0;
                                                        $karats = $weight->karats ?? '';
                                                        
                                                        if ($karats == 'karat18') {
                                                            $goldPrice = $basicInfo->karat18;                                                        
                                                        }
                                                        if ($karats == 'karat20') {
                                                            $goldPrice = $basicInfo->karat20;                                                        
                                                        }
                                                        if ($karats == 'karat21') {
                                                            $goldPrice = $basicInfo->karat21;                                                        
                                                        }
                                                        if ($karats = 'karat22') {
                                                            $goldPrice = $basicInfo->karat22;                                                        
                                                        }

                                                        $cost = round(($goldPrice / 100) * $basicInfo->cost, 2);
                                                        $price = round($goldPrice * ($weight->weight_name ?? 0), 2);
                                                        $salePrice = round($cost + $price, 2);
                                                        $regularPrice = round($salePrice + (($salePrice / 100) * 5), 2);


                                                    @endphp

                                                    @if(count($productdetails->weights)>0)

                                                        <del id="pRegularPrice" style="font-size: 20px;color: red;">
                                                            ৳{{ $salePrice }}</del>
                                                        &nbsp;&nbsp;
                                                        <span id="pSalePrice">  ৳ {{ $salePrice }} </span>
                                                        <input id="psprice" type="text"
                                                               value="{{ $salePrice }}"
                                                               hidden/>
                                                    @else
                                                        <del style="font-size: 20px;color: red;">
                                                            ৳{{$salePrice}}</del>&nbsp;
                                                        &nbsp;
                                                        ৳ {{ $salePrice }}

                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.stock-container -->
                                    <div class="quantity-container info-container"
                                         style="border-bottom: 1px solid #dfd6d6;">
{{--                                        <div class="row">--}}

{{--                                            <div class="col-3 col-sm-3">--}}
{{--                                                <span class="label bg-none">Quantity :</span>--}}
{{--                                            </div>--}}

{{--                                            <div class="col-3 col-sm-3">--}}
{{--                                                <div class="cart-quantity">--}}
{{--                                                    <div class="quant-input">--}}

{{--                                                        <input type="number" value="1" min="1">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="col-6 col-sm-6">--}}

{{--                                            </div>--}}


{{--                                        </div>--}}
                                        <!-- /.row -->
                                        
{{--                                        Updated Quantity--}}
                                        <span class="text-center">
                                    <p for="" style=" margin: 0; padding-top: 1px; font-weight: bold;text-align:left">
                                        Quantity
                                    </p>
                                    <div class="d-flex" style="justify-content: left;">
                                        <button class="btn btn-sm" id="buttonminus" onclick="minus()" fdprocessedid="2r7sh">-</button>
                                        <div class="cart-quantity">
                                            <div class="quant-input">
                                                <input type="text" class="form-control" style="font-size: 20px;height: fit-content;height: 34px;padding:0px;width: 80px;text-align: center; margin-left: 2px" value="1" id="qtyval" fdprocessedid="wvn3pc">
                                            </div>
                                        </div>
                                        <button class="btn btn-sm" id="buttonplus" onclick="plus()" fdprocessedid="h3eyh3">+</button>
                                    </div>
                                </span>
                                        
                                        
                                    </div>
                                    <div class="mt-2 mb-2 row">
                                        @if (empty($productdetails->color))
                                        @else
                                            <div class="mb-2 col-12 col-md-12 colorpart">
                                                <div class="d-flex">
                                                    <h4 id="resellerprice" class="m-0"><b style="font-size:20px">কালার:&nbsp;&nbsp;&nbsp;</b>
                                                    </h4>
                                                    <div class="colorinfo">
                                                        @forelse (json_decode($productdetails->color) as $color)
                                                            <input type="radio" class="m-0" id="color{{ $color }}"
                                                                   hidden name="color"
                                                                   onclick="getcolor('{{ $color }}')">
                                                            <label class="colortext ms-0" id="colortext{{ $color }}"
                                                                   for="color{{ $color }}"
                                                                   style="border: 1px solid #613EEA;font-size:20px;font-weight:bold;padding: 0px 12px;border-radius: 4px;"
                                                                   onclick="getcolor('{{ $color }}')">{{ $color }}</label>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if (empty($productdetails->size))
                                        @else
                                            <div class="col-12 col-md-12 colorpart">
                                                <div class="d-flex">
                                                    <h4 id="resellerprice" class="m-0"><b style="font-size:20px">সাইজ:
                                                            &nbsp;&nbsp;&nbsp;</b></h4>
                                                    <div class="sizeinfo">
                                                        @forelse (json_decode($productdetails->size) as $size)
                                                            <input type="radio" class="m-0" hidden id="size{{ $size }}"
                                                                   name="size" onclick="getsize('{{ $size }}')">
                                                            <label class="sizetext ms-0" id="sizetext{{ $size }}"
                                                                   for="size{{ $size }}"
                                                                   style="border: 1px solid #613EEA;font-size:20px;font-weight:bold;padding: 0px 12px;border-radius: 4px;"
                                                                   onclick="getsize('{{ $size }}')">{{ $size }}</label>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        {{--  Weight Field   --}}
                                        @if (count($productdetails->weights)>0)

                                            <div class="mt-2 col-12 col-md-12 colorpart">
                                                <div class="d-flex ">
                                                    <h4 id="resellerprice" class="m-0"><b style="font-size:20px">ক্যারেট:
                                                            &nbsp;&nbsp;&nbsp;</b></h4>
                                                    <div class="weightinfo">
                                                        @php
                                                            $weightsList = App\Models\Weight::where('product_id' , $productdetails->id)->groupBy('karats')->get();
                                                        @endphp
                                                        @forelse ($weightsList as $weight)
                                                            <input type="radio" class="m-0" hidden
                                                                   id="sizeWeight{{ $weight->karats }}"
                                                                   name="weight"
                                                                   value="{{$weight->karats}}"
                                                                   onclick="getWeight('{{ $weight->karats }}')"/>
                                                            <label class="weighttext ms-0 weight-label"
                                                                   id="weightText{{ $weight->karats }}"
                                                                   for="sizeWeight{{ $weight->karats }}"
                                                                   style="border: 1px solid #613EEA;font-size:20px;font-weight:bold;padding: 0px 12px;border-radius: 4px;">{{ $weight->karats }}</label>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            
                                            @endif
                                            <div class="mt-2 col-12 col-md-12 colorpart karats_weight">
                                                                                                  
                                                <div class="d-flex weightsList">
                                                </div>
                                            </div>
                                    </div>
                                    @if($productdetails->preorder_status)
                                        <span class="my-2 text-muted">{{\App\Models\Basicinfo::first()->preorder_text}}</span>
                                    @endif
                                    <!-- /.stock-container -->
                                    <div class="text-center quantity-container info-container"
                                         style="width: 100%;border-bottom: 1px solid #dfd6d6; float: left;">


                                        <form name="form" id="AddToCartForm" method="POST" enctype="multipart/form-data"
                                              style="width: 50%;float: left;text-align: center;">
                                            @method('POST')
                                            @csrf
                                            <input type="text" name="color" id="product_color" hidden>
                                            <input type="text" name="size" id="product_size" hidden>
                                            <input type="text" name="weight" id="product_weight" hidden>
                                            <input type="text" name="karats" id="product_karats" hidden>
                                            <input type="text" id="pID" name="product_id"
                                                   value="{{ $productdetails->id }}" hidden>

                                            @if(count($productdetails->weights)>0)
                                                <input type="text" name="productSalePrice" id="cartProductPrice"
                                                       value="{{ $productdetails->weights[0]->productSalePrice }}"
                                                       hidden>
                                            @else
                                                <input type="text" name="productSalePrice" id="cartProductPrice"
                                                       value="{{ $productdetails->ProductSalePrice }}" hidden>

                                            @endif

                                            <input type="text" name="qty" value="1" id="qtyor" hidden>
                                            <button type="submit"
                                                    class="mb-0 ml-2 btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now"
                                                    style="background:#F27336;color:white;width: 95%;font-size: 17px;">
                                                কার্টে যোগ করুন
                                            </button>
                                        </form>

                                        <form name="form" action="{{url('add-to-cart')}}" method="POST"
                                              enctype="multipart/form-data"
                                              style="width: 50%;float: left;text-align: center;">
                                            @method('POST')
                                            @csrf
                                            <input type="text" name="color" id="product_colorOr" hidden>
                                            <input type="text" name="size" id="product_sizeOr" hidden>
                                            <input type="text" name="karats" id="product_karatsOr" hidden>
                                            @if(count($productdetails->weights)>0)
                                                <input type="text" name="weight" id="product_weightOr"
                                                       value="{{$productdetails->weights[0]->weight_name}}" hidden>
                                            @else

                                            @endif
                                            <input type="text" name="product_id" value=" {{ $productdetails->id }}"
                                                   hidden>

                                            @if(count($productdetails->weights)>0)
                                                <input type="text" name="productSalePrice" id="orderProductPrice"
                                                       value="{{ $productdetails->weights[0]->productSalePrice }}"
                                                       hidden>
                                            @else
                                                <input type="text" name="productSalePrice" id="orderProductPrice"
                                                       value="{{ $productdetails->ProductSalePrice }}" hidden>

                                            @endif
                                            <input type="text" name="qty" value="1" id="qtyor" hidden>
                                            <button type="submit"
                                                    class="mb-0 ml-2 btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now"
                                                    style="background:green;color:white;width: 95%;font-size: 17px;">
                                                অর্ডার করুন
                                            </button>
                                        </form>

                                        <!-- /.row -->
                                    </div>

                                    <div class="text-center quantity-container info-container"
                                         style="border-bottom: 1px solid #dfd6d6;">
                                        <div class="pt-2 row no-gutters">
                                            <div class="col-2 col-sm-2" style="margin-top: -2px;">
                                                <div class="mt-2 product-description-label">Charge:</div>
                                            </div>
                                            <div class="col-10 col-sm-10">
                                                <div class="product-description-label"
                                                     style="font-size: 13px;text-align: left;color: gray;">
                                                    <i class="fas fa-dot-circle " style="padding-right: 4px;"></i>ঢাকা
                                                    সিটির মধ্যে ডেলিভারি চার্জ
                                                    {{ $numto->bnNum($shipping->inside_dhaka_charge) }}
                                                    টাকা<br>
                                                    <i class="fas fa-dot-circle" style="padding-right: 4px;"></i>ঢাকা
                                                    সিটির বাইরে ডেলিভারি চার্জ
                                                    {{ $numto->bnNum($shipping->outside_dhaka_charge) }} টাকা
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center quantity-container info-container"
                                         style="border-bottom: 1px solid #dfd6d6;">
                                        <div class="pt-2 row no-gutters">
                                            <div class="mb-2 col-12 col-md-12">
                                                <a class="btn btn-success" id="formText"
                                                   href="tel:{{App\Models\Basicinfo::first()->phone_one}}"
                                                   style="width: 85%;font-size: 22px; "> কল
                                                    করুন {{App\Models\Basicinfo::first()->phone_one}}</a>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <!-- /.product-info -->
                            </div>
                            <!-- /.col-sm-7 -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.col -->
                <div class="clearfix"></div>
            </div>
            <div class="row single-product">
                <div class="p-0 col-md-12">
                    <div class="product-tabs inner-bottom-xs wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-12">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell" style="display: inline-flex;">
                                    <li class="active"><a data-bs-toggle="tab" id="istteb"
                                                          href="#description">DESCRIPTION</a></li>

                                </ul>
                                <!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-12">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane active">
                                        <div class="product-tab">
                                            <p class="text">{!! $productdetails->ProductDetails !!}</p>
                                            @if (isset($productdetails->youtube_embade))
                                                <br>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <iframe width="100%" height="315"
                                                                src="https://www.youtube.com/embed/{{ $productdetails->youtube_embade }}">
                                                        </iframe>
                                                    </div>
                                                </div>
                                            @else

                                            @endif
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->

                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell"
                                    style="display: flex;justify-content: space-between;">
                                    <li class="active"><a data-bs-toggle="tab" id="istteb" href="#review"
                                                          style="margin-top: 10px;"> See Our
                                            Products Review</a></li>
                                    <li>
                                        @auth('web')
                                        <button class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"
                                                style="margin:0px;margin-top: 10px;margin-right: 20px;"
                                                fdprocessedid="7vjbmg">Leave
                                            Review
                                        </button>
                                        @endauth
                                    </li>
                                </ul>
                                <!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-12">

                                <div class="tab-content ">
                                    <!-- /.tab-pane -->

                                    <div id="review" class="tab-pane active show">
                                        <div class="product-tab">

                                            <div class="product-reviews">

                                                <div class="row">
                                                    <div class="col-lg-7 col-12">
                                                        <div class="review" id="reviewload">
                                                            @forelse($reviews as $review) 
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="d-flex">
                                                                        <img src="https://khati.plus/public/profile-user.png"
                                                                             style="width:60px;height:60px">
                                                                        <div class="info ps-2">
                                                                            <h6 class="m-0"
                                                                                style="font-weight: bold;font-size: 18px;">
                                                                                {{$review->user->name}}</h6>
                                                                            <div class="review">
                                                                                <div class="d-flex">
                                                                                    <div class="star">
                                                                                        @if($review->rating == 1) 
                                                                                        <svg class="svg-inline--fa fa-star"
                                                                                             style="font-size: 16px;"
                                                                                             id="checked"
                                                                                             aria-hidden="true"
                                                                                             focusable="false"
                                                                                             data-prefix="fas"
                                                                                             data-icon="star" role="img"
                                                                                             xmlns="http://www.w3.org/2000/svg"
                                                                                             viewBox="0 0 576 512"
                                                                                             data-fa-i2svg="">
                                                                                            <path fill="currentColor"
                                                                                                  d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                        </svg>
                                                                                        @endif

                                                                                            @if($review->rating == 2)
                                                                                                <svg class="svg-inline--fa fa-star"
                                                                                                     style="font-size: 16px;"
                                                                                                     id="checked"
                                                                                                     aria-hidden="true"
                                                                                                     focusable="false"
                                                                                                     data-prefix="fas"
                                                                                                     data-icon="star" role="img"
                                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                                     viewBox="0 0 576 512"
                                                                                                     data-fa-i2svg="">
                                                                                                    <path fill="currentColor"
                                                                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                                </svg>
                                                                                                <svg class="svg-inline--fa fa-star"
                                                                                                     style="font-size: 16px;"
                                                                                                     id="checked"
                                                                                                     aria-hidden="true"
                                                                                                     focusable="false"
                                                                                                     data-prefix="fas"
                                                                                                     data-icon="star" role="img"
                                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                                     viewBox="0 0 576 512"
                                                                                                     data-fa-i2svg="">
                                                                                                    <path fill="currentColor"
                                                                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                                </svg>
                                                                                            @endif
                                                                                        <!-- <span class="fas fa-star" style="font-size:16px;" id="checked"></span> Font Awesome fontawesome.com -->
                                                                                            @if($review->rating == 3)
                                                                                                <svg class="svg-inline--fa fa-star"
                                                                                                     style="font-size: 16px;"
                                                                                                     id="checked"
                                                                                                     aria-hidden="true"
                                                                                                     focusable="false"
                                                                                                     data-prefix="fas"
                                                                                                     data-icon="star" role="img"
                                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                                     viewBox="0 0 576 512"
                                                                                                     data-fa-i2svg="">
                                                                                                    <path fill="currentColor"
                                                                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                                </svg>
                                                                                                <svg class="svg-inline--fa fa-star"
                                                                                                     style="font-size: 16px;"
                                                                                                     id="checked"
                                                                                                     aria-hidden="true"
                                                                                                     focusable="false"
                                                                                                     data-prefix="fas"
                                                                                                     data-icon="star" role="img"
                                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                                     viewBox="0 0 576 512"
                                                                                                     data-fa-i2svg="">
                                                                                                    <path fill="currentColor"
                                                                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                                </svg>
                                                                                                <svg class="svg-inline--fa fa-star"
                                                                                                     style="font-size: 16px;"
                                                                                                     id="checked"
                                                                                                     aria-hidden="true"
                                                                                                     focusable="false"
                                                                                                     data-prefix="fas"
                                                                                                     data-icon="star" role="img"
                                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                                     viewBox="0 0 576 512"
                                                                                                     data-fa-i2svg="">
                                                                                                    <path fill="currentColor"
                                                                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                                </svg>
                                                                                            @endif

                                                                                            @if($review->rating == 4)
                                                                                                <svg class="svg-inline--fa fa-star"
                                                                                                     style="font-size: 16px;"
                                                                                                     id="checked"
                                                                                                     aria-hidden="true"
                                                                                                     focusable="false"
                                                                                                     data-prefix="fas"
                                                                                                     data-icon="star" role="img"
                                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                                     viewBox="0 0 576 512"
                                                                                                     data-fa-i2svg="">
                                                                                                    <path fill="currentColor"
                                                                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                                </svg>
                                                                                                <svg class="svg-inline--fa fa-star"
                                                                                                     style="font-size: 16px;"
                                                                                                     id="checked"
                                                                                                     aria-hidden="true"
                                                                                                     focusable="false"
                                                                                                     data-prefix="fas"
                                                                                                     data-icon="star" role="img"
                                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                                     viewBox="0 0 576 512"
                                                                                                     data-fa-i2svg="">
                                                                                                    <path fill="currentColor"
                                                                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                                </svg>
                                                                                                <svg class="svg-inline--fa fa-star"
                                                                                                     style="font-size: 16px;"
                                                                                                     id="checked"
                                                                                                     aria-hidden="true"
                                                                                                     focusable="false"
                                                                                                     data-prefix="fas"
                                                                                                     data-icon="star" role="img"
                                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                                     viewBox="0 0 576 512"
                                                                                                     data-fa-i2svg="">
                                                                                                    <path fill="currentColor"
                                                                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                                </svg>
                                                                                                <svg class="svg-inline--fa fa-star"
                                                                                                     style="font-size: 16px;"
                                                                                                     id="checked"
                                                                                                     aria-hidden="true"
                                                                                                     focusable="false"
                                                                                                     data-prefix="fas"
                                                                                                     data-icon="star" role="img"
                                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                                     viewBox="0 0 576 512"
                                                                                                     data-fa-i2svg="">
                                                                                                    <path fill="currentColor"
                                                                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                                </svg>
                                                                                            @endif

                                                                                            @if($review->rating == 5)
                                                                                                <svg class="svg-inline--fa fa-star"
                                                                                                     style="font-size: 16px;"
                                                                                                     id="checked"
                                                                                                     aria-hidden="true"
                                                                                                     focusable="false"
                                                                                                     data-prefix="fas"
                                                                                                     data-icon="star" role="img"
                                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                                     viewBox="0 0 576 512"
                                                                                                     data-fa-i2svg="">
                                                                                                    <path fill="currentColor"
                                                                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                                </svg>
                                                                                                <svg class="svg-inline--fa fa-star"
                                                                                                     style="font-size: 16px;"
                                                                                                     id="checked"
                                                                                                     aria-hidden="true"
                                                                                                     focusable="false"
                                                                                                     data-prefix="fas"
                                                                                                     data-icon="star" role="img"
                                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                                     viewBox="0 0 576 512"
                                                                                                     data-fa-i2svg="">
                                                                                                    <path fill="currentColor"
                                                                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                                </svg>
                                                                                                <svg class="svg-inline--fa fa-star"
                                                                                                     style="font-size: 16px;"
                                                                                                     id="checked"
                                                                                                     aria-hidden="true"
                                                                                                     focusable="false"
                                                                                                     data-prefix="fas"
                                                                                                     data-icon="star" role="img"
                                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                                     viewBox="0 0 576 512"
                                                                                                     data-fa-i2svg="">
                                                                                                    <path fill="currentColor"
                                                                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                                </svg>
                                                                                                <svg class="svg-inline--fa fa-star"
                                                                                                     style="font-size: 16px;"
                                                                                                     id="checked"
                                                                                                     aria-hidden="true"
                                                                                                     focusable="false"
                                                                                                     data-prefix="fas"
                                                                                                     data-icon="star" role="img"
                                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                                     viewBox="0 0 576 512"
                                                                                                     data-fa-i2svg="">
                                                                                                    <path fill="currentColor"
                                                                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                                </svg>
                                                                                                <svg class="svg-inline--fa fa-star"
                                                                                                     style="font-size: 16px;"
                                                                                                     id="checked"
                                                                                                     aria-hidden="true"
                                                                                                     focusable="false"
                                                                                                     data-prefix="fas"
                                                                                                     data-icon="star" role="img"
                                                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                                                     viewBox="0 0 576 512"
                                                                                                     data-fa-i2svg="">
                                                                                                    <path fill="currentColor"
                                                                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                                                                </svg>
                                                                                            @endif
                                                                                        
                                                                                    </div>
                                                                                    <span style="padding-left: 10px;padding-top: 2px;">{{$review->created_at->diffForHumans()}}</span>
                                                                                </div>
                                                                                <p>
                                                                                    {{$review->messages}}
                                                                                </p>


                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                            @empty
                                                                <span class="text-center text-muted">No Review Yet</span>
                                                            @endforelse

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.reviews -->
                                            </div>

                                        </div>
                                        <!-- /.product-tab -->
                                    </div>
                                    <!-- /.tab-pane -->

                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.col -->
                        </div>
                        @guest('web')
                        <div class="row">
                            <div class="col-12">
                                <h4 class="text-center">Please <a href="{{url('/login')}}"> Login </a> to give review</h4>
                            </div>
                        </div>
                            @endguest()
                        
                        <!-- /.row -->
                    </div>
                    <!-- /.product-tabs -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title m-0">Give Rating And Review</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form name="form" method="post" action="{{ url('review/store')}}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="form-group mb-3">
                                            <div class="star">
                                                <svg class="svg-inline--fa fa-star" onclick="checked('1')" id="checked1"
                                                     aria-hidden="true" focusable="false" data-prefix="fas"
                                                     data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 576 512" data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                </svg>
                                                <!-- <span class="fas fa-star" onclick="checked('1')" id="checked1"></span> Font Awesome fontawesome.com -->
                                                <svg class="svg-inline--fa fa-star" onclick="checked('2')" id="checked2"
                                                     aria-hidden="true" focusable="false" data-prefix="fas"
                                                     data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 576 512" data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                </svg>
                                                <!-- <span class="fas fa-star" onclick="checked('2')" id="checked2"></span> Font Awesome fontawesome.com -->
                                                <svg class="svg-inline--fa fa-star" onclick="checked('3')" id="checked3"
                                                     aria-hidden="true" focusable="false" data-prefix="fas"
                                                     data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 576 512" data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                </svg>
                                                <!-- <span class="fas fa-star" onclick="checked('3')" id="checked3"></span> Font Awesome fontawesome.com -->
                                                <svg class="svg-inline--fa fa-star" onclick="checked('4')" id="checked4"
                                                     aria-hidden="true" focusable="false" data-prefix="fas"
                                                     data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 576 512" data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                </svg>
                                                <!-- <span class="fas fa-star" onclick="checked('4')" id="checked4"></span> Font Awesome fontawesome.com -->
                                                <svg class="svg-inline--fa fa-star" onclick="checked('5')" id="checked5"
                                                     aria-hidden="true" focusable="false" data-prefix="fas"
                                                     data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 576 512" data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                          d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                </svg>
                                                <!-- <span class="fas fa-star" onclick="checked('5')" id="checked5"></span> Font Awesome fontawesome.com -->
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$productdetails->id}}" name="product_id"
                                               id="product_id">
                                        <div class="form-group mb-3">
                                            <label for="floatingInput">Message</label>
                                            <textarea class="form-group" name="messages" id="messages"></textarea>
                                        </div>
                                        <input type="hidden" name="rating" id="rating" required>
                                        <div class="mt-4 mb-4">
                                            <input class="form-control form-control-lg" name="file" id="file"
                                                   type="file">
                                        </div>
                                        <br>
                                        <div class="form-group mt-2" style="text-align: right">
                                            <div class="submitBtnSCourse">
                                                <button type="submit" name="btn" data-bs-dismiss="modal"
                                                        class="btn btn-dark btn-block" style="float: left">Close
                                                </button>
                                                <button type="submit" name="btn"
                                                        class="btn btn-primary AddCourierBtn btn-block">Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                    <section class="pb-2 section featured-product wow fadeInUp" style="margin-bottom:0px !important">
                        <h3 class="section-title" style="padding: 8px;margin-bottom: 0;">Related
                            products</h3>
                        <div class="owl-carousel related-owl-carousel featured-carousel owl-theme outer-top-xs"
                             id="relatedCarousel">
                            @forelse ($relatedproducts as $relatedproduct)

                                <div class="mb-2 col-sm-12 col-xs-12 padding-zero product-hover-effect"
                                     style="background-color: #fff;padding: 0px;box-shadow: 0px 1px 12px 4px #efefef;border-radius: 6px;">
                                    <a style="padding: 0px;overflow: hidden;"
                                       class="img-hover col-sm-12 padding-zero image_thum"
                                       href="{{ url('product/' . $relatedproduct->ProductSlug) }}" id="374">
                                        <img class="img-fluid" style="margin: 0 auto;padding:5px; height: 175px"
                                             src="{{ asset($relatedproduct->ViewProductImage) }}">
                                    </a>
                                    <div class="col-sm-12 col-xs-12 product__item"
                                         style="border-radius:0px 0px 6px 6px">
                                    <span id="productName374"
                                          class="text-center col-sm-12">{{$relatedproduct->ProductName}}</span>
                                        @if(count($relatedproduct->weights)>0)

                                            <span id="productPrice374" class="text-center col-sm-12 col-xs-12" style="">
                                                Tk. {{ round($relatedproduct->weights[0]->productSalePrice) }}   </span>
                                        @else
                                            <span id="productPrice374" class="text-center col-sm-12 col-xs-12" style="">
                                                Tk. {{round($relatedproduct->ProductSalePrice)}}   </span>

                                        @endif

                                    </div>
                                </div>

                            @empty
                            @endforelse
                        </div>
                        <!-- /.home-owl-carousel -->
                    </section>
                    <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

                </div>
            </div>
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

        <script>
            function plus() {
                var avqty = $('#qtyval').val();
                if (avqty == 10) {

                } else {
                    qty = Number(avqty) + 1;
                    $('#qtyval').val(qty);
                    $('#qtyor').val(qty);
                    $('#qtyoror').val(qty);
                    $('#qtyad').val(qty);
                }
            }


            function minus() {
                var avqty = $('#qtyval').val();
                if (avqty == 1) {

                } else {
                    qty = Number(avqty) - 1;
                    $('#qtyval').val(qty);
                    $('#qtyor').val(qty);
                    $('#qtyoror').val(qty);
                    $('#qtyad').val(qty);
                }
            }



            $(document).ready(function () {

                var sync1 = $("#sync1");
                var sync2 = $("#sync2");
                var slidesPerPage = 4; //globaly define number of elements per page
                var syncedSecondary = true;

                sync1.owlCarousel({
                    items: 1,
                    slideSpeed: 2000,
                    autoplay: true,
                    dots: false,
                    loop: true,
                    responsiveRefreshRate: 200,
                    navText: [
                        '<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
                        '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'
                    ],
                }).on('changed.owl.carousel', syncPosition);

                sync2
                    .on('initialized.owl.carousel', function () {
                        sync2.find(".owl-item").eq(0).addClass("current");
                    })
                    .owlCarousel({
                        margin: 6,
                        items: slidesPerPage,
                        dots: false,
                        nav: true,
                        smartSpeed: 200,
                        slideSpeed: 500,
                        slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                        responsiveRefreshRate: 100
                    }).on('changed.owl.carousel', syncPosition2);

                function syncPosition(el) {
                    //if you set loop to false, you have to restore this next line
                    //var current = el.item.index;

                    //if you disable loop you have to comment this block
                    var count = el.item.count - 1;
                    var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                    if (current < 0) {
                        current = count;
                    }
                    if (current > count) {
                        current = 0;
                    }

                    //end block

                    sync2
                        .find(".owl-item")
                        .removeClass("current")
                        .eq(current)
                        .addClass("current");
                    var onscreen = sync2.find('.owl-item.active').length - 1;
                    var start = sync2.find('.owl-item.active').first().index();
                    var end = sync2.find('.owl-item.active').last().index();

                    if (current > end) {
                        sync2.data('owl.carousel').to(current, 100, true);
                    }
                    if (current < start) {
                        sync2.data('owl.carousel').to(current - onscreen, 100, true);
                    }
                }

                function syncPosition2(el) {
                    if (syncedSecondary) {
                        var number = el.item.index;
                        sync1.data('owl.carousel').to(number, 100, true);
                    }
                }

                sync2.on("click", ".owl-item", function (e) {
                    e.preventDefault();
                    var number = $(this).index();
                    sync1.data('owl.carousel').to(number, 300, true);
                });


                $('#AddToCartForm').submit(function (e) {
                    e.preventDefault();
                    $('#processing').css({
                        'display': 'flex',
                        'justify-content': 'center',
                        'align-items': 'center'
                    })
                    $('#processing').modal('show');
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('add-to-cart') }}',
                        processData: false,
                        contentType: false,
                        data: new FormData(this),

                        success: function (data) {
                            updatecart();
                            $.ajax({
                                type: 'GET',
                                url: '{{ url('get-cart-content') }}',

                                success: function (response) {
                                    $('#cartViewModal .modal-body').empty().append(
                                        response);
                                },
                                error: function (error) {
                                    console.log('error');
                                }
                            });
                            $('#processing').modal('hide');
                            $('#cartViewModal').modal('show');
                        },
                        error: function (error) {
                            console.log('error');
                        }
                    });
                });

                $('#OrderNow').submit(function (e) {
                    e.preventDefault();
                    $('#processing').css({
                        'display': 'flex',
                        'justify-content': 'center',
                        'align-items': 'center'
                    })
                    $('#processing').modal('show');
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('add-to-cart') }}',
                        processData: false,
                        contentType: false,
                        data: new FormData(this),

                        success: function (data) {
                            updatecart();
                            if (data == 'success') {
                                window.location.href = 'https://arishatex.com/checkout';
                                $('#processing').modal('hide');
                            }
                        },
                        error: function (error) {
                            console.log('error');
                        }
                    });
                });


                // document.getElementById("istteb").click();
                $('#owl-single-product').owlCarousel({
                    items: 1,
                    itemsTablet: [768, 1],
                    itemsDesktop: [1199, 1],
                    autoplay: true,
                    loop: true,
                    autoplayTimeout: 1000,
                    autoplayHoverPause: true,
                    responsiveClass: true,
                    dots: true,

                });
                $('#relatedCarousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    autoplay: true,
                    autoplayTimeout: 1000,
                    autoplayHoverPause: true,
                    responsiveClass: true,
                    nav: true,
                    dots: false,
                    responsive: {
                        0: {
                            items: 2,
                        },
                        600: {
                            items: 3,
                        },
                        1000: {
                            items: 6,
                        }
                    }
                });
                $('#featuredCarousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    autoplay: true,
                    autoplayTimeout: 1000,
                    autoplayHoverPause: true,
                    responsiveClass: true,
                    nav: true,
                    dots: false,
                    responsive: {
                        0: {
                            items: 2,
                        },
                        600: {
                            items: 2,
                        },
                        1000: {
                            items: 6,
                        }
                    }
                });

                $('#BestSelling').owlCarousel({
                    loop: true,
                    margin: 10,
                    autoplay: true,
                    autoplayTimeout: 1000,
                    autoplayHoverPause: true,
                    responsiveClass: true,
                    dots: false,
                    nav: true,
                    responsive: {
                        0: {
                            items: 2,
                        },
                        600: {
                            items: 2,
                        },
                        1000: {
                            items: 6,
                        }
                    }
                });


            });

            function getcolor(color) {
                $('#product_color').val(color);

                $('#product_colorOr').val(color);

                $('.colortext').css('color', '#000');
                $('.colortext').css('background', '#fff');
                $('#colortext' + color).css('color', '#fff');
                $('#colortext' + color).css('background', '#613EEA');
            }

            function getsize(size) {
                $('#product_size').val(size);
                $('#product_sizeOr').val(size);

                $('.sizetext').css('color', '#000');
                $('.sizetext').css('background', '#fff');
                $('#sizetext' + size).css('color', '#fff');
                $('#sizetext' + size).css('background', '#613EEA');
            }

            function encodeID(id) {
                return id.replace(/[^a-zA-Z0-9]/g, '_');
            }

            function getWeight(weight) {
                var encodeWeight = encodeID(weight);
                $.ajax({
                    type: 'GET',
                    url: '{{ url('/get/price-by-weight') }}',
                    data: {
                        _token: token,
                        product_id: $('#pID').val(),
                        karats: weight
                    },
                    success: function (res) {
                        var html = []; // Initialize an array to hold the HTML strings
                        console.log(res);
                        

                        // Correctly declare the title variable
                        var title = `<h4 id="weight_title" class="m-0"><b style="font-size:20px">ওজন:&nbsp;&nbsp;&nbsp;</b></h4>`;
                        
                        res.forEach(function(item) {
                            // Push each generated HTML block to the array
                            html.push(`
                                <div class="weightinfo">
                                    <input type="radio" class="m-0" hidden
                                        id="sizeWeight${item.weight_name}"
                                        name="weight"
                                        onclick="getPrice('${item.weight_name}','${item.karats}')"/>
                                    <label class="weighttext ms-0"
                                        id="weightText${item.weight_name}"
                                        for="sizeWeight${item.weight_name}"
                                        style="border: 1px solid #613EEA; font-size: 20px; font-weight: bold; padding: 0px 12px; border-radius: 4px;">
                                        ${item.weight_name}
                                    </label>
                                </div>
                            `);
                        });
                        // Join the array into a single string and set it as the HTML of the container
                        $('.weightsList').html(title + html.join(''));
                    },
                    error: function (error) {
                        console.log('error');
                    }
                });
            }
            function getPrice(weight, karats) {
                $.ajax({
                    type: 'GET', 
                    url: '{{ url('/get/price-by-karats') }}', 
                    data: {
                        _token: '{{ csrf_token() }}', 
                        weight: weight, 
                        karats: karats,
                    },
                    success: function(res) {
                        $('#pSalePrice').text('৳ ' + res.regularPrice);
                        $('#pRegularPrice').text('৳ ' + res.regularPrice);
            
                        $('#orderProductPrice').val(res.regularPrice);
                        $('#cartProductPrice').val(res.regularPrice);
            
                        $('#product_weight').val(res.weight);
                        $('#product_weightOr').val(res.weight);
                        
                        $('#product_karats').val(res.karats);
                        $('#product_karatsOr').val(res.karats);

                        // $('.weighttext').css('color', '#000');
                        // $('.weighttext').css('background', '#fff');
            
                        // $('#weightText' + weight).css('color', '#fff');
                        // $('#weightText' + weight).css('background', '#613EEA');
                    },
                    error: function(error) {
                        console.log('Error fetching price:', error);
                    }
                });
            }




            // console.log(weight);

            // console.log('Styles applied to:', '#weightText' + weight);
            // console.log('Color:', $('#weightText' + weight).css('#fff'));
            // console.log('Background:', $('#weightText' + weight).css('#613EEA'));


            function checked(id) {
                if (id == 1) {
                    $('#checked' + id).css('color', 'orange');
                    $('#checked2').css('color', 'black');
                    $('#checked3').css('color', 'black');
                    $('#checked4').css('color', 'black');
                    $('#checked5').css('color', 'black');
                } else if (id == 2) {
                    $('#checked1').css('color', 'orange');
                    $('#checked' + id).css('color', 'orange');
                    $('#checked3').css('color', 'black');
                    $('#checked4').css('color', 'black');
                    $('#checked5').css('color', 'black');
                } else if (id == 3) {
                    $('#checked1').css('color', 'orange');
                    $('#checked2').css('color', 'orange');
                    $('#checked' + id).css('color', 'orange');
                    $('#checked4').css('color', 'black');
                    $('#checked5').css('color', 'black');
                } else if (id == 4) {
                    $('#checked1').css('color', 'orange');
                    $('#checked2').css('color', 'orange');
                    $('#checked3').css('color', 'orange');
                    $('#checked' + id).css('color', 'orange');
                    $('#checked5').css('color', 'black');
                } else if (id == 5) {
                    $('#checked1').css('color', 'orange');
                    $('#checked2').css('color', 'orange');
                    $('#checked3').css('color', 'orange');
                    $('#checked4').css('color', 'orange');
                    $('#checked' + id).css('color', 'orange');
                } else {

                }

                $('#rating').val(id);
            }


            $('#AddReview').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '{{url('/review/store')}}',
                    processData: false,
                    contentType: false,
                    data: new FormData(this),

                    success: function (data) {
                        swal({
                            title: "Success!",
                            icon: "success",
                        });
                    },
                    error: function (error) {
                        console.log('error');
                    }
                });

            });


        </script>

@endsection
