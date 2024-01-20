@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('items.index') }}">Item Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Items</li>
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
                    <h6 class="card-title">Item Management</h6>
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="new-customer" data-toggle="modal" data-target="#createModal">New Item</a>
                    <div class="table-responsive">
                        <table id="dataTableItems" class="table">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Description</th>
{{--                                <th>Price</th>--}}
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
{{--                                    <td>RM {{ $item->price }}</td>--}}
                                    <td>
                                        <img alt="Item Picture" class="img-fluid" src="{{ asset('/'.$item->photo_path) }}">
                                    </td>
                                    <td>
                                        <form action="{{ route('items.destroy',$item->id) }}" method="Post">
                                            <a class="btn btn-info show-item" data-id="{{ $item->id }}" data-toggle="modal" data-target="#showModal" href="javascript:void(0)">Show</a>
                                            <a class="btn btn-primary edit" data-id="{{ $item->id }}" data-toggle="modal" data-target="#updateModal" href="javascript:void(0)">Edit</a>
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

    <!-- Create Item Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <!-- Your form for creating a new item goes here -->
        <form action="{{ route('items.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Create New Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <!-- Form fields (e.g., name, description, image) -->
                            <div class="form-group">
                                <label for="addName">Name</label>
                                <input type="text" class="form-control" id="addName" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="addDescription">Description</label>
                                <textarea id="addDescription" name="description" class="form-control" rows="8" placeholder="Write item's description here." required></textarea>
                            </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="addPrice">Price (RM)</label>--}}
{{--                            <input  type="number" min="1" step="any" id="addPrice" name="price" class="form-control" required>--}}
{{--                        </div>--}}
                        <div class="stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Upload Image</h6>
                                    <input type="file" id="myDropify" name="image" class="border" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create Item</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Show Item Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Item Details</h5>
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

    <!-- Update Item Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Update Item Form -->
                    <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating -->

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="8" required></textarea>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label for="price">Price (RM)</label>--}}
{{--                            <input  type="number" min="1" step="any" id="price" name="price" class="form-control" required>--}}
{{--                        </div>--}}

                        <div class="stretch-card">
                            <div class="card">
                                <div class="card-body updateImageContainer">
                                    <h6 class="card-title">Upload Image</h6>
                                    <input type="file" name="image" id="updateDropify" class="border"/>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update Item</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                    <!-- End Update Item Form -->
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
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Recalculate maxCharsPerLine on window resize
            $(window).on('resize', function () {
                console.log('Window resized');
                $('#dataTableItems').DataTable().draw();
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

            var table = $('#dataTableItems').DataTable({
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

            $('#dataTableItems').each(function() {
                var datatable = $(this);
                // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.removeClass('form-control-sm');
                // LENGTH - Inline-Form control
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.removeClass('form-control-sm');
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
                        itemDetailsHtml += '<p><strong>Price:</strong> RM ' + data.price + '</p>';
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
                console.log(data);

                $('#name').val(data[1]);
                $('#description').val(data[2]);
                // $('#price').val(data[3].split(' ')[1]);
                $('#updateDropify').dropify();
                const pattern = /src="([^"]+)"/;
                var match = data[3].match(pattern);

                // Check if a match was found
                if (match && match[1]) {
                    var srcValue = match[1];
                    resetPreview('image', srcValue);
                    console.log(srcValue);
                } else {
                    console.log('No match found' + match + data[3]);
                }

                $('#updateForm').attr('action', '/items/' + data[0]);
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
        });
    </script>
@endpush

