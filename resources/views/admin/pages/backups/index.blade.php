@extends('admin.layouts.master')
@section('page_title', 'Backups Index')

@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@section('admin_content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h5 class="card-header">Backups Index / List</h5>
                    <button type="button" class="btn btn-primary me-4"
                        onclick="event.preventDefault(); document.getElementById('new-backup-form').submit();">Create
                        Backup</button>
                    <form action="{{ route('backup.store') }}" method="POST" class="d-none" id="new-backup-form">
                        @csrf
                    </form>
                </div>
                <div class="table-responsive text-nowrap px-3 py-1">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Last Updated</th>
                                <th>File Name</th>
                                <th>File Size</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($backups as $backup)
                                <tr>
                                    <td><strong>{{ $loop->index + 1 }}</strong>
                                    </td>
                                    <td>{{ $backup['created_at'] }}</td>
                                    <td>{{ $backup['file_name'] }}</td>
                                    <td>{{ $backup['file_size'] }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('backup.download', $backup['file_name']) }}"><i
                                                        class="bx bx-download"></i>
                                                    Download</a>

                                                <form action="{{ route('backup.destroy', $backup['file_name']) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item popup_alert">
                                                        <i class="bx bx-trash me-1"></i>
                                                        Delete
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No user found yet!</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('admin_script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
        $(document).ready(function() {
            $('.popup_alert').click(function(event) {
                let form = $(this).closest('form');
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });

            $('.toggle-class').change(function() {
                var is_active = $(this).prop('checked') == true ? 1 : 0;
                var item_id = $(this).data('id');
                // console.log(is_active, item_id); // for debug purpose

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '/admin/check/user/is_active/' + item_id,
                    success: function(response) {
                        console.log(response)
                        Swal.fire({
                            title: `${response.message}`,
                            // text: `Successfully`, //if needed!
                            icon: `${response.type}`,
                        })
                    },
                    error: function(err) {
                        if (err) {
                            console.log(err);
                        }
                    }
                });
            });

        });
    </script>
@endpush
