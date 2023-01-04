@extends('admin.gara.gara')
@section('tab-content')
    <div class="tab-pane active" id="" role="tabpanel" aria-labelledby="course-tab">


        <form action="" method="post">

            <input type="hidden" name="type" value="gara">

            <table class=" table table-hover table-light table-stripped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên gara ô tô</th>
                        <th scope="col">Email</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($garas?? [] as $gara)
                        <tr>

                            <th scope="row">{{ $gara->id }}</th>
                            <td>{{ $gara->name }}</td>
                            <td>{{ $gara->email }}</td>
                            <td>{{ $gara->address }}</td>
                            <td>{{ $gara->describle }}</td>
                            <td>{{ $gara->created_at }}</td>
                            <td><a href="{{ route('show.update.gara',['id'=>$gara->id]) }}" class="btn btn-warning">{{ __('title.edit') }}</a>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $garas->appends(request()->all())->links('common.component.paginate') }}

            @csrf
        </form>

    </div>
@endsection
