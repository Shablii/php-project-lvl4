
{{ Form::model($tasks, ['url' => route('tasks.store'), 'method' => 'GET', 'class' => "form-inline"]) }}
        {{ Form::select('filter[status_id]', $statuses,
            request()->input('filter.status_id'),
        ['class' => 'form-control mr-2', 'placeholder' => 'Статус']) }}
        {{ Form::select('filter[created_by_id]', $users,
            request()->input('filter.created_by_id'),
        ['class' => 'form-control mr-2', 'placeholder' => 'Автор']) }}
        {{ Form::select('filter[assigned_to_id]', $users,
            request()->input('filter.assigned_to_id'),
        ['class' => 'form-control mr-2', 'placeholder' => 'Исполнитель']) }}
{{ Form::submit('Применить', ['class' => "btn btn-outline-primary mr-2"]) }}
{{ Form::close() }}

