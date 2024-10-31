@extends('admin.master')

@section('maincontent')
@section('subcss')
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/jquery-datatables-checkboxes@1.2.13/css/dataTables.checkboxes.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
<?php
use App\Models\Admin;
use App\Models\Courier;
$admin = Admin::where('email', Auth::guard('admin')->user()->email)->first();
$users = Admin::whereHas('roles', function ($q) {
    $q->where('name', 'user');
})
    ->where('status', 'Active')
    ->inRandomOrder()
    ->get();
$couriers = Courier::where('status', 'Active')->get();
?>
<main id="main" class="main">

    <div class="pagetitle row">
        <div class="col-6">
            <h1><a href="{{ url('/admindashboard') }}">Dashboard</a></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admindashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Barcode Order</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <div class="row">

    </div>

    {{-- //popup modal for edit user --}}
    <div class="modal" id="editmainOrder">
        <div class="modal-dialog" style="width: 92%;max-width: none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">



                </div>

            </div>
        </div>
    </div><!-- End popup Modal-->

    {{-- //table section for category --}}

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @if ($message = Session::get('error'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert" style="color: red">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body pt-4 pb-2">
                        <div class="row">
                            <div class="col-3">
                                <h4><a href="">Total <span class="total">0</span> Orders </a></h4>
                            </div>
                            <div class="col-9" style="text-align: right">
                                @if ($admin->hasRole('user'))
                                @else
                                    @if (last(request()->segments()) == 'Checked Invoiced')
                                        <form method="POST" action="{{ route('file-export') }}"
                                            enctype="multipart/form-data" style="width: 18%;float: left;">
                                            @csrf
                                            <input type="text" id="courier_id" name="cour_Id" hidden>
                                            <button type="submit" class="btn btn-info download-excel-btn btn-sm">
                                                <i class="fas fa-print mr-1"></i> Download Excel
                                            </button>
                                        </form>
                                    @else
                                    @endif
                                @endif

                                @if (last(request()->segments()) == 'Checked Invoiced')
                                    <button type="button" class="btn btn-warning order-print-btn btn-sm">
                                        <i class="fas fa-print mr-1"></i> Invoice Print
                                    </button>
                                @else
                                @endif
                                @if ($admin->hasRole('user'))
                                    <a href="{{ url('admin/create/order') }}" class="btn btn-primary btn-sm"><span
                                            style="font-weight: bold;">+</span> Add New Order</a>
                                @else
                                @endif

                                @if ($admin->hasRole('user'))
                                @else
                                    <!--<button type="button" class="btn btn-danger btn-sm " id="delete_selected_order"><i class="fas fa-trash mr-1"></i>  Delete Order</button>-->
                                    <div class="btn-group dropdown">
                                        <a href="javascript: void(0);" style="color: white"
                                            class="table-action-btn dropdown-toggle arrow-none btn bg-success btn-sm"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="fas fa-user-check mr-1"></i> Assign User</a>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            @foreach ($users as $user)
                                                <a class="dropdown-item assign-user" data-id="{{ $user->id }}"
                                                    href="#">{{ $user->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="btn-group dropdown">
                                        <a href="javascript: void(0);" style="color: white"
                                            class="table-action-btn dropdown-toggle arrow-none btn bg-info btn-sm"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="fas fa-thumbtack mr-1"></i> Change Courier</a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @foreach ($couriers as $courier)
                                                <a class="dropdown-item btn-change-courier"
                                                    data-courierid="{{ $courier->id }}"
                                                    href="#">{{ $courier->courierName }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="btn-group dropdown">
                                        <a href="javascript: void(0);" style="color: white"
                                            class="table-action-btn dropdown-toggle arrow-none btn bg-info btn-sm"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="fas fa-thumbtack mr-1"></i> Change Status</a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item btn-change-status" data-status="Pending Invoiced"
                                                href="#">Pending Invoiced</a>
                                            <a class="dropdown-item btn-change-status" data-status="Checked Invoiced"
                                                href="#">Checked Invoiced</a>
                                            <a class="dropdown-item btn-change-status" data-status="Invoiced"
                                                href="#">Invoiced</a>
                                            <a class="dropdown-item btn-change-status" data-status="Stock Out"
                                                href="#">Stock Out</a>
                                            <a class="dropdown-item btn-change-status" data-status="Delivered"
                                                href="#">Delivered</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if (\Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ \Session::get('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table table-centered table-borderless table-hover mb-0" id="orderinfo"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Invoice ID</th>
                                        <th>Name</th>
                                        <th>Products</th>
                                        <th>Total</th>
                                        <th>Courier</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        @if ($admin->hasRole('user'))
                                            <th style="width: 133px;">Notes</th>
                                        @elseif($admin->hasrole('superadmin') || $admin->hasrole('manager') || $admin->hasrole('admin'))
                                            <th style="width: 133px;">Notes</th>
                                            <th style="width: 133px;">User</th>
                                        @else
                                        @endif
                                        <th class="hidden-sm">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
    {{-- //user role --}}
    @if ($admin->hasrole('user'))
        <input type="text" id="user_role" value="0" hidden>
    @else
        <input type="text" id="user_role" value="1" hidden>
    @endif

    @if (empty($status))
    @else
        <input type="text" id="orderstatus" value="{{ $status }}" hidden>
    @endif
</main>

@section('subscript')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-datatables-checkboxes@1.2.13/js/dataTables.checkboxes.min.js"></script>
@endsection
<script>
    $(document).ready(function() {
        var orderstatus = $('#orderstatus').val();
        var user_role = $('#user_role').val();

        if (user_role == 0) {
            var orderinfotbl = $('#orderinfo').DataTable({
                ajax: {
                    url: "{{ url('admin/orderbysearch') }}",
                },
                ordering: false,
                processing: true,
                serverSide: true,
                pageLength: 30,
                columnDefs: [{
                    targets: 0,
                    checkboxes: {
                        selectRow: false,
                    },
                }, ],

                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'invoice',
                        width: "15%"
                    },
                    {
                        data: 'customerInfo',
                        width: "25%",
                        className: "customerInfo"
                    },
                    {
                        data: "products",
                        width: "15%",
                    },
                    {
                        data: "subTotal",
                        width: "5%"
                    },
                    {
                        data: "courier",
                        width: "20%",
                    },
                    {
                        data: "orderDate",
                        width: "20%"
                    },
                    {
                        data: 'statusButton',
                        width: "10%"
                    },
                    {
                        data: 'notification',
                        width: "15%"
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ],

                footerCallback: function() {
                    var api = this.api();
                    var numRows = api.rows().count();
                    $('.total').empty().append(numRows);

                    var intVal = function(i) {
                        return typeof i === "string" ? i.replace(/[\$,]/g, "") * 1 :
                            typeof i === "number" ? i : 0;
                    };
                    pageTotal = api.column(4, {
                        page: "current"
                    }).data().reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                    $(api.column(4).footer()).html(pageTotal + " Tk");
                }

            });
        } else {

            var orderinfotbl = $('#orderinfo').DataTable({
                ajax: {
                    url: "{{ url('admin/orderbysearch/') }}",
                },
                ordering: false,
                processing: true,
                serverSide: true,
                pageLength: 30,
                columnDefs: [{
                    targets: 0,
                    checkboxes: {
                        selectRow: false,
                    },
                }, ],

                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'invoice',
                        width: "15%"
                    },
                    {
                        data: 'customerInfo',
                        width: "25%",
                        className: "customerInfo"
                    },
                    {
                        data: "products",
                        width: "15%",
                    },
                    {
                        data: "subTotal",
                        width: "5%"
                    },
                    {
                        data: "courier",
                        width: "20%",
                    },
                    {
                        data: "orderDate",
                        width: "20%"
                    },
                    {
                        data: 'statusButton',
                        width: "10%"
                    },
                    {
                        data: 'notification',
                        width: "15%"
                    },
                    {
                        data: "user",
                        width: "5%"
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ],

                footerCallback: function() {
                    var api = this.api();
                    var numRows = api.rows().count();
                    $('.total').empty().append(numRows);

                    var intVal = function(i) {
                        return typeof i === "string" ? i.replace(/[\$,]/g, "") * 1 :
                            typeof i === "number" ? i : 0;
                    };
                    pageTotal = api.column(4, {
                        page: "current"
                    }).data().reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                    $(api.column(4).footer()).html(pageTotal + " Tk");
                }

            });

        }


        //assign user
        $(document).on('click', '.assign-user', function(e) {
            e.preventDefault();

            var rows_selected = orderinfotbl.column(0).checkboxes.selected();
            var ids = [];
            $.each(rows_selected, function(index, rowId) {
                ids[index] = rowId;
            });
            var user_id = $(this).attr('data-id');

            jQuery.ajax({
                type: "get",
                url: "{{ url('admin_order/assign_user') }}",
                contentType: "application/json",
                data: {
                    action: "assign",
                    ids: ids,
                    user_id: user_id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data["status"] == "success") {
                        swal(data["message"]);
                        orderinfotbl.ajax.reload();
                    } else {
                        if (data["status"] == "failed") {
                            swal(data["message"]);
                        } else {
                            swal("Something wrong ! Please try again.");
                        }
                    }
                }
            });

        });

        // update status selected item

        $(document).on('click', '.btn-change-status', function(e) {
            e.preventDefault();
            var rows_selected = orderinfotbl.column(0).checkboxes.selected();
            var ids = [];
            $.each(rows_selected, function(index, rowId) {
                ids[index] = rowId;
            });
            var status = $(this).attr('data-status');
            $.ajax({
                type: "get",
                url: "{{ url('admin_order/statusUpdateByCheckbox') }}",
                data: {
                    'status': status,
                    'orders_id': ids,
                    '_token': token
                },
                success: function(response) {
                    countorder();
                    var data = JSON.parse(response);
                    if (data['status'] == 'success') {
                        toastr.success(data["message"]);
                        orderinfotbl.ajax.reload();
                    } else {
                        if (data['status'] == 'failed') {
                            toastr.error(data["message"]);
                        } else {
                            toastr.error('Something wrong ! Please try again.');
                        }
                    }
                }
            });
        });

        //change courier
        $(document).on('click', '.btn-change-courier', function(e) {
            e.preventDefault();
            var rows_selected = orderinfotbl.column(0).checkboxes.selected();
            var ids = [];
            $.each(rows_selected, function(index, rowId) {
                ids[index] = rowId;
            });
            var courierid = $(this).attr('data-courierid');
            $.ajax({
                type: "get",
                url: "{{ url('admin/courierUpdateByCheckbox') }}",
                data: {
                    'courierid': courierid,
                    'orders_id': ids,
                    '_token': token
                },
                success: function(response) {
                    countorder();
                    var data = JSON.parse(response);
                    if (data['status'] == 'success') {
                        toastr.success(data["message"]);
                        orderinfotbl.ajax.reload();
                    } else {
                        if (data['status'] == 'failed') {
                            toastr.error(data["message"]);
                        } else {
                            toastr.error('Something wrong ! Please try again.');
                        }
                    }
                }
            });
        });

        //delete order selectes

        $(document).on('click', '#delete_selected_order', function(e) {
            e.preventDefault();
            var rows_selected = orderinfotbl.column(0).checkboxes.selected();
            var ids = [];
            $.each(rows_selected, function(index, rowId) {
                ids[index] = rowId;
            });
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "GET",
                            url: "{{ url('admin_order/delete_selected_order') }}",
                            data: {
                                orders_id: ids,
                            },
                            success: function(response) {
                                var data = JSON.parse(response);
                                if (data["status"] == "success") {
                                    swal(data["message"]);
                                    orderinfotbl.ajax.reload();
                                } else {
                                    if (data["status"] == "failed") {
                                        swal(data["message"]);
                                    } else {
                                        swal("Something wrong ! Please try again.");
                                    }
                                }
                            }
                        });


                    } else {
                        swal("Your data is safe!");
                    }
                });

        });

        $('#orderinfo thead th').each(function() {
            //count orders
            countorder();
            var title = $(this).text();
            if (title != 'Status' &&
                title != '' &&
                title != 'Action' &&
                title != 'Products' &&
                title != 'Total') {
                // console.log(title);
                if (title == 'Order Date') {
                    $(this).html(
                        '<input type="text" style="width: 60px;" class="form-control datepicker" id="dateorder" placeholder="Date" />'
                    );
                }

                if (title == 'Courier') {
                    $(this).html(
                        ' <input type="text" class="form-control courierID" id="courierID"    placeholder="Courier" />'
                    );
                }
                if (title == 'User') {
                    $(this).html(
                        ' <input type="text" style="width: 100px;" class="form-control" id="userID" placeholder="User" />'
                    );
                }
                if (title == 'Invoice ID') {
                    $(this).html(' <input type="text" class="form-control" placeholder="User ID" />');
                }
                if (title == 'Name') {
                    $(this).html(
                        ' <input type="text" class="form-control" placeholder="Customer Phone" />');
                }

            }
        });


        orderinfotbl.columns().every(function() {

            var orderinfotbl = this;
            $('input', this.header()).on('keyup change', function() {
                if (orderinfotbl.search() !== this.value) {
                    orderinfotbl.search(this.value).draw();
                }
            });

            $('select', this.header()).on('change', function() {
                if (orderinfotbl.search() !== this.value) {
                    orderinfotbl.search(this.value).draw();
                }
            });

        });


        function countorder() {
            $.ajax({
                type: "get",
                url: "{{ url('admin_order/count') }}",
                contentType: "application/json",
                success: function(response) {
                    var data = JSON.parse(response);

                    if (data["status"] == "success") {

                        $('#delivered').text(data["delivered"]);
                        $('#customerConfirm').text(data["customerConfirm"]);
                        $('#paid').text(data["paid"]);
                        $('#return').text(data["return"]);
                        $('#lost').text(data["lost"]);
                        $('#pendingInvoiced').text(data["pendingInvoiced"]);
                        $('#checkedInvoiced').text(data["checkedInvoiced"]);
                        $('#invoiced').text(data["invoiced"]);
                        $('#stockOut').text(data["stockOut"]);
                        $('#all').text(data["all"]);
                        $('#processing').text(data["processing"]);
                        $('#pendingPayment').text(data["pendingPayment"]);
                        $('#onHold').text(data["onHold"]);
                        $('#canceled').text(data["canceled"]);
                        $('#completed').text(data["completed"]);

                        // console.log(data)
                    } else {
                        if (data["status"] == "failed") {
                            swal(data["message"]);
                        } else {
                            swal("Something wrong ! Please try again.");
                        }
                    }
                }
            });
        }


        //order sync

        $(document).on('click', '.btn-syncorder', function() {

            swal({
                html: true,
                title: 'Auto sync start!',
                text: 'It will close after all Products sync.',
                buttons: true,
                dangerMode: true,
                buttons: "Please Wait ...",
            });

            $.ajax({
                type: 'GET',
                url: 'Sync',

                success: function(data) {
                    var datas = JSON.parse(data);
                    countorder();
                    if (datas.status == 'success') {
                        swal({
                            title: "Auto sync completed!",
                            text: datas.orders + ' order added by sync',
                            icon: "success",
                            buttons: true,
                            buttons: "Completed",
                        });
                    } else {
                        swal({
                            title: "Auto sync completed!",
                            text: 'O order added . Nothing to sync',
                            icon: "success",
                            buttons: true,
                            buttons: "Done",
                        });
                    }
                    orderinfotbl.ajax.reload();
                },
                error: function(error) {
                    swal({
                        icon: 'error',
                        title: 'Cant process auto sync !',
                        text: 'Connection Error . Please wait for internet',
                        buttons: true,
                        buttons: "Thanks",
                    });
                }

            });
        });

        //change order status
        var token = $("input[name='_token']").val();

        $(document).on('click', '.btn-status', function(e) {
            e.preventDefault();
            var status = $(this).attr('data-status');
            var id = $(this).attr('data-id');
            $.ajax({
                type: "GET",
                url: "{{ url('order/admin_order/status') }}",
                data: {
                    'status': status,
                    'id': id,
                    '_token': token
                },
                success: function(response) {
                    countorder();
                    var data = JSON.parse(response);
                    if (data['status'] == 'success') {
                        toastr.success(data["message"]);
                        orderinfotbl.ajax.reload();
                    } else {
                        if (data['status'] == 'failed') {
                            toastr.error(data["message"]);
                        } else {
                            toastr.error('Something wrong ! Please try again.');
                        }
                    }
                }
            });
        });

        //order edit

        $(document).on('click', '.btn-editorder', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                type: "get",
                url: "{{ url('admin_orders') }}/" + id + "/edit",
                success: function(response) {

                    $('.modal .modal-body').empty().append(response);
                    $('.modal').modal('toggle');
                    $('.modal-footer').hide();

                    $(".datepicker").flatpickr();

                    $("#productID").select2({
                        placeholder: "Select a Product",
                        dropdownParent: $('#productTable'),
                        templateResult: function(state) {
                            if (!state.id) {
                                return state.text;
                            }
                            var $state = $(
                                '<span><img width="60px" src="' +
                                state.image +
                                '" class="img-flag" /> ' +
                                state.text +
                                "</span>"
                            );
                            return $state;
                        },
                        ajax: {
                            type: 'GET',
                            url: '{{ url('admin_order/products') }}',
                            processResults: function(data) {
                                var data = $.parseJSON(data);
                                return {
                                    results: data.data
                                };
                            }
                        }
                    }).trigger("change").on("select2:select", function(e) {
                        $("#productTable tbody").append(
                            "<tr>" +
                            '<td  style="display: none"><input type="text" class="productID" style="width:80px;" value="' +
                            e.params.data.id + '"></td>' +
                            '<td><input type="text" name="color" id="ProductColor" value="" style="    max-width: 60px;"> </td>' +
                            '<td><input type="text" name="size" id="ProductSize" value="" style="    max-width: 40px;"></td>' +
                            '<td><span class="productCode">' + e.params.data
                            .productCode + '</span></td>' +
                            '<td><span class="productName">' + e.params.data
                            .text + '</span></td>' +
                            '<td><input type="number" class="productQuantity form-control" style="width:80px;" value="1"></td>' +
                            '<td><span class="productPrice">' + e.params.data
                            .productPrice + '</span></td>' +
                            '<td><button class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>\n' +
                            "</tr>"
                        );
                        calculation();
                    });

                    $("#storeID").select2({
                        placeholder: "Select a Store",
                        dropdownParent: $('#storenamepart'),
                        ajax: {
                            type: 'GET',
                            url: '{{ url('admin_order/stores') }}',
                            processResults: function(data) {
                                var data = $.parseJSON(data);
                                return {
                                    results: data
                                };
                            }
                        }
                    });

                    $("#courierID").select2({
                        placeholder: "Select a Courier",
                        dropdownParent: $('#courierdatatbl'),
                        ajax: {
                            url: '{{ url('admin_order/couriers') }}',
                            processResults: function(data) {
                                var data = $.parseJSON(data);
                                return {
                                    results: data
                                };
                            }
                        }
                    }).trigger("change").on("select2:select", function(e) {
                        $("#zoneID").empty();
                        for (var i = 0; i < couriers.length; i++) {
                            if (couriers[i]['courierName'] == e.params.data.text) {
                                if (couriers[i]['hasCity'] == 'on') {
                                    jQuery(".hasCity").show();
                                } else {
                                    jQuery(".hasCity").hide();
                                }
                                if (couriers[i]["hasZone"] == 'on') {
                                    jQuery(".hasZone").show();
                                } else {
                                    jQuery(".hasZone").hide();
                                    $("#zoneID").empty();
                                }
                            }

                            if (e.params.data.text == 'Pathao') {
                                $("#cityID").empty().append(
                                    '<option value="8">Dhaka</option>');
                            } else {
                                $("#cityID").empty();
                            }
                        }

                    });

                    if ($("#courierID").text()) {
                        var courier = $("#courierID").text().trim();
                        for (var i = 0; i < couriers.length; i++) {
                            if (couriers[i]['courierName'] == courier) {
                                if (couriers[i]['hasCity'] == 'on') {
                                    jQuery(".hasCity").show();
                                } else {
                                    jQuery(".hasCity").hide();
                                }

                                if (couriers[i]["hasZone"] == 'on') {
                                    jQuery(".hasZone").show();
                                } else {
                                    jQuery(".hasZone").hide();
                                    $("#zoneID").empty();
                                }
                            }
                        }
                    }

                    $("#cityID").select2({
                        placeholder: "Select a City",
                        dropdownParent: $('#citydatatbl'),
                        ajax: {
                            data: function(params) {
                                var query = {
                                    q: params.term,
                                    courierID: $("#courierID").val()
                                };
                                return query;
                            },
                            type: 'GET',
                            url: '{{ url('admin_order/cities') }}',
                            processResults: function(data) {
                                var data = $.parseJSON(data);
                                return {
                                    results: data
                                };
                            }
                        }
                    });

                    $("#zoneID").select2({
                        placeholder: "Select a Zone",
                        dropdownParent: $('#xonedatatbl'),
                        ajax: {
                            data: function(params) {
                                var query = {
                                    q: params.term,
                                    courierID: $("#courierID").val(),
                                    cityID: $("#cityID").val()
                                };
                                return query;
                            },
                            type: 'GET',
                            url: '{{ url('admin_order/zones') }}',
                            processResults: function(data) {
                                var data = $.parseJSON(data);
                                return {
                                    results: data
                                };
                                console.log(data);
                            }
                        }
                    });


                    var orderCommentTable = $("#orderCommentTable").DataTable({
                        ajax: "{{ url('admin_order/getComment') }}?id=" + $(
                            '#orderCommentTable').attr('data-id'),
                        ordering: false,
                        lengthChange: false,
                        bFilter: false,
                        search: false,
                        info: false,
                        columns: [{
                                data: "date"
                            },
                            {
                                data: "comment"
                            },
                            {
                                data: "name"
                            }
                        ],
                    });

                    var oldOrderTable = $("#oldOrderTable").DataTable({
                        ajax: "{{ url('admin_order/previous_orders') }}?id=" + $(
                            '#oldOrderTable').attr('data-id'),
                        ordering: false,
                        lengthChange: false,
                        bFilter: false,
                        search: false,
                        info: false,
                        columns: [{
                                data: "invoiceID"
                            },
                            {
                                data: null,
                                width: "15%",
                                render: function(data) {
                                    return '<i class="fas fa-user mr-2 text-grey-dark"></i>' +
                                        data.customerName +
                                        '<br> <i class="fas fa-phone  mr-2 text-grey-dark"></i>' +
                                        data.customerPhone +
                                        '<br><i class="fas fa-map-marker mr-2 text-grey-dark"></i>' +
                                        data.customerAddress;
                                }
                            },
                            {
                                data: "products"
                            },
                            {
                                data: "subTotal"
                            },
                            {
                                data: "status"
                            }
                        ]
                    });

                    $(document).on("click", "#updateComment", function() {
                        var note = $('#comment');
                        var id = $('#btn-update').val();
                        if (note.val() == '') {
                            note.css('border', '1px solid red');
                            return;
                        } else if (id == '') {
                            toastr.success('Something Wrong , Try again ! ');
                            return;
                        } else {
                            $.ajax({
                                type: "GET",
                                url: "{{ url('admin_order/updateComment') }}",
                                data: {
                                    'comment': note.val(),
                                    'id': id,
                                    '_token': token
                                },
                                success: function(response) {
                                    var data = JSON.parse(response);
                                    if (data['status'] == 'success') {
                                        toastr.success(data["message"]);
                                        orderCommentTable.ajax.reload();
                                    } else {
                                        if (data['status'] ==
                                            'failed') {
                                            toastr.error(data[
                                                "message"]);
                                        } else {
                                            toastr.error(
                                                'Something wrong ! Please try again.'
                                            );
                                        }
                                    }
                                }
                            });
                            return;
                        }


                    });


                    if ($("#paymentTypeID").text()) {
                        var paymentType = $("#paymentTypeID").val();
                        if (paymentType == "") {
                            $(".paymentID").hide();
                            $(".paymentAgentNumber").hide();
                            $(".paymentAmount").hide();
                        } else {
                            $(".paymentID").show();
                            $(".paymentAgentNumber").show();
                            $(".paymentAmount").show();
                        }
                    }

                    $("#paymentTypeID").select2({
                        placeholder: "Select a payment Type",
                        dropdownParent: $('#paymntidname'),
                        allowClear: true,
                        ajax: {
                            data: function(params) {
                                return {
                                    q: params.term
                                };
                                console.log(params);
                            },
                            url: '{{ url('admin_order/paymenttype') }}',
                            processResults: function(data) {

                                var data = $.parseJSON(data);
                                return {
                                    results: data
                                };
                            }
                        }
                    }).trigger("change").on("select2:select", function(e) {
                        if (e.params.data.text == "") {
                            $(".paymentID").hide();
                            $(".paymentAgentNumber").hide();
                            $(".paymentAmount").hide();
                        } else {
                            $(".paymentID").show();
                            $(".paymentAgentNumber").show();
                            $(".paymentAmount").show();
                        }
                    }).on("select2:unselect", function(e) {
                        $(".paymentID").hide();
                        $(".paymentAgentNumber").hide();
                        $(".paymentAmount").hide();
                        calculation();
                    });

                    $("#paymentID").select2({
                        placeholder: "Select a payment Number",
                        dropdownParent: $('#paymentIDname'),
                        allowClear: true,
                        ajax: {
                            data: function(params) {
                                return {
                                    q: params.term,
                                    paymentTypeID: $("#paymentTypeID").val(),
                                };
                            },
                            type: 'GET',
                            url: '{{ url('admin_order/paymentnumber') }}',

                            processResults: function(data) {
                                var data = $.parseJSON(data);
                                return {
                                    results: data
                                };
                            }
                        }
                    });

                    $(document).on("change", ".productQuantity", function() {
                        calculation();
                    });
                    $(document).on("input", "#paymentAmount", function() {
                        calculation();
                    });
                    $(document).on("input", "#deliveryCharge", function() {
                        calculation();
                    });
                    $(document).on("input", "#discountCharge", function() {
                        calculation();
                    });
                    calculation();

                    function calculation() {
                        var subtotal = 0;
                        var deliveryCharge = +$("#deliveryCharge").val();
                        var discountCharge = +$("#discountCharge").val();
                        var paymentAmount = +$("#paymentAmount").val();
                        $("#productTable tbody tr").each(function(index) {
                            subtotal = subtotal + +$(this).find(".productPrice")
                                .text() * +$(this).find(".productQuantity").val();
                        });
                        $("#subtotal").text(subtotal);
                        $("#total").text(subtotal + deliveryCharge - paymentAmount -
                            discountCharge);
                    }

                    $(document).on("click", ".delete-btn", function() {
                        $(this).closest("tr").remove();
                        calculation();
                    });


                }
            });
        });


        $(document).on("click", "#btn-update", function() {
            var id = $(this).val();
            var invoiceID = $("#invoiceID");
            var customerName = $("#customerName");
            var customerPhone = $("#customerPhone");
            var customerAddress = $("#customerAddress");
            var storeID = $("#storeID");
            var total = +$("#total").text();
            var deliveryCharge = +$("#deliveryCharge").val();
            var discountCharge = +$("#discountCharge").val();
            var paymentTypeID = $("#paymentTypeID").val();
            var paymentID = $("#paymentID").val();
            var paymentAmount = +$("#paymentAmount").val();
            var paymentAgentNumber = $("#paymentAgentNumber").val();
            var orderDate = $("#orderDate");
            var courierID = $("#courierID");
            var cityID = +$("#cityID").val();
            var zoneID = +$("#zoneID").val();
            var memo = $("#memo").val();
            var product = [];
            var productCount = 0;

            $("#productTable tbody tr").each(function(index, value) {
                var currentRow = $(this);
                var obj = {};
                obj.productColor = currentRow.find("#ProductColor").val();
                obj.productSize = currentRow.find("#ProductSize").val();
                obj.productID = currentRow.find(".productID").val();
                obj.productCode = currentRow.find(".productCode").text();
                obj.productName = currentRow.find(".productName").text();
                obj.productQuantity = currentRow.find(".productQuantity").val();
                obj.productPrice = currentRow.find(".productPrice").text();
                product.push(obj);
                productCount++;
            });

            if (storeID.val() == '') {
                toastr.error('Store Should Not Be Empty');
                storeID.closest('.form-group').find('.select2-selection').css('border',
                    '1px solid red');
                return;
            }
            storeID.closest('.form-group').find('.select2-selection').css('border',
                '1px solid #ced4da');

            if (invoiceID.val() == '') {
                toastr.error('Invoice ID Should Not Be Empty');
                invoiceID.css('border', '1px solid red');
                return;
            }
            invoiceID.css('border', '1px solid #ced4da');

            if (customerName.val() == '') {
                toastr.error('Customer Name Should Not Be Empty');
                customerName.css('border', '1px solid red');
                return;
            }
            customerName.css('border', '1px solid #ced4da');

            if (customerPhone.val() == '') {
                toastr.error('Customer Phone Should Not Be Empty');
                customerPhone.css('border', '1px solid red');
                return;
            }
            customerPhone.css('border', '1px solid #ced4da');

            if (customerAddress.val() == '') {
                toastr.error('Customer Address Should Not Be Empty');
                customerAddress.css('border', '1px solid red');
                return;
            }
            customerAddress.css('border', '1px solid #ced4da');

            if (orderDate.val() == '') {
                toastr.error('Order Date Should Not Be Empty');
                orderDate.css('border', '1px solid red');
                return;
            }
            orderDate.css('border', '1px solid #ced4da');

            if (courierID.val() == '') {
                toastr.error('Courier Should Not Be Empty');
                courierID.closest('.form-group').find('.select2-selection').css('border',
                    '1px solid red');
                return;
            }
            courierID.css('border', '1px solid #ced4da');

            if (productCount == 0) {
                toastr.error('Product Should Not Be Empty');
                return;
            }

            var data = {};
            data["invoiceID"] = invoiceID.val();
            data["storeID"] = storeID.val();
            data["customerName"] = customerName.val();
            data["customerPhone"] = customerPhone.val();
            data["customerAddress"] = customerAddress.val();
            data["total"] = total;
            data["deliveryCharge"] = deliveryCharge;
            data["discountCharge"] = discountCharge;
            data["paymentTypeID"] = paymentTypeID;
            data["paymentID"] = paymentID;
            data["paymentAmount"] = paymentAmount;
            data["paymentAgentNumber"] = paymentAgentNumber;
            data["orderDate"] = orderDate.val();
            data["courierID"] = +courierID.val();
            data["cityID"] = cityID;
            data["zoneID"] = zoneID;
            data["userID"] = $('#user_id').val();
            data["products"] = product;
            data["memo"] = memo;
            $.ajax({
                type: "PUT",
                url: "{{ url('admin_orders') }}/" + id,
                data: {
                    'data': data,
                    '_token': token
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data["status"] === "success") {
                        toastr.success(data["message"]);
                        $('.modal').modal('toggle');
                    } else {
                        toastr.error(data["message"]);
                    }
                    orderinfotbl.ajax.reload();
                }
            });


        });


        $(document).on('click', '.order-print-btn', function(e) {
            e.preventDefault();
            var rows_selected = orderinfotbl.column(0).checkboxes.selected();
            var ids = [];
            $.each(rows_selected, function(index, rowId) {
                ids[index] = rowId;
            });

            if (ids.length > 0) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('admin_order/store/Invoice') }}",
                    data: {
                        orders_id: ids
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data['status'] === 'success') {
                            window.open(data['link'], "_blank");
                            swal({
                                title: "Are you sure?",
                                text: "All invoiced Printed !",
                                type: "warning",
                                buttons: true,
                                dangerMode: true,
                            }).then((t) => {
                                if (t) {
                                    $.ajax({
                                        type: "get",
                                        url: "{{ url('admin_order/statusUpdateByCheckbox') }}",
                                        data: {
                                            'status': 'Invoiced',
                                            'orders_id': ids,
                                            '_token': token
                                        },
                                        success: function(response) {
                                            var data = JSON.parse(
                                                response);
                                            if (data['status'] ===
                                                'success') {
                                                toastr.success(data[
                                                    "message"]);
                                                orderinfotbl.ajax
                                                    .reload();
                                            } else {
                                                if (data['status'] ===
                                                    'failed') {
                                                    toastr.error(data[
                                                        "message"
                                                    ]);
                                                } else {
                                                    toastr.error(
                                                        'Something wrong ! Please try again.'
                                                    );
                                                }
                                            }
                                        }
                                    });
                                } else {
                                    swal("Invoice Stay Pending !");
                                }
                            });

                        } else {
                            if (data['status'] === 'failed') {
                                toastr.error(data["message"]);
                            } else {
                                toastr.error('Something wrong ! Please try again.');
                            }
                        }


                    }

                });
            } else {
                swal("Oops...!", "Select at last one", "error");
            }


        });



        $(".datepicker").flatpickr();




    });

    function courierid() {
        var cur = $('#courierID').select2('val');
        var id = $('#courier_id').val(cur);

        if (id == '') {
            swal("Oops...!", "Select at last one", "error");

        }
    }
</script>

@if (Auth::user()->role == 0 || Auth::user()->role == 1)
    <style>
        .btn-delete {
            display: none;
        }
    </style>
@else
@endif

<style>
    .card-box {
        background-color: #fff;
        padding: 1.5rem;
        -webkit-box-shadow: 0 1px 4px 0 rgb(0 0 0 / 10%);
        box-shadow: 0 1px 4px 0 rgb(0 0 0 / 10%);
        margin-bottom: 24px;
        border-radius: 0.25rem;
    }

    a {
        text-decoration: none;
    }
</style>


@endsection
