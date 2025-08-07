
@extends('layouts.dashboardLayout')
@section('title', 'About US')
@section('content')
    <x-content-div heading="Manage About US">
        <x-card-element header="Add About US">
            <x-form-element method="POST" enctype="multipart/form-data" id="submitForm" action="javascript:">
                <x-input type="hidden" name="id" id="id" value=""></x-input>
                <x-input type="hidden" name="action" id="action" value="insert"></x-input>

                {{-- Input field for the About Image --}}
                <x-input-with-label-element id="about_image" type="file" accept="image/*" label="About Image"
                    placeholder="About Image" name="about_image"></x-input-with-label-element>

                <x-text-area-with-label div_class="col-md-12 col-sm-12 mb-3" id="sort_about_us"
                    placeholder="Sort About" label="Sort About" name="sort_about_us" required></x-text-area-with-label>

                <x-text-area-with-label div_class="col-md-12 col-sm-12 mb-3" id="about_desc"
                    placeholder="About Us Content" label="About Us" name="about_desc" required></x-text-area-with-label>

                <x-form-buttons></x-form-buttons>
            </x-form-element>
        </x-card-element>

        <x-card-element header="About Us Data">
            <x-data-table>
            </x-data-table>
        </x-card-element>
    </x-content-div>
@endsection

@section('script')

    <script type="text/javascript">
        $('#sort_about_us').summernote({
            placeholder: 'Sort About Text',
            tabsize: 2,
            height: 100
        });
        $('#about_desc').summernote({
            placeholder: 'About Us Content',
            tabsize: 2,
            height: 100
        });
        let site_url = '{{ url('/') }}';
        let table = "";
        $(function() {
            console.log("this is our testing");
            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                "scrollX": true,
                ajax: {
                    url: "{{ route('aboutUs.data') }}",
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        title: "Sr.No."
                    },
                    {
                        data: 'id',
                        name: 'id',
                        title: 'Id',
                        visible: false
                    },
                    {{-- This is the corrected section --}}
                    {
                        data: 'about_image',
                        name: 'about_image',
                        title: 'Image'
                    },
                    {
                        data: 'sort_about_us',
                        name: 'sort_about_us',
                        title: 'Sort About Text',
                        render: function(data, type, row) {
                            var maxLength = 300;
                            var sort_about_us = $('<div>').html(data).text();
                            return sort_about_us.length > maxLength ? sort_about_us.substring(0, maxLength) + '...' : sort_about_us;
                        }
                    },

                    {
                        data: 'about_desc',
                        name: 'about_desc',
                        title: 'About US Content',
                        render: function(data, type, row) {
                            var maxLength = 300;
                            var about_desc = $('<div>').html(data).text();
                            return about_desc.length > maxLength ? about_desc.substring(0, maxLength) + '...' : about_desc;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        title: 'Action'
                    },
                ],
                order: [
                    [1, "desc"]
                ]
            });

        });

        // The rest of your script remains the same
        $(document).on("click", ".edit", function() {
            $.ajax({
                type: 'GET',
                url: "{{ route('aboutUsDataBy.id') }}",
                data: {
                    id: $(this).data("row_id"),
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log("I am get data", response);
                    if (response.status) {
                        let row = response.data;
                        $("#id").val(row['id']);
                        $("#about_desc").val(row['about_desc']);
                        $('#about_desc').summernote('destroy');
                        $('#about_desc').summernote({
                            focus: true
                        });
                        $("#sort_about_us").val(row['sort_about_us']);
                        $('#sort_about_us').summernote('destroy');
                        $('#sort_about_us').summernote({
                            focus: true
                        });

                        $("#action").val("update");

                        scrollToDiv();
                    } else {
                        errorMessage(response.message);
                    }
                },
                failure: function(response) {
                    errorMessage(response.message);
                }
            });


        });

      function DeleteAboutData(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This item will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            if (id !== null && id !== undefined) {
                $.ajax({
                    type: 'POST', // <-- Changed from GET to POST
                    url: "{{ route('aboutUs.delete') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE' // <-- Add method spoofing
                    },
                    success: function(response) {
                        if (response && response.status) { // Check for status in response
                            // Use a success message instead of just logging
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );
                            table.ajax.reload(); // Reload the DataTable
                        } else {
                             // Handle cases where deletion fails but returns a response
                            Swal.fire(
                                'Failed!',
                                response.message || 'Something went wrong.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr) {
                        console.error("Error:", xhr.responseText);
                        Swal.fire(
                            'Error!',
                            'An error occurred. Check the console for details.',
                            'error'
                        );
                    }
                });
            }
        }
    })
}

        $(document).ready(function() {
            $("#submitForm").on("submit", function() {
                var form = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('aboutUs.save.master') }}",
                    data: form,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status) {
                            successMessage(response.message, "reload");
                        } else {
                            errorMessage(response.message);
                        }
                    },
                    failure: function(response) {
                        errorMessage(response.message);
                    }
                });
            });

        });
    </script>
    @include('Dashboard.include.dataTablesScript')
    {{-- @include('Dashboard.include.summernoteScript') --}}
@endsection