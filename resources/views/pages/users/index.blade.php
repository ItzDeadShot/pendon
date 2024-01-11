@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">User Management</h6>
                    <a href="javascript:void(0)" class="btn btn-success mb-2 mr-auto" id="new-customer" data-toggle="modal" data-target="#createModal">New User</a>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
                                    <td>
                                        <form action="{{ route('users.destroy',$user->id) }}" method="Post">
                                            <a class="btn btn-info show-user" data-id="{{ $user->id }}" data-toggle="modal" data-target="#showModal" href="javascript:void(0)">Show</a>
{{--                                            <a class="btn btn-primary" data-id="{{ $user->id }}" data-toggle="modal"  href="{{ route('users.edit',$user->id) }}">Edit</a>--}}
{{--                                            <a class="btn btn-primary" data-id="{{ $user->id }}" data-toggle="modal" data-target="#editModal" href="javascript:void(0)">Edit</a>--}}
                                            @csrf
{{--                                            @method('DELETE')--}}
{{--                                            <button type="submit" class="btn btn-danger">Delete</button>--}}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your form for creating a new user goes here -->
                    <form action="{{ route('users.store') }}" method="post" id="signupForm">
                        @csrf
                        <!-- Form fields (e.g., name, email, password, roles) -->
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <label for="roles">Roles</label>
                            <select class="form-control" id="roles" name="roles[]" multiple>
                                <option value="admin">Admin</option>
                                <option value="donor">Donor</option>
                                <option value="donee">Donee</option>
                            </select>
                        </div>
                        <!-- Add more fields as needed -->

                        <button type="submit" class="btn btn-primary">Create User</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Show User Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="showModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit User Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.show-user').on('click', function () {
                var userId = $(this).data('id'), url = '/users/' + userId;

                // Make an AJAX request to fetch user details
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Update the content of #showModalBody with the fetched details
                        var userDetailsHtml = '<p><strong>Name:</strong> ' + data.name + '</p>';
                        userDetailsHtml += '<p><strong>Email:</strong> ' + data.email + '</p>';
                        userDetailsHtml += '<p><strong>Role(s):</strong> ' + data.roles.join(', ') + '</p>';
                        $('#showModalBody').html(userDetailsHtml);
                    },
                    error: function (error) {
                        console.error('Error fetching user details:', error);
                        // Handle an error scenario, e.g., display an error message in the modal
                        $('#showModalBody').html('<p>Error fetching user details.</p>');
                    }
                });
            });
        });
    </script>
@endpush

