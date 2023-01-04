@extends('admin.car.car')
@section('static')
    @parent()
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
@endsection
@section('tab-content')
    <div class="tab-pane active" id="" role="tabpanel" aria-labelledby="course-tab">


        <form action="" method="post">

            <input type="hidden" name="type" value="car">

            <table class=" table table-hover table-light table-stripped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên ô tô</th>
                        <th scope="col">Giá thuê</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Chi tiết</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Xóa</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars ?? [] as $car)
                        <tr>

                            <th scope="row">{{ $car->id }}</th>
                            <td>{{ $car->car_name }}</td>
                            <td>{{ $car->total_quantity }}</td>
                            <td>{{ $car->created_at }}</td>
                            <td>
                                <a href="{{ route('show.info.car', ['id' => $car->id]) }}" class="btn btn-info"><i
                                        class="bi bi-info-circle"></i></i>Chi tiết</a>
                            </td>
                            <td>
                                <a href="{{ route('show.update.car', ['id' => $car->id]) }}"
                                    class="btn btn-warning">{{ __('title.edit') }}</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#exampleModal-{{ $car->id }}">
                                    {{ __('title.delete') }}
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal-{{ $car->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn chắc chắn muốn xóa?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">
                                                    <a class="btn-primary text-decoration-none"
                                                        href="{{ route('delete.car', ['id' => $car->id]) }}">{{ __('title.delete') }}</a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $cars->appends(request()->all())->links('common.component.paginate') }}

            @csrf
        </form>

    </div>
@endsection
