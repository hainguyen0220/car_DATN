@extends('admin')

@section('page')
@if ($message ?? '')
<div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
    {{ $message ?? '' }}
</div>
@endif
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <form action="{{route('discount.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Mã giảm giá</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror"
              name="code"
              placeholder="Mã giảm giá"
              value="{{old('code')}}">
              @error('code')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>




            <div class="form-group">
              <label>Giá trị giảm(VNĐ)</label>
              <input type="number" class="form-control @error('name') is-invalid @enderror"
              name="number"
              placeholder="Giá trị giảm(VNĐ)"
              rows="4"
              value="{{old('number')}}"></input>
              @error('number')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>Thời gian bắt đầu</label>
              <input type="date" class="form-control @error('name') is-invalid @enderror"
              name="start_date"
              placeholder="Thời gian bắt đầu"
              rows="4"
              value="{{old('start_date')}}"></input>
              @error('start_date')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>Thời gian kết thúc</label>
              <input type="date" class="form-control @error('name') is-invalid @enderror"
              name="end_date"
              placeholder="Thời gian kết thúc"
              rows="4"
              value="{{old('end_date')}}"></input>
              @error('end_date')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection