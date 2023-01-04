@extends('admin.slider.slider')
@section('static')
    @parent()
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
@show
@section('tab-content')
    <div class="tab-pane active" id="course" role="tabpanel" aria-labelledby="course-tab">


        <form action="" method="post">

            <input type="hidden" name="type" value="user">

            <table class=" table table-hover table-light table-stripped">
                <thead>
                    <tr>
                        <th style="width:10%">#</th>
                        <th style="width:40%">Ảnh</th>
                        <th style="width:40%">Link</th>
                        <th style="width:10%">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders ?? [] as $slider)
                        <tr>

                            <th scope="row">{{ $slider->id }}</th>
                            <td><img src="{{ asset('storage/slider/' . $slider->image) }}" alt="" class="img-thumbnail">
                            </td>
                            <td>{{ $slider->link }}</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#exampleModal-{{ $slider->id }}">
                                    Xóa
                                </button>

                                <!-- Modal -->

                                <div class="modal fade" id="exampleModal-{{ $slider->id }}" tabindex="-1" role="dialog"
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
                                                        href="{{ route('delete.slider', ['id' => $slider->id]) }}">{{ __('title.delete') }}</a>
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

            @csrf
        </form>

    </div>

@endsection
