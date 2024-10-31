@php
    $basicInfo = App\Models\Basicinfo::where('id' , 1)->first();
    $weight = App\Models\Weight::where('product_id' , $price->id)->first();
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


    <span id="productPrice374" class="text-center col-sm-12 col-xs-12" style=""> Tk. {{ $salePrice }} </span>