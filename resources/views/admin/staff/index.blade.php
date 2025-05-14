@extends('layouts.admin')
@section('content')
    <div class="mt-10 lg:mt-11">
        <h2 class="font-bold text-base">Staff List</h2>
        <div class="bg-white shadow-primary mt-5.5 rounded-10px">
            <div class="bg-lightgraybg p-5 lg:p-7 rounded-t-10px border-b-2 border-gray">
                <div class="flex items-center">
                    <span class="font-semibold">Filter By Department :</span>
                    <div class="custom-dropdown custom-dropdown-nobg relative font-medium min-w-40 md:min-w-52 ml-2">
                        <span name="" id=""
                            class="custom-dropdown-select cursor-pointer w-full flex items-center relative gap-5 font-bold justify-end md:justify-start">
                            <span class="selected-text">Show all</span>
                            <svg class="custom-dropdown-arrow duration-300" width="11" height="7" viewBox="0 0 11 7"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.7958 0.204076C10.6598 0.0679876 10.4987 0 10.3124 0H0.687552C0.501235 0 0.340164 0.0679876 0.204076 0.204076C0.0679876 0.340314 0 0.501385 0 0.687589C0 0.873756 0.0679876 1.03483 0.204076 1.17095L5.01652 5.9834C5.15276 6.11949 5.31383 6.18763 5.5 6.18763C5.68617 6.18763 5.84739 6.11949 5.98336 5.9834L10.7958 1.17091C10.9317 1.03483 11 0.873756 11 0.687552C11 0.501385 10.9317 0.340314 10.7958 0.204076Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <div
                            class="absolute inset-x-0 top-full w-full pt-2 z-10 custom-dropdown-items invisible opacity-0 duration-300">
                            <div class="text-xs py-2.5 px-2 bg-white shadow-primary rounded-10px">
                                <input type="search"
                                    class="appearance-none w-full border border-lightgray rounded-md p-2.5 outline-none duration-300"
                                    placeholder="Search">
                                <ul class="">
                                    <li class="py-2.5 border-b border-black/10" aria-disabled="true">Select Department</li>

                                    <li
                                        class="py-2.5 hover:text-purple border-b border-black/10 cursor-pointer duration-300">
                                        Show all</li>
                                    @foreach ($departments as $department)
                                        <li class="py-2.5 hover:text-purple border-b border-black/10 cursor-pointer duration-300"
                                            data-id="{{ $department->id }}">
                                            {{ $department->name }}</li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-5 lg:p-8">
                <div class="flex flex-wrap -mx-2.5">
                    @foreach ($users as $list)
                        <div class="w-full sm:w-1/2 xl:w-1/3 2xl:w-1/4 p-2.5 user-card"
                            data-department="{{ $list->department_id }}">
                            <div class="bg-white p-5 rounded-lg border-2 border-gray">
                                @if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Manager')
                                    {{-- <ul class="flex items-center justify-end gap-4">
                                        <li><a href="{{ route('new-staff.show', $list->id) }}"
                                                class="duration-300 cursor-pointer hover:text-purple text-lightgray"><svg
                                                    width="22" height="14" viewBox="0 0 22 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M11 0C6.79667 0 2.98486 2.29968 0.172139 6.03498C-0.0573796 6.341 -0.0573796 6.76854 0.172139 7.07456C2.98486 10.8144 6.79667 13.114 11 13.114C15.2033 13.114 19.0151 10.8144 21.8279 7.07906C22.0574 6.77304 22.0574 6.34551 21.8279 6.03948C19.0151 2.29968 15.2033 0 11 0ZM11.3015 11.1744C8.5113 11.3499 6.20712 9.05022 6.38263 6.2555C6.52664 3.95131 8.39429 2.08367 10.6985 1.93965C13.4887 1.76414 15.7929 4.06382 15.6174 6.85855C15.4689 9.15823 13.6012 11.0259 11.3015 11.1744ZM11.162 9.04122C9.65889 9.13573 8.41679 7.89813 8.5158 6.39501C8.59231 5.15291 9.60039 4.14933 10.8425 4.06832C12.3456 3.97382 13.5877 5.21142 13.4887 6.71453C13.4077 7.96113 12.3996 8.96471 11.162 9.04122Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </a></li>
                                        <li><a href="{{ route('new-staff.edit', $list->id) }}"
                                                class="duration-300 cursor-pointer hover:text-purple text-lightgray"><svg
                                                    width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9.52632 1.44493L10.2923 0.678944C11.1976 -0.226315 12.7731 -0.226315 13.6783 0.678944L14.2963 1.29696C14.5193 1.51804 14.6963 1.78108 14.817 2.07091C14.9378 2.36074 15 2.67162 15 2.98561C15 3.2996 14.9378 3.61048 14.817 3.90031C14.6963 4.19014 14.5193 4.45319 14.2963 4.67427L13.5303 5.44026L9.52632 1.43623V1.44493ZM8.60365 2.3676L0.673933 10.2973C0.421506 10.5497 0.264826 10.8805 0.238713 11.2374L0.00369398 13.7878C-0.0224192 14.1098 0.0907381 14.4232 0.317053 14.6582C0.525958 14.8671 0.795795 14.9803 1.08304 14.9803H1.17879L3.72918 14.7453C4.08606 14.7105 4.41683 14.5538 4.66926 14.3013L12.599 6.37163L8.59495 2.3676H8.60365Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </a></li>
                                        <li><button
                                                class="delete-button duration-300 cursor-pointer hover:text-purple text-lightgray"
                                                data-id="{{ $list->id }}"><svg width="14" height="18"
                                                    viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.6538 2.15385H9.69231V1.61538C9.69231 0.723221 8.96909 0 8.07692 0H5.92308C5.03091 0 4.30769 0.723221 4.30769 1.61538V2.15385H1.34615C0.602707 2.15385 0 2.75655 0 3.5V4.57692C0 4.87432 0.241062 5.11538 0.538462 5.11538H13.4615C13.7589 5.11538 14 4.87432 14 4.57692V3.5C14 2.75655 13.3973 2.15385 12.6538 2.15385ZM5.38462 1.61538C5.38462 1.31856 5.62625 1.07692 5.92308 1.07692H8.07692C8.37375 1.07692 8.61538 1.31856 8.61538 1.61538V2.15385H5.38462V1.61538ZM1.02187 6.19231C0.999094 6.19231 0.976561 6.19693 0.955629 6.2059C0.934697 6.21486 0.915802 6.22798 0.900089 6.24446C0.884376 6.26094 0.872172 6.28044 0.864215 6.30178C0.856258 6.32311 0.852714 6.34584 0.853798 6.36859L1.29803 15.6921C1.33909 16.555 2.04784 17.2308 2.91139 17.2308H11.0886C11.9522 17.2308 12.6609 16.555 12.702 15.6921L13.1462 6.36859C13.1473 6.34584 13.1437 6.32311 13.1358 6.30178C13.1278 6.28044 13.1156 6.26094 13.0999 6.24446C13.0842 6.22798 13.0653 6.21486 13.0444 6.2059C13.0234 6.19693 13.0009 6.19231 12.9781 6.19231H1.02187ZM9.15385 7.53846C9.15385 7.24096 9.39481 7 9.69231 7C9.98981 7 10.2308 7.24096 10.2308 7.53846V14.5385C10.2308 14.836 9.98981 15.0769 9.69231 15.0769C9.39481 15.0769 9.15385 14.836 9.15385 14.5385V7.53846ZM6.46154 7.53846C6.46154 7.24096 6.7025 7 7 7C7.2975 7 7.53846 7.24096 7.53846 7.53846V14.5385C7.53846 14.836 7.2975 15.0769 7 15.0769C6.7025 15.0769 6.46154 14.836 6.46154 14.5385V7.53846ZM3.76923 7.53846C3.76923 7.24096 4.01019 7 4.30769 7C4.60519 7 4.84615 7.24096 4.84615 7.53846V14.5385C4.84615 14.836 4.60519 15.0769 4.30769 15.0769C4.01019 15.0769 3.76923 14.836 3.76923 14.5385V7.53846Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </button></li>
                                    </ul> --}}
                                    <div class="relative flex items-center justify-end ">
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
                                            <li><a href="{{ route('new-staff.show', $list->id) }}"
                                                    class="duration-300 cursor-pointer hover:text-purple popup-button">show</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('new-staff.edit', $list->id) }}" class="duration-300 cursor-pointer hover:text-purple">
                                                    Edit 
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" data-id="{{ $list->id }}"
                                                    class="delete-button duration-300 cursor-pointer hover:text-purple delete-leave-link">
                                                    Delete
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                @endif
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center">
                                        <img src="{{ $list->avatar ? asset('admin-uploads/avatar/' . $list->avatar) : asset('admin-assets/images/user-2.jpg') }}"
                                            alt="user" class="h-14.5 w-14.5 rounded-lg">
                                    </div>
                                    <div class="w-[calc(100%-58px)] px-2 2xl:px-3.5 user-content--data">
                                        <h4 class="font-bold">{{ $list->first_name }} {{ $list->last_name }}</h4>
                                        <p class="mt-2 text-xs">{{ $list->designation }}</p>
                                    </div>
                                </div>
                                <ul class="font-semibold mt-6 space-y-4 text-xs">
                                    <li class="flex items-center"><svg class="mr-3.5 text-lightgray" width="16"
                                            height="12" viewBox="0 0 16 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.33716 7.79425C8.93909 8.05962 8.47672 8.19991 8 8.19991C7.52331 8.19991 7.06094 8.05962 6.66287 7.79425L0.106531 3.42322C0.0703376 3.39902 0.0348139 3.37383 0 3.34769L0 10.5101C0 11.3313 0.666406 11.983 1.47291 11.983H14.5271C15.3482 11.983 16 11.3166 16 10.5101V3.34766C15.9651 3.37387 15.9295 3.39911 15.8932 3.42334L9.33716 7.79425Z"
                                                fill="currentColor" />
                                            <path
                                                d="M0.626563 2.6435L7.18291 7.01456C7.43109 7.18003 7.71553 7.26275 7.99997 7.26275C8.28444 7.26275 8.56891 7.18 8.81709 7.01456L15.3734 2.6435C15.7658 2.38209 16 1.94459 16 1.47241C16 0.6605 15.3395 0 14.5276 0H1.47241C0.660532 3.125e-05 7.75033e-07 0.660531 7.75033e-07 1.47319C-0.000242619 1.70481 0.0568447 1.9329 0.166171 2.1371C0.275497 2.34131 0.433664 2.51528 0.626563 2.6435Z"
                                                fill="currentColor" />
                                        </svg>
                                        <span class="w-[calc(100%-32px)] truncate">{{ $list->email }}</span>
                                    </li>
                                    @if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Manager')
                                        <li class="flex items-center"><svg class="mr-3.5 text-lightgray" width="14"
                                                height="17" viewBox="0 0 14 17" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0.983398C4.68412 0.983398 2.8 2.87593 2.8 5.20215C2.8 7.52837 4.68412 9.4209 7 9.4209C9.31588 9.4209 11.2 7.52837 11.2 5.20215C11.2 2.87593 9.31588 0.983398 7 0.983398ZM12.2256 12.177C11.0757 11.0042 9.55139 10.3584 7.93333 10.3584H6.06667C4.44864 10.3584 2.92426 11.0042 1.77439 12.177C0.630155 13.344 0 14.8844 0 16.5146C0 16.7735 0.208942 16.9834 0.466667 16.9834H13.5333C13.7911 16.9834 14 16.7735 14 16.5146C14 14.8844 13.3698 13.344 12.2256 12.177Z"
                                                    fill="currentColor" />
                                            </svg>
                                            <span class="w-[calc(100%-32px)] truncate">Department:
                                                {{ $list->department->name ?? '' }}</span>
                                        </li>
                                        <li class="flex items-center"><svg class="mr-3.5 text-lightgray" width="15"
                                                height="16" viewBox="0 0 15 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.8601 0.983398H2.13993C0.959941 0.983398 0 2.02242 0 3.29955V11.1305C0 12.4076 0.959941 13.4466 2.13993 13.4466H2.97967L2.9961 15.4914C2.99712 15.6222 3.04587 15.7474 3.13174 15.8396C3.21761 15.9317 3.33364 15.9834 3.45457 15.9834C3.55415 15.9834 3.653 15.9483 3.7348 15.88L6.64761 13.4467H12.8601C14.04 13.4467 15 12.4077 15 11.1306V3.29955C15 2.02242 14.04 0.983398 12.8601 0.983398Z"
                                                    fill="currentColor" />
                                            </svg>
                                            <span class="w-[calc(100%-32px)] truncate">Salary:
                                                {{ number_format($list->monthly_salary ?? '0') }}</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdown = document.querySelector(".custom-dropdown");
            const trigger = dropdown.querySelector(".custom-dropdown-select");
            const dropdownItems = dropdown.querySelector(".custom-dropdown-items");
            const options = dropdown.querySelectorAll("ul li");
            const searchInput = dropdown.querySelector("input[type='search']");
            const userCards = document.querySelectorAll(".user-content--data");

            // Function to filter user cards
            function filterUsers(selectedText) {
                userCards.forEach(card => {
                    const designation = card.querySelector('p').innerText.toLowerCase();
                    const cardContainer = card.closest('.w-full');

                    if (selectedText === "show all" || designation.includes(selectedText)) {
                        cardContainer.style.display = "block";
                    } else {
                        cardContainer.style.display = "none";
                    }
                });
            }

            // Toggle dropdown open/close
            trigger.addEventListener("click", function(e) {
                e.stopPropagation();
                const isOpen = !dropdownItems.classList.contains("invisible");

                if (isOpen) {
                    closeDropdown();
                } else {
                    openDropdown();
                }
            });

            function openDropdown() {
                dropdownItems.classList.remove("invisible", "opacity-0");
                dropdown.classList.add("active");
            }

            function closeDropdown() {
                dropdownItems.classList.add("invisible", "opacity-0");
                dropdown.classList.remove("active");
            }

            // Option click select and filter
            options.forEach(option => {
                if (!option.hasAttribute('aria-disabled')) {
                    option.addEventListener("click", function() {
                        const selectedText = option.textContent.trim().toLowerCase();
                        trigger.querySelector(".selected-text").textContent = option.textContent
                            .trim();
                        closeDropdown();
                        filterUsers(selectedText);
                    });
                }
            });

            // Search input typing filter
            searchInput.addEventListener("input", function() {
                const searchValue = this.value.trim().toLowerCase();

                options.forEach(option => {
                    if (!option.hasAttribute('aria-disabled')) {
                        const text = option.textContent.toLowerCase();
                        option.style.display = text.includes(searchValue) ? "list-item" : "none";
                    }
                });

                // Also filter user cards directly while typing
                if (searchValue.length > 0) {
                    filterUsers(searchValue);
                } else {
                    // If empty, show all users
                    filterUsers('show all');
                }
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
        $(document).ready(function() {
            // Listen for clicks on delete buttons
            $('.delete-button').click(function() {
                var userId = $(this).data('id'); // Get user ID from data-id attribute
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
                            url: '/chameleon/new-staff/' +
                                userId, // URL to delete user
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}', // Include CSRF token
                            },
                            success: function(response) {
                                // Success: Show success message and reload
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'The staff has been deleted.',
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector('.custom-dropdown-items input[type="search"]');
            const listItems = document.querySelectorAll('.custom-dropdown-items ul li[data-id]');
            const userCards = document.querySelectorAll('.user-card');

            // When a department is clicked
            listItems.forEach(item => {
                item.addEventListener("click", function() {
                    const selectedId = this.getAttribute("data-id");

                    // Filter user cards based on department
                    userCards.forEach(card => {
                        if (card.getAttribute("data-department") === selectedId) {
                            card.style.display = "block";
                        } else {
                            card.style.display = "none";
                        }
                    });
                });
            });

            // Optional: Show All
            document.querySelector('.custom-dropdown-items ul li:not([data-id])').addEventListener("click", () => {
                userCards.forEach(card => {
                    card.style.display = "block";
                });
            });

            // Optional: Live search by department name
            searchInput.addEventListener("input", function() {
                const searchTerm = this.value.toLowerCase();
                listItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(searchTerm) ? "block" : "none";
                });
            });
        });
    </script>
@endsection
