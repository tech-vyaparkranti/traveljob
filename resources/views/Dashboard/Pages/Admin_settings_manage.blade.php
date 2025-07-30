@extends('layouts.dashboardLayout')
@section('title', 'Settings')
@section('content')
    <x-content-div heading="Manage Setting">
        <x-card-element header="Update Setting">
            <x-form-element method="POST" enctype="multipart/form-data" id="submitForm" action="javascript:">
                <x-input type="hidden" name="id" id="id" value=""></x-input>
                <x-input type="hidden" name="action" id="action" value="update"></x-input>

                    <x-input-with-label-element id="company_name" type="text"  label="Company" placeholder="Please Enter Company Name"
                    name="company_name"  ></x-input-with-label-element>



                    <x-input-with-label-element id="email" type="email"  label="Email" placeholder="Please Enter Email"
                    name="email"  ></x-input-with-label-element>

                    <x-input-with-label-element id="logo" type="file" accept="image/*"  label="logo" placeholder="logo"
                    name="logo"   ></x-input-with-label-element>


                    {{-- <x-input-with-label-element id="address" type="text"  label="Address" placeholder="Please Enter Address"
                    name="post" required></x-input-with-label-element> --}}

                    <x-input-with-label-element id="mobile" type="number"  label="mobile" placeholder="mobile"
                    name="mobile"  ></x-input-with-label-element>

                    <x-input-with-label-element id="instagram" type="text"  label="instagram" placeholder="instagram"
                    name="instagram"   ></x-input-with-label-element>

                    <x-input-with-label-element id="facebook" type="text"  label="facebook" placeholder="facebook"
                    name="facebook"  ></x-input-with-label-element>

                    <x-input-with-label-element id="twitter" type="text"  label="twitter" placeholder="twitter"
                    name="twitter"  ></x-input-with-label-element>
                    <x-input-with-label-element id="youtube" type="text"  label="youtube" placeholder="youtube"
                    name="youtube"  ></x-input-with-label-element>
                    <x-input-with-label-element id="address" type="text"  label="address" placeholder="address"
                    name="address"  ></x-input-with-label-element>
                    <x-input-with-label-element id="whatsapp_no" type="number"  label="Whatsapp Number" placeholder="Enter Whatsapp Number"
                    name="whatsapp_no"  ></x-input-with-label-element>
                    <x-input-with-label-element id="call_no" type="number"  label="Call Log" placeholder="Enter Call Number"
                    name="call_no"  ></x-input-with-label-element>
                    <x-input-with-label-element id="copyright_txt" type="text"  label="Copy Right Text" placeholder="copyright_txt"
                    name="copyright_txt"  ></x-input-with-label-element>


                <x-form-buttons></x-form-buttons>
            </x-form-element>

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

        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: "{{ route('setting.data') }}",
                success: function(response) {
                     if (response) {
                         let row = response;
                         $("#id").val(row['0'].id);
                        // $("#logo").val(row['0'].logo);
                        $("#email").val(row['0'].email);
                        $("#mobile").val(row['0'].mobile);
                        $("#company_name").val(row['0'].company_name);
                        $("#instagram").val(row['0'].instagram);
                        $("#facebook").val(row['0'].facebook);
                        $("#twitter").val(row['0'].twitter);
                        $("#youtube").val(row['0'].youtube);
                        $("#address").val(row['0'].address);
                        $("#whatsapp_no").val(row['0'].whatsapp_no);
                        $("#call_no").val(row['0'].call_no);
                        $("#copyright_txt").val(row['0'].copyright_txt);
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
                    url: "{{ route('setting.update.master') }}",
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
