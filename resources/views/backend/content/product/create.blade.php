@extends('backend.master')

@section('maincontent')
    @section('title')
        {{ env('APP_NAME') }}- Products
    @endsection

    <style>
        div#roleinfo_length {
            color: red;
        }

        div#roleinfo_filter {
            color: red;
        }

        div#roleinfo_info {
            color: red;
        }
    </style>
    {{-- summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <div class="container-fluid pt-4 px-4 pb-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xl-12">
                <div class="h-100 bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-center">
                        <h4 class="mb-0 mt-0 p-3 text-center">Add New Products</h4>
                    </div>
                </div>
            </div>


            <div class="container p-4">
                <form name="form" id="AddProduct" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>

                            <div class="form-group mb-3">
                                <label for="ProductName">Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="ProductName" id="ProductName" class="form-control"
                                       required>
                            </div>

                            {{--                                        <div class="row">--}}
                            {{--                                            <div class="col-6">--}}
                            {{--                                                <div class="form-group mb-3">--}}
                            {{--                                                    <label for="ProductSalePrice">Sale Price <span--}}
                            {{--                                                                class="text-danger">*</span></label>--}}
                            {{--                                                    <input type="number" id="ProductSalePrice"--}}
                            {{--                                                           name="ProductSalePrice" class="form-control">--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="col-6">--}}
                            {{--                                                <div class="form-group mb-3">--}}
                            {{--                                                    <label for="ProductSalePrice">Regular Price <span--}}
                            {{--                                                                class="text-danger">*</span></label>--}}
                            {{--                                                    <input type="number" id="ProductRegularPrice" name="ProductRegularPrice"--}}
                            {{--                                                           class="form-control" >--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            <div class="row">
                                {{--                                            <div class="col-6">--}}
                                {{--                                                <div class="form-group mb-3">--}}
                                {{--                                                    <label for="ProductSalePrice">Discount (%) </label>--}}
                                {{--                                                    <input type="number" id="Discount" name="Discount"--}}
                                {{--                                                           class="form-control" readonly >--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="ProductCategory" style="width: 100%;">Brand Name </label>
                                        <select class="form-control" id="brand_id" style="background: black;"
                                                name="brand_id">
                                            <option>Select Brands</option>
                                            @forelse ($brands as $brand)
                                                <option value="{{ $brand->id }}">
                                                    {{ $brand->brand_name }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="ProductCategory" style="width: 100%;">Categories <span
                                                    class="text-danger">*</span></label>
                                        <select class="form-control" id="category_id" style="background: black;"
                                                name="category_id" onchange="setsubcategory()" required>
                                            <option>Select Category</option>
                                            @forelse ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->category_name }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="ProductCategory" style="width: 100%">Sub Category <span
                                                    class="text-danger">*</span></label>
                                        <select class="form-control" id="sub_category_id"
                                                style="background: black;" name="subcategory_id">
                                            <option>Select Sub-Category</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3" style="width: 50%">
                             <label for="preorder_status" > PreOrder Status *</label>
                                <select class="form-control" id="preorder_status"
                                        style="background: black;" name="preorder_status">
                                    <option  value="1">Active</option>
                                    <option selected value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="ProductRegularPrice">Product Short Description <span
                                            class="text-danger">*</span></label>
                                <textarea class="form-control" name="ProductBreaf" rows="2"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="ProductDetailsss">Product Description <span
                                            class="text-danger">*</span></label>
                                <textarea class="form-control" id="ProductDetails" name="ProductDetails"
                                          rows="5"></textarea>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $('#ProductDetails').summernote();
                                });
                            </script>

                        </div>

                        <div class="col-lg-12">


                            <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Product Images</h5>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="ProductSalePrice">Youtube Embade Code</label>
                                        <input type="text" id="youtube_embade" name="youtube_embade"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="ProductDetails">Product Image <span
                                                    class="text-danger">*</span></label>
                                        <button type="button" class="btn btn-danger d-block mb-2"
                                                style="background: red">
                                            <input type="file" name="ProductImage" id="ProductImage"
                                                   onchange="loadFile(event)">
                                        </button>
                                        <div class="single-image image-holder-wrapper clearfix">
                                            <div class="image-holder placeholder">
                                                <img id="prevImage" style="height:100px;width:100%"/>
                                                <i class="mdi mdi-folder-image"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <div class="form-group"
                                         style="padding: 10px;padding-top: 3px;margin:0;padding-bottom:3px;width:96%;margin-left: 8px;border-radius: 8px;padding-left: 0;margin-left: -0;">
                                        <label class="fileContainer">
                                                    <span style="font-size: 20px;">Product Slider
                                                        image</span>
                                        </label>
                                        <br>
                                        <button type="button" class="btn btn-danger d-block mb-2"
                                                style="background: red">
                                            <input type="file" onchange="prevPost_Img()"
                                                   name="PostImage[]" id="PostImage" multiple>
                                        </button>
                                    </div>
                                    <div class="file">
                                        <div id="prevFile"
                                             style="width: 100%;float:left;background: lightgray;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Product Variants</h5>

                            <div class="row">
                                {{--                                            <div class="col-12">--}}
                                {{--                                                <div class="form-group mb-3">--}}
                                {{--                                                    <label for="ProductRegularPrice">Colour--}}
                                {{--                                                        <span class="text-danger">*</span></label>--}}
                                {{--                                                    <br>--}}
                                {{--                                                    @forelse ($colors as $color)--}}
                                {{--                                                        <input type="checkbox" name="color[]"--}}
                                {{--                                                               value="{{ $color->value }}">--}}
                                {{--                                                        {{ $color->value }} &nbsp;--}}
                                {{--                                                    @empty--}}
                                {{--                                                    @endforelse--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="col-12">--}}
                                {{--                                                <div class="form-group mb-3">--}}
                                {{--                                                    <label for="ProductSalePrice">Size <span--}}
                                {{--                                                                class="text-danger">*</span></label>--}}
                                {{--                                                    <br>--}}
                                {{--                                                    @forelse ($sizes as $size)--}}
                                {{--                                                        <input type="checkbox" name="size[]"--}}
                                {{--                                                               value="{{ $size->value }}">--}}
                                {{--                                                        {{ $size->value }} &nbsp;--}}
                                {{--                                                    @empty--}}
                                {{--                                                    @endforelse--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}


                            </div>

                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Product Weight</strong>
                                </div>
                                <div class="card-body">
                                    <table id="productTable" style="width: 100% !important;"
                                           class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Weight</th>
                                            <th>Karats</th>
                                            <th>Making Cost ({{ App\Models\Basicinfo::where('id' , 1)->first()->cost }})</th>
                                            <th>Gold Price</th>
                                            <th>Sale Price</th>
                                            <th>Regular Price</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="8">
                                                <select class="form-control" id="productID" style="width: 100%;"
                                                        required>
                                                    <option value="">Select Weight</option>
                                                </select>
                                            </td>
                                        </tr>
                                        </tfoot>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-uppercase mt-3 mb-3 bg-light p-2">Meta Information</h5>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="meta_title" id="meta_title"
                                           placeholder="Meta Title">
                                    <label for="floatingInput">Meta Title</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <textarea type="text" class="form-control" name="meta_desc" id="meta_desc"
                                              placeholder="meta_desc"></textarea>
                                    <label for="meta_desc">Meta Description</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <textarea type="text" class="form-control" name="meta_keyword" id="meta_keyword"
                                              placeholder="meta_keyword"></textarea>
                                    <label for="meta_keyword">Meta Keywords</label>
                                </div>

                                <div class="mt-4 mb-4">
                                    <input class="form-control form-control-lg bg-dark" name="meta_image"
                                           id="meta_image" type="file">
                                </div>
                                <div class="m-3 ms-0 mb-0"
                                     style="text-align: center;height: 100px;margin-top:20px !important">
                                    <h4 style="width:30%;float: left;text-align: left;">Icon : </h4>
                                    <div id="previmg2" style="float: left;"></div>
                                </div>
                                <br>

                            </div>
                            </div>

                        </div>
                        <br>
                        <div class="form-group mt-2" style="text-align: right">
                            <div class="submitBtnSCourse">

                                <button type="submit" name="btn"
                                        class="btn btn-primary btn-block">Save
                                </button>
                            </div>
                        </div>
                </form>
            </div>
            {{-- Create New Product Modal Ends --}}


        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>

        $(document).ready(function () {
            $('#ProductSalePrice, #ProductRegularPrice').on('input', function () {
                var salePrice = parseFloat($('#ProductSalePrice').val());
                var regularPrice = parseFloat($('#ProductRegularPrice').val());

                if (!isNaN(salePrice) && !isNaN(regularPrice) && regularPrice !== 0) {
                    var discountPercentage = Math.round(((regularPrice - salePrice) / regularPrice) * 100);
                    $('#Discount').val(discountPercentage);
                } else {
                    $('#Discount').val('');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            var token = $("input[name='_token']").val();

            //add Product

            $('#AddProduct').submit(function (e) {
                e.preventDefault();

                var product = [];
                var productCount = 0;
                $("#productTable tbody tr").each(function (index, value) {
                    var currentRow = $(this);
                    var obj = {};
                    obj.attrValueId = currentRow.find(".attrValueId").text();
                    obj.productWeight = currentRow.find(".productWeight").text();
                    obj.productKarat = currentRow.find(".productKarat").text();
                    obj.productRegularPrice = currentRow.find(".productRegularPrice").val();
                    obj.productSalePrice = currentRow.find(".productSalePrice").val();
                    obj.total_qty = currentRow.find(".total_qty").val();
                    product.push(obj);
                    productCount++;
                });

                // var data = {};
                // data["products"] = product;

                // Collect form data
                var formData = new FormData(this);

                // Example: Appending product data
                formData.append('product', JSON.stringify(product));


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{url('admin/products')}}",
                    processData: false,
                    contentType: false,
                    data: formData,


                    success: function (data) {
                        $('#ProductName').val("");
                        $('#ProductSalePrice').val("");
                        $('#Discount').val("");
                        $('#ProductImage').val("");
                        $('#prevFile').html("src", '');
                        $('#PostImage').val("");
                        $('#prevFile').html("src", '');

                        swal({
                            title: "Success!",
                            icon: "success",
                        });

                        window.location.href = "{{url('admin/products')}}";

                    },
                    error: function (error) {
                        console.log('error');
                    }
                });
            });

            // On click Select Weight
            $("#productID").select2({
                placeholder: "Select Weight",
                templateResult: function (state) {
                    if (!state.id) {
                        return state.text;
                    }
                    var $state = $(
                       '<span>' + state.karat + ' (' + state.text + 'gm)' + "</span>"
                    );
                    return $state;
                },
                ajax: {
                    type: 'GET',
                    url: '{{url('admin/weight-info')}}',
                    processResults: function (data) {
                        // var data = $.parseJSON(data);
                        return {
                            results: data
                        };
                    }
                }
            }).trigger("change").on("select2:select", function (e) {

                var basicInfo = @json($basicInfo);
                var goldPrice = (basicInfo[e.params.data.karat] * e.params.data.text).toFixed(2); // Two decimal places
                var cost = ((goldPrice / 100) * basicInfo['cost']).toFixed(2); // Two decimal places
                var salePrice = (parseFloat(cost) + parseFloat(goldPrice)).toFixed(2); // Two decimal places
                var regularPrice = (parseFloat(salePrice) + (parseFloat(salePrice) / 100 * 5)).toFixed(2); // Two decimal places 

                $("#productTable tbody").append(
                    "<tr>" +
                    '<td><span class="attrValueId">' + e.params.data.id + '</span></td>' +
                    '<td><span class="productWeight">' + e.params.data.text + '</span><span>gm</span></td>' +
                    '<td><span class="productKarat">' + e.params.data.karat + '</span></td>' +
                    '<td><input type="number" class="cost form-control" style="width:100px;" value="'+ cost +'" readonly></td>' +
                    '<td><input type="number" class="goldPrice form-control" style="width:120px;" value="'+ goldPrice +'" readonly></td>' +
                    '<td><input type="number" class="productSalePrice form-control" style="width:120px;" value="'+ salePrice +'" readonly></td>'+
                    '<td><input type="number" class="productRegularPrice form-control" style="width:120px;" value="'+ regularPrice +'" readonly></td>'+
                    '<td><input type="number" class="total_qty form-control" style="width:100px;" value="1" ></td>' +


                    '<td><button class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>\n' +
                    "</tr>"
                );

            });

            //    Delete Button
            $(document).on("click", ".delete-btn", function () {
                $(this).closest("tr").remove();

            });

        });
    </script>

    <script type="text/javascript">
        function setsubcategory() {
            var sub_id = $('#category_id').val();
            $.ajax({
                type: 'GET',
                url: 'get/subcategory/' + sub_id,

                success: function (data) {
                    $('#sub_category_id').html('');

                    for (var i = 0; i < data.length; i++) {
                        $('#sub_category_id').append(`
                            <option value="` + data[i].id + `" >` + data[i].sub_category_name + `</option>
                        `)
                    }
                },
                error: function (error) {
                    console.log('error');
                }
            });
        }

        function editsetsubcategory() {
            var sub_id = $('#editcategory_id').val();
            $.ajax({
                type: 'GET',
                url: 'get/subcategory/' + sub_id,

                success: function (data) {
                    $('#editsub_category_id').html('');

                    for (var i = 0; i < data.length; i++) {
                        $('#editsub_category_id').append(`
                            <option value="` + data[i].id + `" >` + data[i].sub_category_name + `</option>
                        `)
                    }
                },
                error: function (error) {
                    console.log('error');
                }
            });
        }
    </script>
    <script>
        var loadFile = function (event) {
            var output = document.getElementById('prevImage');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        var galleryloadFile = function (event) {
            // document.getElementById("previmg").style.display = "none";
            var output = document.getElementById('galleryprevImage');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        var editloadFile = function (event) {
            $('#previmg').html('');
            var output = document.getElementById('editprevImage');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        var editgalleryloadFile = function (event) {
            // document.getElementById("previmg").style.display = "none";
            var output = document.getElementById('editgalleryprevImage');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>


    <script>
        var PostImages = [];

        function prevPost_Img() {
            var PostImage = document.getElementById('PostImage').files;

            for (i = 0; i < PostImage.length; i++) {
                if (check_duplicate(PostImage[i].name)) {
                    PostImages.push({
                        "name": PostImage[i].name,
                        "url": URL.createObjectURL(PostImage[i]),
                        "file": PostImage[i],
                    });
                } else {
                    alert(PostImage[i].name + 'is already added to your list');
                }
            }

            document.getElementById("prevFile").innerHTML = PostImage_show();

        }

        function check_duplicate(name) {
            var PostImage = true;
            if (PostImages.length > 0) {
                for (e = 0; e < PostImages.length; e++) {
                    if (PostImages[e].name == name) {
                        PostImage = false;
                        break;
                    }
                }
            }
            return PostImage;
        }

        function PostImage_show() {
            var PostImage = "";
            PostImages.forEach((i) => {
                PostImage += `<div class="postImg" style="width:25%;float:left;position:relative;">
                                <img src="` + i.url + `" alt="" id="previewImage" style="border-radius: 10px;width:100%;padding:5px;">
                                <span onclick="removeSelectedPostImage(` + PostImages.indexOf(i) + `)" style="position: absolute;right: 0;cursor: pointer;font-size: 31px;color: red;margin-top: -8px;margin-right: 8px;">&times</span>
                            </div>`;
            })
            return PostImage;
        }

        function removeSelectedPostImage(e) {
            PostImages.splice(e, 1);
            document.getElementById("prevFile").innerHTML = PostImage_show();
        }

        var editPostImages = [];

        function editprevPost_Img() {
            $('#viewprevFile').html('');
            var editPostImage = document.getElementById('editPostImage').files;

            for (i = 0; i < editPostImage.length; i++) {
                if (check_duplicate(editPostImage[i].name)) {
                    editPostImages.push({
                        "name": editPostImage[i].name,
                        "url": URL.createObjectURL(editPostImage[i]),
                        "file": editPostImage[i],
                    });
                } else {
                    alert(editPostImage[i].name + 'is already added to your list');
                }
            }

            document.getElementById("editprevFile").innerHTML = editPostImage_show();

        }

        function check_duplicate(name) {
            var editPostImage = true;
            if (editPostImages.length > 0) {
                for (e = 0; e < editPostImages.length; e++) {
                    if (editPostImages[e].name == name) {
                        editPostImage = false;
                        break;
                    }
                }
            }
            return editPostImage;
        }

        function editPostImage_show() {
            var editPostImage = "";
            editPostImages.forEach((i) => {
                editPostImage += `<div class="postImg" style="width:25%;float:left;position:relative;">
                                <img src="` + i.url + `" alt="" id="previewImage" style="border-radius: 10px;width:100%;padding:5px;">
                                <span onclick="removeSelectededitPostImage(` + editPostImages.indexOf(i) + `)" style="position: absolute;right: 0;cursor: pointer;font-size: 31px;color: red;margin-top: -8px;margin-right: 8px;">&times</span>
                            </div>`;
            })
            return editPostImage;
        }

        function removeSelectededitPostImage(e) {
            editPostImages.splice(e, 1);
            document.getElementById("editprevFile").innerHTML = editPostImage_show();
        }
    </script>
    <!-- summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

@endsection
