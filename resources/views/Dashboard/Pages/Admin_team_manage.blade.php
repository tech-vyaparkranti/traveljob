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

                {{-- Message Field with Summernote --}}
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control summernote" id="message" name="message"
                        placeholder="Please Enter Message"></textarea>
                </div>

                {{-- Image Field --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">

                    {{-- Preview old image when editing --}}
                    <div id="imagePreview" class="mt-2" style="display:none;">
                        <p>Current Image:</p>
                        <img src="" id="previewImg" class="img-thumbnail" style="max-width:150px;">
                    </div>
                </div>

                <x-form-buttons></x-form-buttons>
            </x-form-element>
        </x-card-element>

        <x-card-element header="Team Data">
            <x-data-table></x-data-table>
        </x-card-element>
    </x-content-div>
@endsection

@section('script')
    {{-- Summernote CSS & JS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script type="text/javascript">
        let site_url = '{{ url('/') }}';
        let table = "";

        $(function() {
            // Initialize Summernote
            $('.summernote').summernote({
                placeholder: 'Enter message here...',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontsize', 'color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });

            // Initialize DataTable
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
                    },
                    {
                        data: 'id',
                        name: 'id',
                        title: 'Id',
                        visible: false
                    },
                    {
                        data: 'post',
                        name: 'post',
                        title: 'Designation'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        title: 'Name'
                    },
                    {
                        data: 'message',
                        name: 'message',
                        title: 'Message',
                        render: function(data, type, row) {
                            // Show limited text with tooltip
                            let shortText = data ? data.replace(/(<([^>]+)>)/ig, "").substring(0, 50) + '...' : '';
                            return `<span title="${data}">${shortText}</span>`;
                        }
                    },
                    {
                        data: 'image',
                        render: function(data, type, row) {
                            let image = '';
                            if (data) {
                                image += '<img alt="Stored Image" src="' + site_url + data +
                                    '" class="img-thumbnail" style="max-width:100px">';
                            }
                            return image;
                        },
                        orderable: false,
                        searchable: false,
                        title: "Image"
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

        // Handle edit button click
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
                        $('#message').summernote('code', row['message']); // set Summernote content
                        $("#action").val("update");

                        // ✅ Show image preview if exists
                        if (row['image']) {
                            $("#previewImg").attr("src", site_url + row['image']);
                            $("#imagePreview").show();
                        } else {
                            $("#imagePreview").hide();
                        }

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

        // Delete function
        function DeleteData(id) {
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
                            type: 'GET',
                            url: "{{ route('team.delete') }}",
                            data: {
                                id: id,
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response !== null && response !== undefined) {
                                    window.location.reload();
                                }
                            }
                        })
                    }
                }
            })
        }

        // Submit form
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
