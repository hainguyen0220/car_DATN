@extends('admin.admin-home')
@section('tab-content')

        <div class="container-fluid">
            <div class="row">
                <div class="tab-pane active" id="course" role="tabpanel" aria-labelledby="course-tab">


                    <form action="{{ route('post.update.multiple.account') }}" method="post">

                        <input type="hidden" name="type" value="user">

                        <table class=" table table-hover table-light table-stripped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users ?? [] as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->user_info->full_name ?? null }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><select name="user-status[{{ $user->id }}]" class="form-select status-select" aria-label="Select user status">
                                            @foreach ($statusOptions as $statusOption)
                                            <option value="{{ $statusOption }}" {{ $statusOption === $user->status ? 'selected' : '' }}>
                                                {{ __("title.$statusOption") }}
                                            </option>
                                            @endforeach
                                        </select></td>
                                    <td>{{ $user->created_at }}</td>
                                    <td><a href="{{ route('update.account',['id'=>$user->id]) }}" class="btn btn-warning">{{ __('title.edit') }}</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $users->appends(request()->all())->links('common.component.paginate') }}


                        <div class="form-check btn-lg">
                            <button type="submit" class="btn btn-primary" name='action' value='update'>{{ __('title.save') }}</button>
                        </div>
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
