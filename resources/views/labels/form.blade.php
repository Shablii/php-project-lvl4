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
</div>
