@extends('admin.author.author')
@section('tab-content')
    <div class="tab-pane active" id="" role="tabpanel" aria-labelledby="course-tab">


        <form action="" method="post">

            <input type="hidden" name="type" value="author">

            <table class=" table table-hover table-light table-stripped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên hãng ô tô</th>
                        <th scope="col">Năm sinh</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors?? [] as $author)
                        <tr>

                            <th scope="row">{{ $author->id }}</th>
                            <td>{{ $author->full_name }}</td>
                            <td>{{ $author->dob }}</td>
                            <td>{{ $author->address }}</td>
                            <td>{{ $author->describle }}</td>
                            <td>{{ $author->created_at }}</td>
                            <td><a href="{{ route('show.update.author',['id'=>$author->id]) }}" class="btn btn-warning">{{ __('title.edit') }}</a>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $authors->appends(request()->all())->links('common.component.paginate') }}

            @csrf
        </form>

    </div>
@endsection
