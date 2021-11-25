
{{ Form::model($tasks, ['url' => route('tasks.store'), 'method' => 'GET', 'class' => "form-inline"]) }}
        {{ Form::select('filter[status_id]', $statuses->pluck('name', 'id')->sort(),
            request()->input('filter.status_id'),
        ['class' => 'form-control mr-2', 'placeholder' => __('Status')]) }}
        {{ Form::select('filter[created_by_id]', $users->pluck('name', 'id')->sort(),
            request()->input('filter.created_by_id'),
        ['class' => 'form-control mr-2', 'placeholder' => __('Author')]) }}
        {{ Form::select('filter[assigned_to_id]', $users->pluck('name', 'id')->sort(),
            request()->input('filter.assigned_to_id'),
        ['class' => 'form-control mr-2', 'placeholder' => __('Assigned')]) }}
{{ Form::submit('Применить', ['class' => "btn btn-outline-primary mr-2"]) }}
{{ Form::close() }}

