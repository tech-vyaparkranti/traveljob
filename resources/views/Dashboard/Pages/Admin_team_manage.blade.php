@extends('layouts.dashboardLayout')
@section('title', 'Team')
@section('content')
    <x-content-div heading="Manage Team">
        <x-card-element header="Add Team">
            <x-form-element method="POST" enctype="multipart/form-data" id="submitForm" action="javascript:">
                <x-input type="hidden" name="id" id="id" value=""></x-input>
                <x-input type="hidden" name="action" id="action" value="insert"></x-input>

                <x-input-with-label-element id="post" type="text" label="Designation"
                    placeholder="Please Enter Designation Name" name="post" required></x-input-with-label-element>

                <x-input-with-label-element id="name" type="text" label="Name"
                    placeholder="Please Enter Name" name="name" required></x-input-with-label-element>

                <x-input-with-label-element id="image" type="file" accept="image/*" label="Image"
                    placeholder="Image" name="image" required></x-input-with-label-element>

                <x-form-buttons></x-form-buttons>
            </x-form-element>

        </x-card-element>

        <x-card-element header="Team Data">
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
                    url: "{{ route('team.data') }}",
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
                }, {
                    data: 'id',
                    name: 'id',
                    title: 'Id',
                    visible: false
                }, {
                    data: 'post',
                    name: 'post',
                    title: 'Designation'
                }, {
                    data: 'name',
                    name: 'name',
                    title: 'Name'
                }, {
                    data: 'image',
                    render: function(data, type, row) {
                        let image = '';
                        if (data) {
                            image += '<img alt="Stored Image" src="' + site_url + data +
                                '" class="img-thumbnail">';
                        }
                        return image;
                    },
                    orderable: false,
                    searchable: false,
                    title: "Image"
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    title: 'Action'
                }, ],
                order: [
                    [1, "desc"]
                ]
            });
        });
        $(document).on("click", ".edit", function() {
            $.ajax({
                type: 'GET',
                url: "{{ route('TeamDataBy.id') }}",
                data: {
                    id: $(this).data("row_id"),
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status) {
                        let row = response.data;
                        $("#id").val(row['id']);
                        $("#name").val(row['name']);
                        $("#post").val(row['post']);
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

        function DeleteData(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This item will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, deleted it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    if (id !== null & id !== undefined) {
                        $.ajax({
                            type: 'GET',
                            url: "{{ route('team.delete') }}",
                            data: {
                                id: id,
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response !== null && response !== undefined) {
                                    console.log("my this slider is deleted");
                                    console.log(response);
                                    window.location.reload();
                                }
                            }
                        })
                    }
                }
            })
        }

        $(document).ready(function() {
            $("#submitForm").on("submit", function() {
                var form = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('team.save.master') }}",
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