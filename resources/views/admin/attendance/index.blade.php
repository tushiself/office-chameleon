@extends('layouts.admin')
@section('content')
    <div class="mt-10 lg:mt-11">
        <h2 class="font-bold text-base"> All Today Attendance</h2>
        <div class="bg-white shadow-primary mt-5.5 rounded-10px">
            <div class="bg-lightgraybg px-8.5 py-6 font-medium rounded-t-10px border-b-2 border-gray">
                <p>Attendance Records</p>
            </div>
            <div class="p-5 lg:p-8">
                <div class="flex flex-wrap gap-3 md:gap-5">
                    <div
                        class="flex flex-col font-medium gap-5 bg-lightgraybg p-3.5 rounded-10px shadow-primary md:min-w-[200px] text-xs md:text-sm w-[calc(50%-6px)] md:w-auto">
                        <span>Total Employee Present (Today)</span>
                        <h3 class="font-bold text-4xl md:text-5xl text-purple">{{ $presentCount }}</h3>
                    </div>
                    <div
                        class="flex flex-col font-medium gap-5 bg-lightgraybg p-3.5 rounded-10px shadow-primary md:min-w-[200px] text-xs md:text-sm w-[calc(50%-6px)] md:w-auto">
                        <span>Employee Absent (Today)</span>
                        <h3 class="font-bold text-4xl md:text-5xl text-danger">{{ $absentCount }}</h3>
                    </div>
                </div>
                
                <div class="mt-5 custom-table-main">
                    <table class="table-leavetype display nowrap custom-table custom-table-order" style="width:100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Full Name</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Total Hours</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script>
        $(document).ready(function() {
            $('.table-leavetype').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('attendance.index') }}',
                columns: [{
                        data: 'date',
                        name: 'date'
                    },
                   
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'time_in',
                        name: 'time_in'
                    },
                    {
                        data: 'time_out',
                        name: 'time_out'
                    },
                    {
                        data: 'total_hr',
                        name: 'total_hr'
                    },
                    {
                        data: 'check_in_type',
                        name: 'check_in_type'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>

    <script>
        $(document).on('click', '.delete-attendance-btn', function () {
            const id = $(this).data('id');
    
            Swal.fire({
                title: 'Are you sure?',
                text: "This attendance record will be deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/chameleon/attendance/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Attendance record has been deleted.',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            });
    
                            $('.table-leavetype').DataTable().ajax.reload();
                        },
                        error: function () {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong. Try again later.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    </script>
    
@endsection
