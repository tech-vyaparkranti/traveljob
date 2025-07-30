@extends('layouts.dashboardLayout')
@section('title', 'Blog')
@section('content')
    <x-content-div heading="Manage Blog">
        <x-card-element header="Add Blog">
            <x-form-element method="POST" enctype="multipart/form-data" id="submitForm" action="javascript:">
                <x-input type="hidden" name="id" id="id" value=""></x-input>
                <x-input type="hidden" name="action" id="action" value="insert"></x-input>

                    <x-input-with-label-element id="blog_title" type="text"  label="Blog Title" placeholder="Please Enter Blog Title"
                    name="blog_title" required></x-input-with-label-element>


                    <x-input-with-label-element id="image" type="file" accept="image/*"  label="Image" placeholder="Image"
                    name="image" required></x-input-with-label-element>


            <x-text-area-with-label div_class="col-md-12 col-sm-12 mb-3" id="blog_desc"
                    placeholder="Please Write Blog Description" label="Blog Description" name="blog_desc"
                     ></x-text-area-with-label>

                <x-form-buttons></x-form-buttons>
            </x-form-element>

        </x-card-element>

        <x-card-element header="Blog Data">
            <x-data-table>

            </x-data-table>
        </x-card-element>
    </x-content-div>
@endsection

@section('script')

    <script type="text/javascript">
        $('#blog_desc').summernote({
            placeholder: 'Please Write Blog Description',
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
                    url: "{{ route('blog.data') }}",
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
                        data: 'blog_title',
                        name: 'blog_title',
                        title: 'Blog Title'
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
                        title: "Blog Image"
                    },
                    // {
                    //     data: 'blog_desc',
                    //     name: 'blog_desc',
                    //     title: 'Blog Description'
                    // },
                    {
                        data: 'blog_desc', 
                        name: 'blog_desc', 
                        title: 'Blog Description', 
                        render: function(data, type, row) {
                            var maxLength = 300;
                            var blog_desc = $('<div>').html(data).text(); 
                            return blog_desc.length > maxLength ? blog_desc.substring(0, maxLength) + '...' : blog_desc;
                        }
                    },
                    {
                        data: 'blog_date',
                        name: 'blog_date',
                        title: 'Blog Date'
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
                url: "{{ route('blogDataBy.id') }}",
                data: {
                    id: $(this).data("row_id"),
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                     if (response.status) {
                        let row = response.data;
                        $("#id").val(row['id']);
                        $("#blog_title").val(row['blog_title']);
                        // $("#p_img").val(row['p_img']);
                        $("#blog_desc").val(row['blog_desc']);
                        $('#blog_desc').summernote('destroy');
                        $('#blog_desc').summernote({
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
                             url:"{{ route('blog.delete') }}",
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
                    url: "{{ route('blog.save.master') }}",
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
