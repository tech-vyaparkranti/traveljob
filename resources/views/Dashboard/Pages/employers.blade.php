@extends('layouts.dashboardLayout')
@section('title', 'Manage Employers')
@section('content')

    <x-content-div heading="Manage Employers">
        <x-card-element header="Employer Data">
            {{-- Export Data Button --}}
            <div style="text-align: right; margin-bottom: 15px;">
                <a href="{{ route('employer.export_data') }}" class="btn btn-success" style="padding: 8px 15px; border-radius: 4px; text-decoration: none; color: white;">
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
                    url: "{{ route('employersdata') }}",
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    { data: "DT_RowIndex", orderable: false, searchable: false, title: "Sr.No." },
                    { data: 'id', name: 'id', title: 'Id', visible: false },
                    { data: 'company_name', name: 'company_name', title: 'Company Name' },
                    { data: 'contact_person', name: 'contact_person', title: 'Contact Person' },
                    { data: 'contact_email', name: 'contact_email', title: 'Email' },
                    { data: 'contact_mobile', name: 'contact_mobile', title: 'Mobile No.' },
                    { data: 'min_travel_trade_experience_years', name: 'min_travel_trade_experience_years', title: 'Experience (Years)' },
                    {
                        data: 'created_at_formatted',
                        name: 'created_at',
                        title: 'Applied On',
                        orderable: true,
                        searchable: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        title: 'Action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [1, "desc"]
                ]
            });
        });
    </script>
@endsection