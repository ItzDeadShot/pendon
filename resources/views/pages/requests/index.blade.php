@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('requests.index') }}">Request Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Requests</li>
        </ol>
    </nav>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Request Management</h6>
                    @if(auth()->user()->isAdmin())
                        <a href="javascript:void(0)" class="btn btn-success mb-2" id="new-customer" data-toggle="modal" data-target="#createModal">New Request</a>
                    @endif
                    <div class="table-responsive">
                        <table id="dataTableRequests" class="table">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Proof</th>
                                <th>Item</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($reqs as $req)
                                <tr>
                                    <td>{{ $req->id }}</td>
                                    <td>{{ $req->status }}</td>
                                    <td>{{ $req->description }}</td>
                                    <td>
                                        @if($req->proof === null)
                                            <img alt="N/A" class="img-fluid" src="{{ asset('images/na.jpg') }}">
                                        @else
                                            <img alt="Request Picture" class="img-fluid" src="{{ asset('/'.$req->proof) }}">
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info show-item" data-id="{{ $req->item_id }}" data-toggle="modal" data-target="#showModal" href="javascript:void(0)">Show</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('requests.destroy',$req->id) }}" method="Post">
                                            <a class="btn btn-info show-request" data-id="{{ $req->id }}" data-toggle="modal" data-target="#showModal" href="javascript:void(0)">Show</a>
                                            <a class="btn btn-primary edit" data-id="{{ $req->id }}" data-toggle="modal" data-target="#updateModal" href="javascript:void(0)">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
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

    <!-- Create Request Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <!-- Your form for creating a new item goes here -->
        <form action="{{ route('requests.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Create New Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <!-- Form fields (e.g., name, description, image) -->
                            <div class="form-group">
                                <label for="addStatus">Status</label>
                                <select class="form-control" id="addStatusCreate" name="status" required>
                                    <option value="pending">Pending</option>
                                    <option value="accepted">Accepted</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="addDescription">Description</label>
                                <textarea id="addDescription" name="description" class="form-control" maxlength="100" rows="8" placeholder="This textarea has a limit of 100 chars." required></textarea>
                            </div>
                            <div class="form-group">
                                <div class="mb-4">
                                    <label for="phone" style="display: block;">Phone Number</label>
                                    <input type="tel" name="phone" id="phone" class="form-control" autocomplete="off" data-intl-tel-input-id="0" placeholder="(201) 555-0123">
                                </div>
                                <div class="mb-4">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                                </div>
                            </div>
                            <div class="stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Upload Proof (Bank Statement etc.)</h6>
                                        <input type="file" id="myDropify" name="image" class="border" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="addItem">Select Item</label>
                                <select id="addItem" name="item_id" class="form-control" required>
                                    <option value="" disabled selected>Select an item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create Request</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Show Request Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Request Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="showModalBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Request Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Update Request Form -->
                    <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating -->

                        <div class="form-group">
                            <label for="addStatus">Status</label>
                            <select class="form-control" id="addStatusUpdate" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="accepted">Accepted</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" maxlength="100" rows="8" required></textarea>
                        </div>

                        <div class="stretch-card">
                            <div class="card">
                                <div class="card-body updateImageContainer">
                                    <h6 class="card-title">Upload Image</h6>
                                    <input type="file" name="image" id="updateDropify" class="border"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="addItem">Select Item</label>
                            <select id="addItemUpdate" name="item_id" class="form-control" required>
                                <option value="" disabled selected>Select an item</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update Request</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                    <!-- End Update Request Form -->
                </div>
            </div>
        </div>
    </div>

@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.24/dataRender/ellipsis.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Recalculate maxCharsPerLine on window resize
            $(window).on('resize', function () {
                $('#dataTableRequests').DataTable().draw();
            });

            function calculateMaxCharsPerLine() {
                // Adjust the factor based on your specific requirements
                var factor = 0.04;
                // Get the width of the DataTable container
                var tableWidth = window.innerWidth;
                // Calculate maxCharsPerLine based on the table width
                var maxCharsPerLine = Math.floor(tableWidth * factor);
                return maxCharsPerLine;
            }

            var table = $('#dataTableRequests').DataTable({
                "width": "100%",
                "scrollX": false,
                "aLengthMenu": [
                    [10, 30, 50, -1],
                    [10, 30, 50, "All"]
                ],
                "iDisplayLength": 10,
                "language": {
                    search: ""
                },
                "columnDefs": [
                    { "width": "20%", "targets": 2 },
                    {
                        "targets": [2],
                        "render": function (data, type, row) {
                            // Calculate the maximum characters per line dynamically based on the table width
                            var maxCharsPerLine = calculateMaxCharsPerLine();

                            // Split the text into lines
                            var lines = [];
                            for (var i = 0; i < data.length; i += maxCharsPerLine) {
                                lines.push(data.substr(i, maxCharsPerLine));
                            }

                            // Join the lines with <br> for multiline display
                            return lines.join('<br>');
                        }
                    }
                ]
            });

            $('#dataTableRequests').each(function() {
                var datatable = $(this);
                // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.removeClass('form-control-sm');
                // LENGTH - Inline-Form control
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.removeClass('form-control-sm');
            });

            $('.show-request').on('click', function () {
                var requestId = $(this).data('id'), url = '/requests/' + requestId;

                // Make an AJAX request to fetch item details
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Update the content of #showModalBody with the fetched details
                        var itemDetailsHtml = '<p><strong>Status:</strong> ' + data.status + '</p>';
                        itemDetailsHtml += '<p><strong>Email:</strong> ' + data.email + '</p>';
                        itemDetailsHtml += '<p><strong>Phone:</strong> ' + data.phone + '</p>';
                        itemDetailsHtml += '<p><strong>Description:</strong> ' + data.description + '</p>';
                        if (data.proof === null)
                            itemDetailsHtml += '<p><strong>Proof:</strong></p> <br>' + '<img alt="N/A" class="img-fluid" src="{{ asset('images/na.jpg') }}" >';
                        else
                            itemDetailsHtml += '<p><strong>Proof:</strong></p> <br>' + '<img alt="Request Picture" class="img-fluid" src="/' + data.proof + '" >';
                        $('#showModalBody').html(itemDetailsHtml);
                    },
                    error: function (error) {
                        console.error('Error fetching item details:', error);
                        // Handle an error scenario, e.g., display an error message in the modal
                        $('#showModalBody').html('<p>Error fetching item details.</p>');
                    }
                });
            });

            $('.show-item').on('click', function () {
                var itemId = $(this).data('id'), url = '/items/' + itemId;

                // Make an AJAX request to fetch item details
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Update the content of #showModalBody with the fetched details
                        var itemDetailsHtml = '<p><strong>Name:</strong> ' + data.name + '</p>';
                        itemDetailsHtml += '<p><strong>Description:</strong> ' + data.description + '</p>';
                        itemDetailsHtml += '<p><strong>Photo:</strong></p> <br>' + '<img alt="Item Picture" class="img-fluid" src="/' + data.photo_path + '" >';
                        $('#showModalBody').html(itemDetailsHtml);
                    },
                    error: function (error) {
                        console.error('Error fetching item details:', error);
                        // Handle an error scenario, e.g., display an error message in the modal
                        $('#showModalBody').html('<p>Error fetching item details.</p>');
                    }
                });
            });

            table.on('click', '.edit', function () {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();

                $('#addStatusUpdate').val(data[1]);
                $('#description').val(data[2]);
                $('#updateDropify').dropify();
                const pattern_image = /src="([^"]+)"/;
                var match_image = data[3].match(pattern_image);
                const pattern_id = /data-id="(\d+)"/;
                var match_id = data[4].match(pattern_id);

                // Check if a match was found
                if (match_image && match_image[1]) {
                    var srcValue = match_image[1];
                    resetPreview('image', srcValue);
                } else {
                    console.log('No match found' + match_image + data[3]);
                }

                // Check if a match was found
                if (match_id && match_id[1]) {
                    var srcValue = match_id[1];
                    $('#addItemUpdate').val(srcValue);
                } else {
                    console.log('No match found' + match_id + data[4]);
                }

                $('#updateForm').attr('action', '/requests/' + data[0]);
                $('#updateModal').modal('show');
            });

            function resetPreview(name, src, fname = '') {
                let input = $('input[name="' + name + '"]');
                let wrapper = input.closest('.dropify-wrapper');
                let preview = wrapper.find('.dropify-preview');
                let filename = wrapper.find('.dropify-filename-inner');
                let render = wrapper.find('.dropify-render').html('');

                input.val('').attr('title', fname);
                wrapper.removeClass('has-error').addClass('has-preview');
                filename.html(fname);

                render.append($('<img />').attr('src', src).css('max-height', input.data('height') || ''));
                preview.fadeIn();
            }

            const input = document.querySelector("#phone");
            window.intlTelInput(input, {
                initialCountry: "auto",
                geoIpLookup: callback => {
                    fetch("https://ipapi.co/json")
                        .then(res => res.json())
                        .then(data => callback(data.country_code))
                        .catch(() => callback("us"));
                },
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
            });
        });

    </script>
@endpush

