{{ csrf_field() }}
<div class="field">
    <label class="label">
        Title
        <span class="has-text-danger" title="Field required">*</span>
    </label>
    <div class="control">
        <input required class="input {{ ($errors->has('title')) ? 'is-danger' : '' }}" type="text" name="title" value="{{ old('title') ? old('title') : $project->title }}">
    </div>
    @if($errors->has('title'))
    <p class="help is-danger">{{ $errors->first('title') }}</p>
    @endif
</div>
<div class="field">
    <label class="label">
        Description
        <span class="has-text-danger" title="Field required">*</span>
    </label>
    <div class="control">
        <textarea required class="textarea {{ ($errors->has('description')) ? 'is-danger' : '' }}" name="description">{{ old('description') ? old('description') : $project->description }}</textarea>
    </div>
    @if($errors->has('description'))
    <p class="help is-danger">{{ $errors->first('description') }}</p>
    @endif
</div>
<div class="columns">
    <div class="column is-6">
        <div class="field">
            <label class="label">
                Start Date
                <span class="has-text-danger" title="Field required">*</span>
            </label>
            <div class="control">
                <div class="select is-fullwidth {{ ($errors->has('start_date')) ? 'is-danger' : '' }}">
                    <input id="startDateDatepicker" required class="input" type="text" name="start_date" value="{{ $project->start_date }}">
                </div>
            </div>
            @if($errors->has('start_date'))
                <p class="help is-danger">{{ $errors->get('start_date') }}</p>
            @endif
        </div>
    </div>
    <div class="column is-6">
        <div class="field">
            <label class="label">
                End Date
                <span class="has-text-danger" title="Field required">*</span>
            </label>
            <div class="control">
                <div class="select is-fullwidth {{ ($errors->has('end_date')) ? 'is-danger' : '' }}">
                    <input id="endDateDatepicker" required class="input" type="text" name="end_date" value="{{ $project->end_date }}">
                </div>
            </div>
            @if($errors->has('end_date'))
                <p class="help is-danger">{{ $errors->get('end_date') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="columns">
    <div class="column is-4">
        <div class="field">
            <label class="label">
                Client
                <span class="has-text-danger" title="Field required">*</span>
            </label>
            <div class="control">
                <div class="select is-fullwidth {{ ($errors->has('client_id')) ? 'is-danger' : '' }}">
                    <select required name="client_id">
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ ( $project->client_id === $client->id ) ? 'selected' : '' }}>{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if($errors->has('client_id'))
                <p class="help is-danger">{{ $errors->get('client_id') }}</p>
            @endif
        </div>
    </div>
    <div class="column is-4">
        <div class="field">
            <label class="label">
                Members
                <span class="has-text-danger" title="Field required">*</span>
            </label>
            <div class="control">
                <div class="select is-fullwidth {{ ($errors->has('client_id')) ? 'is-danger' : '' }}">
                    <select required name="employee_id[]" multiple>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if($errors->has('employee_id'))
                <p class="help is-danger">{{ $errors->get('employee_id') }}</p>
            @endif
        </div>
    </div>
    <div class="column is-4">
        <div class="field">
            <label class="label">
                Status
                <span class="has-text-danger" title="Field required">*</span>
            </label>
            <div class="control">
                <div class="select is-fullwidth {{ ($errors->has('status_id')) ? 'is-danger' : '' }}">
                    <select required name="status_id">
                        @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ ( $project->status_id === $status->id ) ? 'selected' : '' }}>{{ $status->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if($errors->has('status_id'))
                <p class="help is-danger">{{ $errors->get('status_id') }}</p>
            @endif
        </div>
    </div>
</div>
<input class="button is-primary" type="submit" value="{{ $buttonText }}">