@extends('admin')

@section('page')
@if ($message ?? '')
<div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
    {{ $message ?? '' }}
</div>
@endif
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <div class="content">
      <div class="container-fluid">
    <div class="row">
            <div class="col-md-12">
              <a href="{{ route('discount.create') }}" class="btn btn-success float-right float-right m-2">Add</a>
            </div>
            <div class="col-md-12">
              <table class="table">
                  <thead>
                      <tr>
                      <th scope="col">#</th>
                      <th scope="col">Mã giảm giá</th>
                      <th scope="col">Giá trị giảm(VNĐ)</th>
                      <th scope="col">Thời gian bắt đầu</th>
                      <th scope="col">Thời gian kết thúc</th>
                      <th scope="col">Action</th>

                      </tr>
                  </thead>
                  <tbody>
                  @foreach ( $discountss as $discounts )
                        <tr>
                          <th scope="row">{{$discounts->id}}</th>
                          <td>{{$discounts->code}}</td>
                          <td>{{$discounts->number}}</td>


                          <td>{{$discounts->start_date}}</td>
                          <td>{{$discounts->end_date}}</td>


                          <td>
                            <a href="{{ route('discount.edit', ['id' => $discounts->id]) }}" class="btn btn-default">Sửa</a>
                            <a href="{{route ('discount.delete', ['id' =>  $discounts->id])}}" class="btn btn-danger">Xóa</a>
                          </td>
                        </tr>
                        @endforeach
                  </tbody>
              </table>


            </div>
            <div class="col-md-12 ">
            </div>
            {{$discountss->links()}}

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

