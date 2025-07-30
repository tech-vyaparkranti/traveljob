@extends('layouts.dashboardLayout')
@section('title', 'Team')
@section('content')
    <x-content-div heading="Manage Team">
        <x-card-element header="Add Team">
            <x-form-element method="POST" enctype="multipart/form-data" id="submitForm" action="javascript:">
                <x-input type="hidden" name="id" id="id" value=""></x-input>
                <x-input type="hidden" name="action" id="action" value="insert"></x-input>

                    <x-input-with-label-element id="post" type="text"  label="Role" placeholder="Please Enter Role Name"
                    name="post" required></x-input-with-label-element>

                    <x-input-with-label-element id="name" type="text"  label="Name" placeholder="Please Enter Name"
                    name="name" required></x-input-with-label-element>

                    <x-input-with-label-element id="email" type="email"  label="Email" placeholder="Please Enter Email"
                    name="email"  ></x-input-with-label-element>

                    <x-input-with-label-element id="image" type="file" accept="image/*"  label="Image" placeholder="Image"
                    name="image" required></x-input-with-label-element>


                    {{-- <x-input-with-label-element id="address" type="text"  label="Address" placeholder="Please Enter Address"
                    name="post" required></x-input-with-label-element> --}}

                    <x-input-with-label-element id="occupation" type="text"  label="occupation" placeholder="Occupation"
                    name="occupation"  ></x-input-with-label-element>

                    <x-input-with-label-element id="education" type="text"  label="education" placeholder="education"
                    name="education" required ></x-input-with-label-element>

                    <x-input-with-label-element id="expertise" type="text"  label="expertise" placeholder="expertise"
                    name="expertise"  ></x-input-with-label-element>

                    <x-input-with-label-element id="focus" type="text"  label="focus" placeholder="focus"
                    name="focus"  ></x-input-with-label-element>

            <x-text-area-with-label div_class="col-md-12 col-sm-12 mb-3" id="message"
                    placeholder="Message" label="Message" name="message"
                     ></x-text-area-with-label>

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
        $('#message').summernote({
            placeholder: 'Message',
            tabsize: 2,
            height: 100
        });
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
                        title: 'Role'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        title: 'Name'
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
                        data: 'occupation',
                        name: 'occupation',
                        title: 'Occupation'
                    },
                    {
                        data: 'education',
                        name: 'education',
                        title: 'Education'
                    },
                    {
                        data: 'expertise',
                        name: 'expertise',
                        title: 'Expertise'
                    },
                    {
                        data: 'focus',
                        name: 'focus',
                        title: 'Focus'
                    },
                    // {
                    //     data: 'message',
                    //     name: 'message',
                    //     title: 'Message'
                    // },
                    {
                        data: 'message', 
                        name: 'message', 
                        title: 'Message', 
                        render: function(data, type, row) {
                            var maxLength = 150;
                            var message = $('<div>').html(data).text(); 
                            return message.length > maxLength ? message.substring(0, maxLength) + '...' : message;
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
                        $("#email").val(row['email']);
                        $("#name").val(row['name']);
                        $("#post").val(row['post']);
                        $("#occupation").val(row['occupation']);
                        $("#education").val(row['education']);
                        $("#expertise").val(row['expertise']);
                        $("#focus").val(row['focus']);
                        $("#message").val(row['message']);
                        $('#message').summernote('destroy');
                        $('#message').summernote({
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
                             url:"{{ route('team.delete') }}",
                              data:{
                                id:id,
                                '_token': '{{ csrf_token() }}'
                              },
                              success: function(response){
                                if(response !== null && response !== undefined){
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
    {{-- @include('Dashboard.include.summernoteScript') --}}
@endsection
