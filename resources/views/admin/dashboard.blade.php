@extends('admin')
@section('static')
@parent()
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link href="https://datatables.yajrabox.com/css/datatables.bootstrap.css" rel="stylesheet">
@endsection
@section('page')

<div class="container " style="width: 1000px; height: 400px;">

    <div class="row">
        <div class="col-md-12 bg-white shadow border rounded-3 mb-3 pb-5">
            <h3 class="title text-center text-dark p-3">Danh sách cho thuê ô tô </h3>
            <form action="{{ route('export.order') }}" method="post">
                <div class="form d-flex justify-content-around">
                    <div class="mb-3 row">
                        <label class="col col-form-label">Từ</label>
                        <div class="col">
                            <input type="date" class="form-control" id="" name="date_start" value="" required>
                            @error('date_start')
                            <div class="mt-3">
                                <span class="alert-danger mt-2">{{ $errors->first('date_start') }}</span>
                            </div>
                            @enderror
                        </div>

                    </div>

                    <div class="form d-flex justify-content-around">
                        <div class="mb-3 row">
                            <label class="col col-form-label">Đến</label>
                            <div class="col">
                                <input type="date" class="form-control" id="" name="date_end" value="" required>
                                @error('date_end')
                                <div class="mt-3">
                                    <span class="alert-danger mt-2">{{ $errors->first('date_end') }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Exprot Excel</button>
                </div>
                @csrf
            </form>

        </div>

        <div class="col-md-12 bg-white shadow border rounded-3" style="min-height:100vh">
            <div class="content__cart-list-product-container">
                @include('common.block.flash-message')
            </div>

            <table class="table table-bordered" id="order-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th>Ngày thuê</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>




<!-- jQuery -->
<script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>



<!-- Handle Bars -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js" integrity="sha512-RNLkV3d+aLtfcpEyFG8jRbnWHxUqVZozacROI4J2F1sTaDqo1dPQYs01OMi1t1w9Y2FdbSCDSQ2ZVdAC8bzgAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script id="details-template" type="text/x-handlebars-template">
    <div class="label label-info"></div>
            <table class="table details-table" id="posts-@{{ id }}"><thead>                                                                                                                 </table>
    </script>

<script>
    let template = Handlebars.compile($("#details-template").html());
    let table = $('#order-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('dashboard.data') !!}',
        columns: [{
                "className": 'details-control',
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": ''
            },
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'account.user_info.full_name',
                name: 'account.user_info.full_name'
            },
            {
                data: 'account.email',
                name: 'account.email'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
        ],
        order: [
            [0, 'asc']
        ],
        columnDefs: [{
            "targets": '_all',
            "defaultContent": ""
        }],
    });

    // Add event listener for opening and closing details
    $('#order-table tbody').on('click', 'td.details-control', function() {
        let tr = $(this).closest('tr');
        let row = table.row(tr);
        let tableId = 'posts-' + row.data().id;

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(template(row.data())).show();
            initTable(tableId, row.data());
            tr.addClass('shown');
            tr.next().find('td').addClass('no-padding bg-gray');
        }
    });

    function initTable(tableId, data) {
        console.log(data.details_url);
        $('#' + tableId).DataTable({
            processing: true,
            serverSide: true,
            ajax: data.details_url,
            columns: [{
                    data: 'id',
                },
                {
                    data: 'car.car_name',
                    name: 'car.car_name'
                },
                {
                    data: 'quantity',
                    name: 'quantity'
                }, {
                    data: 'date_order',
                    name: 'date_order'
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }

            ]
        });
    }
</script>
@endsection
