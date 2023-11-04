@extends('admin.layouts.master')
@section('page_title', 'Dashboard')

@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@section('admin_content')
<div class="row">
    <div class="col-lg-12 mb-0 order-0">
        <h3 class="card-title text-primary px-2 py-2">Welcome to Admin Dashboard {{ Auth::user()->name}} 🎉</h3>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{ asset('admin') }}/assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">User Count</span>
            <h3 class="card-title mb-2">{{ $user_count }}</h3>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{ asset('admin') }}/assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Role Count</span>
            <h3 class="card-title mb-2">{{ $role_count }}</h3>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{ asset('admin') }}/assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Page Count</span>
            <h3 class="card-title mb-2">{{ $page_count }}</h3>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{ asset('admin') }}/assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Module Count</span>
            <h3 class="card-title mb-2">{{ $module_count }}</h3>
          </div>
        </div>
      </div>
</div>

<div class="row">
  <div class="row">
    <div class="col-lg-12 mb-0 order-0">
        <h3 class="card-title text-primary px-2 py-2">User Login Activity</h3>
    </div>
  </div>
    <div class="table-responsive text-nowrap px-3 py-1">
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Last Login</th>
                    <th>User Name</th>
                    <th>User Email</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($loginhistory as $history)
                    <tr>
                        <td><strong>{{ $loginhistory->firstItem() + $loop->index }}</strong></td>
                        <td>{{ $history->created_at->format('d-M-Y h:i A') }}</td>
                        <td>{{ $history->name }}</td>
                        <td>{{ $history->email }}</td>  
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