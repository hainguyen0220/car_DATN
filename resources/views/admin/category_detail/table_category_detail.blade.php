@extends('admin.category_detail.category_detail')
@section('tab-content')
    <div class="tab-pane active" id="course" role="tabpanel" aria-labelledby="course-tab">


        <form action="" method="post">

            <input type="hidden" name="type" value="user">

            <table class=" table table-hover table-light table-stripped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên thể loại</th>
                        <th scope="col">Tên danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($categoryDetails ?? [] as $categoryDetail)
                        <tr>

                            <th scope="row">{{ $categoryDetail->id }}</th>
                            <td>{{ $categoryDetail->category_detail_name }}</td>
                            <td>{{ $categoryDetail->category->category_name  ?? null}}</td>
                            <td>{{ $categoryDetail->created_at }}</td>
                            <td><a href="{{ route('show.update.category.detail',['id'=>$categoryDetail->id]) }}" class="btn btn-warning">{{ __('title.edit') }}</a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $categoryDetails->appends(request()->all())->links('common.component.paginate') }}

            @csrf
        </form>

    </div>
@endsection
