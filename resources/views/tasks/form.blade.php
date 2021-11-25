<div class="form-group">
    <div class="form-group">
        {{ Form::label('name', __('Name')) }}
        {{ Form::text('name', null, ['class' => $errors->first('name') == null ? 'form-control' : 'form-control is-invalid']) }}
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        {{ Form::label('description', __('Description')) }}
        {{ Form::textarea('description', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('status_id', __('Status')) }}
        {{ Form::select('status_id', $statuses->pluck('name', 'id')->sort(), null,
        ['class' => $errors->first('status_id') == null ? 'form-control' : 'form-control is-invalid', 'placeholder' => '----------']) }}
        @error('status_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        {{ Form::label('assigned_to_id', __('Assigned')) }}
        {{ Form::select('assigned_to_id', $users->pluck('name', 'id')->sort(), null, ['class' => 'form-control', 'placeholder' => '----------']) }}
    </div>

    <div class="form-group">
        {{ Form::label('labels', __('Labels')) }}
        {{ Form::select('labels', $labels->pluck('name', 'id')->sort(), null, ['class' => 'form-control', 'multiple','name'=>'labels[]']) }}
        @error('labels')
        <div>{{ $message }}</div>
        @enderror
    </div>
</div>
