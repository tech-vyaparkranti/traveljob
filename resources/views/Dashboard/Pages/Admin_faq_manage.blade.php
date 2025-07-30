@extends('layouts.dashboardLayout')
@section('title', 'FAQ')
@section('content')
    <x-content-div heading="Manage FAQ">
        <x-card-element header="Add FAQ">
            <x-form-element method="POST" enctype="multipart/form-data" id="submitForm" action="javascript:">
                <x-input type="hidden" name="id" id="id" value=""></x-input>
                <x-input type="hidden" name="action" id="action" value="insert"></x-input>


            <x-text-area-with-label div_class="col-md-12 col-sm-12 mb-3" id="faq_question"
                    placeholder="Please Write FAQ Question" label="FAQ Question" name="faq_question"
                     ></x-text-area-with-label>

            <x-text-area-with-label div_class="col-md-12 col-sm-12 mb-3" id="faq_answer"
                    placeholder="Please Write FAQ Answer" label="FAQ Answer" name="faq_answer"
                     ></x-text-area-with-label>

                <x-form-buttons></x-form-buttons>
            </x-form-element>

        </x-card-element>

        <x-card-element header="FAQ Data">
            <x-data-table>

            </x-data-table>
        </x-card-element>
    </x-content-div>
@endsection

@section('script')

    <script type="text/javascript">
        $('#faq_question').summernote({
            placeholder: 'Please Write FAQ Question',
            tabsize: 2,
            height: 100
        });
        $('#faq_answer').summernote({
            placeholder: 'Please Write FAQ Answer',
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
            url: "{{ route('faq.data') }}",
            type: 'POST',
            data: {
                '_token': '{{ csrf_token() }}'
            }
        },
        columns: [
            {
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
                data: 'faq_question', 
                name: 'faq_question', 
                title: 'Faq Question', 
                render: function(data, type, row) {
                    var maxLength = 200;
                    var faq_question = $('<div>').html(data).text(); 
                    return faq_question.length > maxLength ? faq_question.substring(0, maxLength) + '...' : faq_question;
                }
            },
            {
                data: 'faq_answer', 
                name: 'faq_answer', 
                title: 'Faq Answer', 
                render: function(data, type, row) {
                    var maxLength = 200;
                    var faq_answer = $('<div>').html(data).text(); 
                    return faq_answer.length > maxLength ? faq_answer.substring(0, maxLength) + '...' : faq_answer;
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
                url: "{{ route('faqDataBy.id') }}",
                data: {
                    id: $(this).data("row_id"),
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                     if (response.status) {
                        let row = response.data;
                        $("#id").val(row['id']);
                        $("#faq_question").val(row['faq_question']);
                        // $("#p_img").val(row['p_img']);
                        $("#faq_answer").val(row['faq_answer']);
                        $('#faq_answer').summernote('destroy');
                        $('#faq_answer').summernote({
                            focus: true
                        });
                        $('#faq_question').summernote('destroy');
                        $('#faq_question').summernote({
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
                             url:"{{ route('faq.delete') }}",
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
                    url: "{{ route('faq.save.master') }}",
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
