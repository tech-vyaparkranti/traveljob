
@extends('layouts.dashboardLayout')
@section('title', 'Services')
@section('content')

    <x-content-div heading="Manage Services">
        <x-card-element header="Add Services">
            <x-form-element method="POST" enctype="multipart/form-data" id="submitForm" action="javascript:">
                <x-input type="hidden" name="id" id="id" value=""></x-input>
                <x-input type="hidden" name="action" id="action" value="insert"></x-input>

                <x-input-with-label-element id="service_name" label="Service Name" placeholder="Service Name"
                    name="service_name" required></x-input-with-label-element>

                <x-input-with-label-element id="image" label="Service Image" type="file"
                    placeholder="Service Image" name="image" required="true"></x-input-with-label-element>

                {{-- The service icon and service details fields have been removed --}}

                <x-input-with-label-element id="sorting_number" label="Sorting Number" type="numeric" minVal="1"
                    placeholder="Sorting Number" name="position" required="true"></x-input-with-label-element>

                <x-form-buttons></x-form-buttons>
            </x-form-element>

        </x-card-element>

        <x-card-element header="Services Data">
            <x-data-table>

            </x-data-table>
        </x-card-element>
    </x-content-div>
@endsection

@section('script')

    <script type="text/javascript">
        let site_url = '{{ url('/') }}';
        let table = "";
        $(function() {
            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                "scrollX": true,
                ajax: {
                    url: "{{ route('ourServicesData') }}",
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
                    {
                        data: 'service_name',
                        name: 'service_name',
                        title: 'Service Name'
                    },
                    // The service_icon column has been removed from the DataTables configuration
                    {
                        data: 'image',
                        render: function(data, type, row) {
                            let image = '';
                            if (data) {
                                image = '<img src="' + data + '" class="img-thumbnail"/>'
                            }
                            return image;
                        },
                        orderable: false,
                        searchable: false,
                        title: "Image"
                    },
                    // The service_details column has been removed from the DataTables configuration
                    {
                        data: 'position',
                        name: 'position',
                        title: 'Listing Position'
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
        $(document).on("click", ".edit", function() {
            let row = $.parseJSON(atob($(this).data("row")));
            if (row['id']) {
                console.log(row);
                $("#action").val("update");
                $("#id").val(row['id']);
                $("#service_name").val(row['service_name']);
                $("#sorting_number").val(row['position']);
                // The following lines for image, service_icon, and service_details have been removed
                $("#image").val(''); // Clear the file input for a new upload
                scrollToDiv();
            } else {
                errorMessage("Something went wrong. Code 101");
            }
        });

        // The functions for Disable and Enable remain the same...

        function Disable(id) {
            changeAction(id, "disable", "This item will be disabled!", "Yes, disable it!");
        }

        function Enable(id) {
            changeAction(id, "enable", "This item will be enabled!", "Yes, enable it!");
        }

        function changeAction(id, action, text, confirmButtonText) {
            if (id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: confirmButtonText
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('saveOurServicesMaster') }}',
                            data: {
                                id: id,
                                action: action,
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status) {
                                    successMessage(response.message, true);
                                    table.ajax.reload();
                                } else {
                                    errorMessage(response.message);
                                }
                            },
                            failure: function(response) {
                                errorMessage(response.message);
                            }
                        });
                    }
                });
            } else {
                errorMessage("Something went wrong. Code 102");
            }
        }


        $(document).ready(function() {
            $("#submitForm").on("submit", function() {
                var form = new FormData(this);
                console.log("this is our form action on both condition like on insert and on update data " + form);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('saveOurServicesMaster') }}',
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
@endsection
