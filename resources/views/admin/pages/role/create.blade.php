@extends('admin.layouts.master')
@section('page_title', 'Role Create')

@push('admin_style')
@endpush

@section('admin_content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Role</h5>
                    <small class="text-muted float-end">
                        <a href="{{ route('role.index') }}" class="btn btn-secondary"><i class="bx bx-arrow-back"></i> Back
                            to Role</a></small>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Role Name</label>
                            <input type="text" name="role_name"
                                class="form-control @error('role_name') is-invalid @enderror" id="basic-default-fullname"
                                placeholder="enter a role name">
                            @error('role_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Role Note</label>
                            <input type="text" name="role_note"
                                class="form-control @error('role_note') is-invalid @enderror" id="basic-default-fullname"
                                placeholder="enter a role note">
                            @error('role_note')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- <div class="form-check mb-3">
                            <label class="form-check-label" for="defaultCheck3">Is deletable ?</label>
                            <input class="form-check-input" type="checkbox" name="is_deletable" id="defaultCheck3" checked>
                        </div> --}}

                        <div class="mt-4 mb-2">
                            <strong class="@error('permissions') is-invalid @enderror">Manage Permissions for Role</strong>
                            @error('permissions')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <label class="form-check-label" for="select-all">Select All</label>
                            <input class="form-check-input" type="checkbox" id="select-all">
                        </div>

                        <div class="my-5">
                            @foreach ($modules->chunk(3) as $key => $chunks)
                                <div class="row">
                                    @foreach ($chunks as $module)
                                        <div class="col mb-3">
                                            <h5 class="text-primary">Module: {{ $module->module_name }}</h5>

                                            <!-- Module permission list -->
                                            @foreach ($module->permissions as $permission)
                                                <div class="form-check mb-3">
                                                    <label class="form-check-label"
                                                        for="permission-{{ $permission->id }}">{{ $permission->permission_name }}</label>
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        value="{{ $permission->id }}" id="permission-{{ $permission->id }}">
                                                </div>
                                            @endforeach
                                            <!-- Module permission list End -->
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
    <script>
        // Listern for click on select all checkbox
        $('#select-all').click(function(event) {
            if (this.checked) {
                // Loop each checkbox "checked"
                $(':checkbox').each(function() {
                    this.checked = true;
                })
            } else {
                // Loop each checkbox "unchecked"
                $(':checkbox').each(function() {
                    this.checked = false;
                })
            }
        });
    </script>
@endpush
