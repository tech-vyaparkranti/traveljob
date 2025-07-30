@extends('layouts.dashboardLayout')
@section('title', 'Partners')
@section('content')
    <x-content-div heading="Manage Partners">
        <x-card-element header="Add Partner">
            <x-form-element method="POST" enctype="multipart/form-data" id="submitForm" action="javascript:">
                <x-input type="hidden" name="id" id="id" value=""></x-input>
                <x-input type="hidden" name="action" id="action" value="insert"></x-input>
                    <x-select-label-group id="image_type" name="image_type" label_text="Image Type" required="true">
                         <option value="1">Partner</option>
                         <option value="2">Recognitions</option>
                        </x-select-label-group>

                    <x-input-with-label-element id="image" type="file" accept="image/*"  label="Image" placeholder="Image"
                    name="image" required></x-input-with-label-element>
                <x-form-buttons></x-form-buttons>
            </x-form-element>

        </x-card-element>

        <x-card-element header="Partners Data">
            <x-data-table>

            </x-data-table>
        </x-card-element>
    </x-content-div>
@endsection

@section('script')

    <script type="text/javascript">
        // $('#p_desc').summernote({
        //     placeholder: 'Please Write Product Description',
        //     tabsize: 2,
        //     height: 100
        // });
        let site_url = '{{ url('/') }}';
        let table = "";
        $(function() {
             table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                "scrollX": true,
                ajax: {
                    url: "{{ route('partner.data') }}",
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
                        data: 'image_type',
                        name: 'image_type',
                        title: 'Image Type'
                    },
                    {
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
            $.ajax({
                type: 'GET',
                url: "{{ route('partnerDataBy.id') }}",
                data: {
                    id: $(this).data("row_id"),
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                     if (response.status) {
                        let row = response.data;
                        $("#id").val(row['id']);
                        $("#image_type").val(row['image_type']);
                        // $("#p_img").val(row['p_img']);
                        // $("#file").val(row['file']);

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

        function DeleteData(id){
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
                          if(id !== null & id !== undefined){
                           $.ajax({
                            type:'GET',
                             url:"{{ route('partner.delete') }}",
                              data:{
                                id:id,
                                '_token': '{{ csrf_token() }}'
                              },
                              success: function(response){
                                if(response !== null && response !== undefined){
                                     console.log(response);
                                    window.location.reload();
                                }
                              }
                           })
                          }
                    }
                })
        }


        // function Disable(id) {
        //     changeAction(id, "disable", "This item will be disabled!", "Yes, disable it!");
        // }

        // function Enable(id) {
        //     changeAction(id, "enable", "This item will be enabled!", "Yes, enable it!");
        // }

        // function changeAction(id, action, text, confirmButtonText) {
        //     if (id) {
        //         Swal.fire({
        //             title: 'Are you sure?',
        //             text: text,
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: confirmButtonText
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 $.ajax({
        //                     type: 'POST',
        //                     url: "{{ route('saveTestimonialsMaster') }}",
        //                     data: {
        //                         id: id,
        //                         action: action,
        //                         '_token': '{{ csrf_token() }}'
        //                     },
        //                     success: function(response) {
        //                         if (response.status) {
        //                             successMessage(response.message, true);
        //                             table.ajax.reload();
        //                         } else {
        //                             errorMessage(response.message);
        //                         }
        //                     },
        //                     failure: function(response) {
        //                         errorMessage(response.message);
        //                     }
        //                 });
        //             }
        //         });
        //     } else {
        //         errorMessage("Something went wrong. Code 102");
        //     }
        // }


        $(document).ready(function() {
            $("#submitForm").on("submit", function() {
                var form = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('partner.save.master') }}",
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
