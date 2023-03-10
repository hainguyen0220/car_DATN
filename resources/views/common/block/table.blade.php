<table class="table table-hover table-light table-stripped">
    <thead>
        <tr>
            <th scope="col">#</th>
            @foreach ($fields ?? [] as $key => $value)
                @if ($value === 'pattern.tick')
                    <th></th>
                @else
                    <th scope="col">{{ __("title.$key") }}</th>
                @endif
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($items ?? [] as $item)
            <tr>
                <td class="id" scope="row">{{ $item->id }}</td>
                @foreach ($fields ?? [] as $key => $value)
                    @if ($value === 'pattern.tick')
                        <td class="tick" style="min-width: 40px"> <i class="fas fa-check" style="display: none"></i> </td>
                    @elseif ($value === 'pattern.modified')
                        <td><a href="{{ route($edit_route ?? 'edit', [$id_param ?? 'id' => $item->id]) }}"
                                {{-- Them parameter moi --}}
                                class="btn btn-primary">{{ __('title.' . ($edit_text ?? 'edit')) }}</a>
                        </td>
                    @elseif ($value === 'pattern.image')
                        <td>
                            @if ($item->image)
                                <img src="{{ $item->image }}" alt="" srcset="" width="50" height="50">
                            @endif
                        </td>
                    @elseif (strpos($value, 'custom.'))
                        @yield($value, $item)
                    @else
                        <td class="{{ $key }}">{{ isset($$value) && is_array($$value) && array_key_exists($item->$value, $$value) ? $$value[$item->$value] : $item->$value }}</td>
                    @endif

                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>


{{-- Example of invocation
    @include('common.block.table', [
        'fields' => [                               // Field name and value
            'modify' => 'pattern.modified',         // pattern.modified is a specific value field
            'exam-name' => 'name',                  // will show $item->name
            'status' => 'status',   
            'exam-type' => 'type',
            'created-at' => 'created_at'
        ],
        'items' => $exams,                          // Parse data items
        'edit_route' => 'exam-detail',              // When click on edit button
        'ediit_text' => 'detail',                   // Modify text on edit button
        'delete_route' => 'delete-exam',            // When click on delete button
        'type' => [                                 // If it's necessary to transform value in exam-type column to a readable info
                                                    // use name of the value field with the corresponding value
            'multiple_choice' => __('title.multi_choice'),
            'mixing' => __('title.mixing')
            ]
        ]) --}}
