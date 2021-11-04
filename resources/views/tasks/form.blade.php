<div class="form-group">
    <div class="form-group">
        {{ Form::label('name', 'Имя') }}
        {{ Form::text('name', null, ['class' => $errors->first('name') == null ? 'form-control' : 'form-control is-invalid']) }}
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Описание') }}
        {{ Form::textarea('description', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('status_id', 'Статус') }}
        {{ Form::select('status_id', $statuses, null,
        ['class' => $errors->first('status_id') == null ? 'form-control' : 'form-control is-invalid', 'placeholder' => '----------']) }}
        @error('status_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        {{ Form::label('assigned_to_id', 'Исполнитель') }}
        {{ Form::select('assigned_to_id', $users, null, ['class' => 'form-control', 'placeholder' => '----------']) }}
    </div>

    <div class="form-group">
        {{ Form::label('labels', 'Метки') }}
        {{ Form::select('labels', $labels, null, ['class' => 'form-control', 'multiple','name'=>'labels[]']) }}
        @error('labels')
        <div>{{ $message }}</div>
        @enderror
    </div>
</div>
