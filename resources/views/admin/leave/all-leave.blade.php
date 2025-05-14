@extends('layouts.admin')
@section('content')
    <!-- data -->
    <div class="mt-10 lg:mt-11">
        <h2 class="font-bold text-base">All Staff Leave Requests</h2>
        <div class="bg-white shadow-primary mt-5.5 rounded-10px">
            <div class="bg-lightgraybg py-5 px-8.5 rounded-t-10px border-b-2 border-gray font-medium">
                <p>Summary Leave Request ({{ $leave->count() }})</p>
            </div>
            <div class="p-5 lg:p-8 custom-table-main">
                <form method="GET" class="mb-4">
                    <label for="status">Filter by Status:</label>
                    <select name="status" id="status" class="border rounded px-3 py-1">
                        <option value="">Show all</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Pending</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Approved</option>
                        <option value="2" {{ request('status') === '2' ? 'selected' : '' }}>Not Approved</option>
                    </select>
                    <button type="submit" class="ml-2 px-3 py-1 bg-purple text-white rounded">Filter</button>
                </form>


                <div class="flex flex-wrap -mx-4 mt-4">
                    @foreach ($leave as $request)
                        <div class="w-full xl:w-1/2 2xl:w-1/3 px-4 my-4">
                            <div class="border-2 border-gray bg-lightgraybg rounded-lg p-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        @if ($request->leave_status == 1)
                                            <span
                                                class="text-green bg-green w-9 h-9 inline-flex items-center justify-center rounded-sm">
                                                <span
                                                    class="w-5 h-5 bg-white flex items-center justify-center rounded-full">
                                                    <svg width="11" height="8" viewBox="0 0 11 8" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M10.275 0.225C9.975 -0.075 9.525 -0.075 9.225 0.225L3.6 5.85L1.275 3.525C0.975 3.225 0.525 3.225 0.225 3.525C-0.075 3.825 -0.075 4.275 0.225 4.575L3.075 7.425C3.225 7.575 3.375 7.65 3.6 7.65C3.825 7.65 3.975 7.575 4.125 7.425L10.275 1.275C10.575 0.975 10.575 0.525 10.275 0.225Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </span>
                                        @elseif ($request->leave_status == 2)
                                            <span
                                                class="text-danger bg-danger w-9 h-9 inline-flex items-center justify-center rounded-sm">
                                                <span
                                                    class="w-5 h-5 bg-white flex items-center justify-center rounded-full">
                                                    <svg width="11" height="8" viewBox="0 0 11 8" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M10.275 0.225C9.975 -0.075 9.525 -0.075 9.225 0.225L3.6 5.85L1.275 3.525C0.975 3.225 0.525 3.225 0.225 3.525C-0.075 3.825 -0.075 4.275 0.225 4.575L3.075 7.425C3.225 7.575 3.375 7.65 3.6 7.65C3.825 7.65 3.975 7.575 4.125 7.425L10.275 1.275C10.575 0.975 10.575 0.525 10.275 0.225Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </span>
                                        @elseif ($request->leave_status == 0)
                                            <span
                                                class="text-darkyellow bg-darkyellow w-9 h-9 inline-flex items-center justify-center rounded-sm">
                                                <span
                                                    class="w-5 h-5 bg-white flex items-center justify-center rounded-full">
                                                    <svg width="11" height="8" viewBox="0 0 11 8" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M10.275 0.225C9.975 -0.075 9.525 -0.075 9.225 0.225L3.6 5.85L1.275 3.525C0.975 3.225 0.525 3.225 0.225 3.525C-0.075 3.825 -0.075 4.275 0.225 4.575L3.075 7.425C3.225 7.575 3.375 7.65 3.6 7.65C3.825 7.65 3.975 7.575 4.125 7.425L10.275 1.275C10.575 0.975 10.575 0.525 10.275 0.225Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </span>
                                        @endif

                                        <div>
                                            @if ($request->leave_status == 1)
                                                <p class="text-green font-semibold">Approved</p>
                                            @elseif ($request->leave_status == 0)
                                                <p class="text-darkyellow font-semibold">Pending</p>
                                            @elseif ($request->leave_status == 2)
                                                <p class="text-danger font-semibold">Not Approved</p>
                                            @else
                                                <span class="badge bg-danger me-2"><i class="bi bi-x-circle-fill"></i>
                                                    Something Wrong</span>
                                            @endif
                                            {{-- <p class="text-green font-semibold">Approved</p> --}}
                                            <p class="text-lightgray text-xs">Created on
                                                {{ \Carbon\Carbon::parse($request->created_at)->format('d M, Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <button class="dropdown-toggle cursor-pointer"><svg width="5" height="17"
                                                viewBox="0 0 5 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M-9.28867e-08 14.875C-1.44187e-07 16.0486 0.951395 17 2.125 17C3.29861 17 4.25 16.0486 4.25 14.875C4.25 13.7014 3.29861 12.75 2.125 12.75C0.951395 12.75 -4.15868e-08 13.7014 -9.28867e-08 14.875Z"
                                                    fill="#C3CAD9" />
                                                <path
                                                    d="M-9.28867e-08 8.5C-1.44187e-07 9.6736 0.951395 10.625 2.125 10.625C3.29861 10.625 4.25 9.6736 4.25 8.5C4.25 7.32639 3.29861 6.375 2.125 6.375C0.951395 6.375 -4.15868e-08 7.32639 -9.28867e-08 8.5Z"
                                                    fill="#C3CAD9" />
                                                <path
                                                    d="M-9.28867e-08 2.125C-1.44187e-07 3.2986 0.951395 4.25 2.125 4.25C3.29861 4.25 4.25 3.2986 4.25 2.125C4.25 0.951395 3.29861 -4.15868e-08 2.125 -9.28867e-08C0.951395 -1.44187e-07 -4.15868e-08 0.951395 -9.28867e-08 2.125Z"
                                                    fill="#C3CAD9" />
                                            </svg>
                                        </button>
                                        <ul
                                            class="dropdown-menu absolute right-0 top-full w-28 rounded-10px p-4.5 bg-white shadow-primary text-xs font-medium space-y-3 invisible opacity-0 duration-300">
                                            <li><a href="" data-leave-id="{{ $request->id }}"
                                                    data-user-name="{{ $request->user->first_name }} {{ $request->user->last_name }}"
                                                    data-leave-type="{{ $request->leavetype->leave_type }}"
                                                    data-leave-status="{{ $request->leave_status }}"
                                                    data-start-date="{{ \Carbon\Carbon::parse($request->from_date)->format('d M, Y') }}"
                                                    data-end-date="{{ \Carbon\Carbon::parse($request->to_date)->format('d M, Y') }}"
                                                    data-requested-days="{{ $request->requested_days }}"
                                                    data-remarks="{{ $request->remarks }}"
                                                    data-first-name="{{ $request->user->first_name }}"
                                                    data-last-name="{{ $request->user->last_name }}"
                                                    class="duration-300 cursor-pointer hover:text-purple popup-button">Review</a>
                                            </li>
                                            @if ($request->leave_status == 0 && \Carbon\Carbon::parse($request->from_date)->isFuture())
                                                <li>
                                                    <a href="{{ route('leave.edit', $request->id) }}"
                                                        class="duration-300 cursor-pointer hover:text-purple">
                                                        Edit Request
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-id="{{ $request->id }}"
                                                        class="delete-button duration-300 cursor-pointer hover:text-purple delete-leave-link">
                                                        Delete
                                                    </a>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                                <div class="my-4.5">
                                    <p class="font-semibold text-base">{{ $request->leavetype->leave_type }}</p>
                                    <p class="font-bold mt-1.5"><span class="text-lightgray font-medium">From:</span>
                                        {{ \Carbon\Carbon::parse($request->from_date)->format('d M, Y') }}<span
                                            class="text-lightgray ml-4 font-medium">To:</span>
                                        {{ \Carbon\Carbon::parse($request->to_date)->format('d M, Y') }}</span>
                                    </p>
                                </div>
                                <p><span class="text-lightgray font-medium">Requested Days:</span>
                                    {{ $request->requested_days }}</p>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>

    <!-- popup -->
    <div
        class="popup-main fixed z-40 lg:max-w-[calc(100%-386px)] xl:max-w-[calc(100%-406px)] w-full ml-auto inset-y-0 right-0 left-5 lg:left-10 xl:left-14 duration-300 opacity-0 invisible">
        <div
            class="z-10 w-full max-w-[320px] sm:max-w-[450px] bg-white absolute top-1/2 left-1/2 -translate-1/2 rounded-10px p-8">
            <h2 class="text-sm sm:text-base font-bold mb-3.5 text-center flex items-center justify-center gap-3.5"><svg
                    width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="11" stroke="#8833FF" stroke-width="2" />
                    <path
                        d="M17.275 8.225C16.975 7.925 16.525 7.925 16.225 8.225L10.6 13.85L8.275 11.525C7.975 11.225 7.525 11.225 7.225 11.525C6.925 11.825 6.925 12.275 7.225 12.575L10.075 15.425C10.225 15.575 10.375 15.65 10.6 15.65C10.825 15.65 10.975 15.575 11.125 15.425L17.275 9.275C17.575 8.975 17.575 8.525 17.275 8.225Z"
                        fill="#8833FF" />
                </svg>
                Leave Request Details</h2>
            <div class="text-lightgray mt-9">
                <h4 class="text-base font-semibold text-darkgray">Dear Chameleon admin,</h4>

                <!-- User info -->
                <p class="mt-2 mb-1 text-sm">
                    <span class="font-semibold text-darkgray">Leave Request By:</span>
                    <span id="popup-user-name" class="font-medium"></span>
                </p>

                <p class="mb-7 mt-3" id="leave-message"></p>
                <p>Leave Type: <b class="font-semibold text-darkgray" id="popup-leave-type"></b></p>
                <p>Requested Days: <b class="font-semibold text-darkgray" id="popup-requested-days"></b></p>
                <p>Remaining Days: <b class="font-semibold text-darkgray" id="popup-remaining-days">11</b></p>
                <p>Leave Current Status: <b class="font-semibold text-darkgray" id="popup-leave-status"></b></p>
                <p>Remarks: <b class="font-semibold text-darkgray" id="popup-remarks"></b></p>
            </div>

            @if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Manager')
                <form id="leaveStatusForm" method="POST">
                    @csrf
                    <input type="hidden" name="status" id="leaveStatusInput">
                    <input type="hidden" name="leave_id" id="leaveIdInput">

                    <div id="formContent">
                        <div class="custom-dropdown relative text-xs mt-3.5">
                            <span
                                class="h-11.5 flex items-center custom-dropdown-select cursor-pointer w-full py-2 px-6 bg-white shadow-primary rounded-10px relative">
                                <span class="selected-text">Select leave type</span>
                                <svg class="custom-dropdown-arrow duration-300 absolute right-6 top-5" width="11"
                                    height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.7958 0.204076C10.6598 0.0679876 10.4987 0 10.3124 0H0.687552C0.501235 0 0.340164 0.0679876 0.204076 0.204076C0.0679876 0.340314 0 0.501385 0 0.687589C0 0.873756 0.0679876 1.03483 0.204076 1.17095L5.01652 5.9834C5.15276 6.11949 5.31383 6.18763 5.5 6.18763C5.68617 6.18763 5.84739 6.11949 5.98336 5.9834L10.7958 1.17091C10.9317 1.03483 11 0.873756 11 0.687552C11 0.501385 10.9317 0.340314 10.7958 0.204076Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <div
                                class="absolute inset-x-0 top-full w-full pt-2 z-10 custom-dropdown-items invisible opacity-0 duration-300">
                                <div class="py-2.5 px-2 bg-white shadow-primary rounded-10px">
                                    <input type="search"
                                        class="appearance-none w-full border border-lightgray rounded-md p-3 outline-none focus:border-purple duration-300"
                                        placeholder="Search">
                                    <ul class="space-y-2">
                                        <li class="p-3 mb-0" aria-disabled="true">Select leave type</li>
                                        <li class="p-3 b-lightgray/20 rounded-md hover:bg-purple/20 cursor-pointer duration-300"
                                            onclick="selectStatus('1')">Approved</li>
                                        <li class="p-3 bg-lightgray/20 rounded-md hover:bg-purple/20 cursor-pointer duration-300"
                                            onclick="selectStatus('2')">Not Approved</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                class="cursor-pointer bg-purple text-white font-semibold py-2.5 px-6 rounded-sm mt-7">Update</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
        <div class="bg-black/10 absolute inset-0 popup-closebg"></div>
    </div>
@endsection
@section('custom-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('leaveStatusForm');
            const statusInput = document.getElementById('leaveStatusInput');
            const leaveIdInput = document.getElementById('leaveIdInput');
            const selectedText = document.querySelector('.selected-text');
            const dropdownToggle = document.querySelector('.custom-dropdown-select');
            // const dropdownMenu = document.querySelector('.custom-dropdown-items');
            const formContent = document.getElementById('formContent');
            const dropdownWrapper = document.querySelector('.custom-dropdown');

            // Toggle dropdown menu
            dropdownToggle.addEventListener('click', () => {
                dropdownMenu.classList.toggle('invisible');
                dropdownMenu.classList.toggle('opacity-0');
            });

            // Close dropdown if clicking outside
            document.addEventListener('click', (e) => {
                if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('invisible');
                    dropdownMenu.classList.add('opacity-0');
                }
            });

            // Select status from dropdown
            window.selectStatus = function(statusValue) {
                const label = statusValue === '1' ? 'Approved' : 'Not Approved';
                selectedText.textContent = label;
                statusInput.value = statusValue;
                dropdownMenu.classList.add('invisible');
                dropdownMenu.classList.add('opacity-0');
            };

            // Form submission via AJAX
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const status = statusInput.value;
                const leaveId = leaveIdInput.value;
                const actionUrl = `/chameleon/leave/update-status/${leaveId}`;

                fetch(actionUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: 'Leave status updated successfully.'
                        }).then(() => {
                            location
                                .reload(); // Or use jQuery to remove from DOM
                        });
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong while updating.'
                        });
                    });
            });

            // Handle Review button click
            document.querySelectorAll('.popup-button').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const id = this.dataset.leaveId;
                    const status = this.dataset.leaveStatus;

                    leaveIdInput.value = id;
                    statusInput.value = status;

                    if (status === '0') {
                        // Pending - allow status update
                        formContent.style.display = 'block';
                        dropdownWrapper.style.display = 'block';
                        selectedText.textContent = 'Select leave type';
                    } else {
                        // Already approved/rejected - show message
                        formContent.style.display = 'none';
                        dropdownWrapper.style.display = 'none';

                        Swal.fire({
                            icon: 'info',
                            title: 'Leave Already Reviewed',
                            text: status === '1' ? 'This leave has already been approved.' :
                                'This leave was not approved.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.popup-button, .popup-close, .popup-closebg');
            const popupMain = document.querySelector('.popup-main');

            buttons.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    popupMain.classList.toggle('invisible');
                    popupMain.classList.toggle('opacity-0');
                });
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            const dropdown = document.querySelector(".custom-dropdown");
            const trigger = dropdown.querySelector("span");
            const dropdownItems = dropdown.querySelector(".custom-dropdown-items");
            const options = dropdown.querySelectorAll("ul li");
            const searchInput = dropdown.querySelector("input[type='search']");

            // Toggle dropdown open/close with active class
            trigger.addEventListener("click", function(e) {
                const isOpen = !dropdownItems.classList.contains("invisible");

                if (isOpen) {
                    closeDropdown();
                } else {
                    openDropdown();
                }
            });

            // Open dropdown and add active class
            function openDropdown() {
                dropdownItems.classList.remove("invisible", "opacity-0");
                dropdown.classList.add("active");
            }

            // Close dropdown and remove active class
            function closeDropdown() {
                dropdownItems.classList.add("invisible", "opacity-0");
                dropdown.classList.remove("active");
            }

            // Select option
            options.forEach(option => {
                if (!option.hasAttribute('aria-disabled')) {
                    option.addEventListener("click", function() {
                        trigger.querySelector(".selected-text").textContent = option.textContent
                            .trim();
                        closeDropdown();
                    });
                }
            });

            // Search filter
            searchInput.addEventListener("input", function() {
                const filter = this.value.toLowerCase();
                options.forEach(option => {
                    if (!option.hasAttribute('aria-disabled')) {
                        const text = option.textContent.toLowerCase();
                        option.style.display = text.includes(filter) ? "block" : "none";
                    }
                });
            });


            // Close dropdown when clicking outside
            document.addEventListener("click", function(e) {
                if (!dropdown.contains(e.target)) {
                    closeDropdown();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const popupMain = document.querySelector('.popup-main');

            document.querySelectorAll('.popup-button').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const firstName = this.dataset.firstName;
                    const lastName = this.dataset.lastName;
                    const fullName = `${firstName} ${lastName}`;

                    const leaveType = this.dataset.leaveType;
                    const leaveStatus = this.dataset.leaveStatus;
                    const startDate = this.dataset.startDate;
                    const endDate = this.dataset.endDate;
                    const requestedDays = this.dataset.requestedDays;
                    const remarks = this.dataset.remarks;

                    // Convert numeric status to readable text
                    let statusText = '';
                    if (leaveStatus == 0) {
                        statusText = 'Pending';
                    } else if (leaveStatus == 1) {
                        statusText = 'Approved';
                    } else if (leaveStatus == 2) {
                        statusText = 'Rejected';
                    }

                    // Fill fields
                    document.getElementById('popup-user-name').textContent = fullName;

                    document.getElementById('leave-message').innerHTML =
                        `Your leave request submitted on <b>${new Date().toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    })}</b> for the period from <b class="font-semibold text-darkgray">${startDate}</b> to <b class="font-semibold text-darkgray">${endDate}</b> has been <b>${statusText}</b>. You can choose to recall the approval if needed.`;

                    document.getElementById('popup-leave-type').textContent = leaveType;
                    document.getElementById('popup-requested-days').textContent = requestedDays;
                    document.getElementById('popup-leave-status').textContent = statusText;
                    document.getElementById('popup-remarks').textContent = remarks;

                    popupMain.classList.remove('opacity-0', 'invisible');
                });
            });

            document.querySelectorAll('.popup-close, .popup-closebg').forEach(el => {
                el.addEventListener('click', () => {
                    popupMain.classList.add('opacity-0', 'invisible');
                });
            });
        });
    </script>
    {{-- filter --}}

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const dropdown = document.querySelector(".custom-dropdown");
            const selectText = dropdown.querySelector(".selected-text");
            const itemList = document.getElementById("status-filter-list");

            itemList.querySelectorAll("li").forEach(item => {
                item.addEventListener("click", () => {
                    const status = item.getAttribute("data-status");
                    selectText.textContent = item.textContent;

                    // Close dropdown (optional)
                    dropdown.querySelector(".custom-dropdown-items").classList.add("invisible",
                        "opacity-0");

                    // Reload DataTable with status filter
                    $('.table-leavetype').DataTable().ajax.url(
                        `{{ route('leave.index') }}?status=${status}`).load();
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Listen for clicks on delete buttons
            $('.delete-button').click(function() {
                var leaveId = $(this).data('id'); // Get leave ID from data-id attribute
                var row = $(this).closest('tr'); // Get the row where the button was clicked

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Make AJAX DELETE request
                        $.ajax({
                            url: '/chameleon/leave/' +
                                leaveId, // URL to delete leave
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}', // Include CSRF token
                            },
                            success: function(response) {
                                // Success: Show success message and reload
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'The leave has been deleted.',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload(); // Refresh page
                                });
                            },
                            error: function(xhr) {
                                // Error: Show appropriate error message based on the response
                                if (xhr.status == 400) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: xhr.responseJSON
                                            .message // Show the error message returned from controller
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Something went wrong. Please try again.'
                                    });
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
