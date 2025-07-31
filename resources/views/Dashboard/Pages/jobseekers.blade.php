{{-- In resources/views/Dashboard/Pages/jobseekers.blade.php --}}

@extends('layouts.dashboardLayout')
@section('title', 'Manage Job Seekers')
@section('content')

    <x-content-div heading="Manage Job Seekers">
        <x-card-element header="Job Seeker Data">
            {{-- Export Data Button --}}
            <div style="text-align: right; margin-bottom: 15px;">
                <a href="{{ route('jobseeker.export_data') }}" class="btn btn-success" style="padding: 8px 15px; border-radius: 4px; text-decoration: none; color: white;">
                    Export All Data
                </a>
            </div>

            <x-data-table>
            </x-data-table>
        </x-card-element>
    </x-content-div>
@endsection

@section('script')
@include('Dashboard.include.dataTablesScript')
    <script type="text/javascript">
        let site_url = '{{ url('/') }}';
        let table = "";
        $(function() {
            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                "scrollX": true,
                scrollY: '400px',
                ajax: {
                    url: "{{ route('jobseekersdata') }}",
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    { data: "DT_RowIndex", orderable: false, searchable: false, title: "Sr.No." },
                    { data: 'id', name: 'id', title: 'Id', visible: false },
                    { data: 'given_name', name: 'given_name', title: 'Given Name' },
                    { data: 'family_name', name: 'family_name', title: 'Family Name' },
                    { data: 'personal_email', name: 'personal_email', title: 'Email' },
                    { data: 'mobile_no', name: 'mobile_no', title: 'Mobile No.' },
                    { data: 'total_experience', name: 'total_experience', title: 'Experience (Years)' },
                    {
                        data: 'cv_download',
                        name: 'cv_download',
                        title: 'CV',
                        orderable: false,
                        searchable: false,
                    },
                    { // <-- NEW COLUMN DEFINITION
                        data: 'profile_pdf',
                        name: 'profile_pdf',
                        title: 'Profile PDF',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'created_at_formatted',
                        name: 'created_at',
                        title: 'Applied On',
                        orderable: true,
                        searchable: false,
                    }
                ],
                order: [
                    [1, "desc"]
                ]
            });
        });
    </script>
@endsection