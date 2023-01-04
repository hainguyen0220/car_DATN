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
        <div class="col-md-6">
          <form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Tiêu đề</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror"
              name="title"
              placeholder="Nhập tiêu đề"
              value="{{old('title')}}">
              @error('title')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="form-group">
              <label>Nội dung</label>
              <textarea type="text" class="form-control @error('name') is-invalid @enderror"
              name="content"
              placeholder="Nội dung"
              rows="4"
              value="{{old('content')}}"></textarea>
              @error('content')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>Hình ảnh</label>
              <input type="file" class="form-control @error('name') is-invalid @enderror"
              name="image">
              @error('image')
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