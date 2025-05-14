@extends('layouts.admin')
@section('content')
    <!-- data -->
    <div class="mt-10 lg:mt-11">
        <h2 class="font-bold text-base">New Staff</h2>
        <form class="bg-white shadow-primary rounded-10px mt-5.5" id="addNewUserForm" action="{{ route('new-staff.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-wrap font-semibold rounded-10px">
                <div class="w-full">
                    <h4 class="xl:text-base bg-lightgraybg border-b-2 rounded-t-10px p-3 sm:p-5 xl:p-7 xl:px-9 border-gray">
                        Personal Details</h4>
                    <div class="md:h-[calc(100%-62px)] xl:h-[calc(100%-82px)] p-3 sm:p-5 xl:p-10 xl:py-7">
                        <div
                            class="flex flex-wrap h-full bg-lightgraybg rounded-tl-10px md:-mx-2 xl:-mx-4 px-3 sm:pl-5 sm:pr-5 md:pr-0 py-5 border-2 border-gray rounded-10px rounded-b-10px">
                            <fieldset class="p-2 xl:p-4 w-full md:w-1/2">
                                <label for="" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">Staff Profile </label>
                                <input type="file" id="image_path" name="avatar"
                                    class="h-11.5 flex items-center text-xs file:text-xs file:bg-[#F6F6F6] file:border-1 file:border-lightgray file:text-darkgray file:px-2.5 file:py-1 file:rounded-md file:mr-4 w-full bg-white shadow-primary py-2.5 px-6 rounded-10px">
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 w-full md:w-1/2">
                                <label for="" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">First Name *</label>
                                <input type="text" placeholder="First Name" id="firstname" name="first_name"
                                    value="{{ old('first_name') }}"
                                    class="h-11.5 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                                @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 w-full md:w-1/2">
                                <label for="" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">Middle Name</label>
                                <input type="text" placeholder="Middle Name" id="middlename" name="middle_name"
                                    value="{{ old('middle_name') }}"
                                    class="h-11.5 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 w-full md:w-1/2">
                                <label for="" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">Last Name *</label>
                                <input type="text" placeholder="Last Name" id="lastname" name="last_name"
                                    value="{{ old('last_name') }}"
                                    class="h-11.5 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                                @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 w-full md:w-1/2">
                                <label for="" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">Phone Number *</label>
                                <input type="number" placeholder="Phone Number" id="contact" name="phone_number"
                                    value="{{ old('phone_number') }}"
                                    class="h-11.5 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                                @error('phone_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 w-full md:w-1/2">
                                <label for="" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">Designation *</label>
                                <input type="text" placeholder="Designation" id="designation" name="designation"
                                    value="{{ old('designation') }}"
                                    class="h-11.5 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                                @error('designation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 w-full md:w-1/2">
                                <label for="address" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">Address *</label>
                                <input type="text" placeholder="Address" id="address" name="address"
                                    value="{{ old('address') }}"
                                    class="h-11.5 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 w-full md:w-1/2">
                                <label for="city" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">City *</label>
                                <input type="text" placeholder="City" id="city" name="city"
                                    value="{{ old('city') }}"
                                    class="h-11.5 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                                @error('city')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 w-full md:w-1/2">
                                <label for="state" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">State *</label>
                                <input type="text" placeholder="State" id="state" name="state"
                                    value="{{ old('state') }}"
                                    class="h-11.5 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                                @error('state')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 w-full md:w-1/2">
                                <label for="pincode" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">Pincode *</label>
                                <input type="number" placeholder="Pincode" id="pincode" name="pincode"
                                    value="{{ old('pincode') }}"
                                    class="h-11.5 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                                @error('pincode')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 w-full md:w-1/2">
                                <label for="" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">Date of Birth *</label>
                                <input type="date" placeholder="Date of Birth" id="dob" name="dob"
                                    value="{{ old('dob') }}"
                                    class="h-11.5 grid items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                                @error('dob')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 w-full md:w-1/2">
                                <label for=""
                                    class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 pb-3 block border-b-2 border-gray">Gender *</label>
                                <div class="flex items-center space-x-5.5">
                                    <div class="inline-flex items-center gap-2">
                                        <input type="radio" id="female" name="gender" value="Female"
                                            class="accent-green-600 w-4 h-4">
                                        <label for="female">Female</label>
                                    </div>
                                    <div class="inline-flex items-center gap-2">
                                        <input type="radio" id="male" name="gender" value="Male"
                                            class="accent-green-600 w-4 h-4" checked>
                                        <label for="male">Male</label>
                                    </div>
                                </div>
                                @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <h4 class="xl:text-base bg-lightgraybg border-b-2 rounded-t-10px p-3 sm:p-5 xl:p-7 xl:px-9 border-gray">
                        Company Details</h4>
                    <div class="md:h-[calc(100%-62px)] xl:h-[calc(100%-82px)] p-3 sm:p-5 xl:p-10 xl:py-7">
                        <div
                            class="flex flex-wrap h-full bg-lightgraybg rounded-tl-10px md:-mx-2 xl:-mx-4 px-3 sm:pl-5 sm:pr-5 md:pr-0 py-5 border-2 border-gray rounded-10px rounded-b-10px">

                            <fieldset class="p-2 xl:p-4 md:w-1/2 w-full">
                                <label class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">Department *</label>

                                <div class="custom-dropdown relative text-xs">
                                    {{-- Hidden input for storing selected department ID --}}
                                    <input type="hidden" name="department_id" id="departmentInput"
                                        value="{{ old('department_id') }}">

                                    <span
                                        class="h-11.5 flex items-center justify-between custom-dropdown-select cursor-pointer w-full py-2 px-6 bg-white shadow-primary rounded-10px relative"
                                        id="dropdownToggle">
                                        <span class="selected-text">
                                            {{ old('department_id') ? $departments->firstWhere('id', old('department_id'))?->name ?? 'Select department' : 'Select department' }}
                                        </span>
                                        <svg class="custom-dropdown-arrow duration-300 absolute right-6 top-5"
                                            width="11" height="7" viewBox="0 0 11 7" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.7958 0.204076C10.6598 0.0679876 10.4987 0 10.3124 0H0.687552C0.501235 0 0.340164 0.0679876 0.204076 0.204076C0.0679876 0.340314 0 0.501385 0 0.687589C0 0.873756 0.0679876 1.03483 0.204076 1.17095L5.01652 5.9834C5.15276 6.11949 5.31383 6.18763 5.5 6.18763C5.68617 6.18763 5.84739 6.11949 5.98336 5.9834L10.7958 1.17091C10.9317 1.03483 11 0.873756 11 0.687552C11 0.501385 10.9317 0.340314 10.7958 0.204076Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>

                                    <div
                                        class="dropdown-menu absolute inset-x-0 top-full w-full pt-2 z-10 invisible opacity-0 duration-300">
                                        <div class="py-2.5 px-2 bg-white shadow-primary rounded-10px">
                                            <input type="search"
                                                class="appearance-none w-full border border-lightgray rounded-md p-3 outline-none focus:border-purple duration-300"
                                                placeholder="Search" id="dropdownSearch">

                                            <ul class="space-y-2 mt-2" id="dropdownItems">
                                                <li class="p-3 text-gray-500" aria-disabled="true">Select Department</li>
                                                @foreach ($departments as $department)
                                                    <li class="dropdown-item p-3 bg-lightgray/20 rounded-md hover:bg-purple/20 cursor-pointer duration-300"
                                                        data-id="{{ $department->id }}">
                                                        {{ $department->name }}
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <a href="{{ route('department.index') }}"
                                                class="custom-dropdown-add flex items-center gap-1.5 p-3 cursor-pointer">
                                                <span
                                                    class="w-5 h-5 flex items-center justify-center bg-gray rounded-full">
                                                    <svg width="10" height="10" viewBox="0 0 10 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5 1L5 9" stroke="#6B7A99" stroke-linecap="round" />
                                                        <path d="M1 5L9 5" stroke="#6B7A99" stroke-linecap="round" />
                                                    </svg>
                                                </span> Add Department
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 md:w-1/2 w-full">
                                <label for="newStaffId" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">Staff ID *</label>
                                <div class="flex items-center gap-3">
                                    <input type="text" placeholder="Staff ID" id="newStaffId" name="staff_id"
                                        value="{{ old('staff_id') }}"
                                        class="h-11.5 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white"
                                        readonly>
                                    <button type="button" class="btn btn-secondary cursor-pointer"
                                        id="generateStaffIdBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40"
                                            x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve" class="">
                                            <g>
                                                <path
                                                    d="M57 25h-3.088a22.906 22.906 0 0 0-1.472-3.541l2.187-2.187a4 4 0 0 0 0-5.657l-4.242-4.242a4 4 0 0 0-5.657 0l-2.187 2.187A22.906 22.906 0 0 0 39 10.088V7a4 4 0 0 0-4-4h-6a4 4 0 0 0-4 4v3.088a22.906 22.906 0 0 0-3.541 1.472l-2.187-2.187a4 4 0 0 0-5.657 0l-4.242 4.242a4 4 0 0 0 0 5.657l2.187 2.187A22.906 22.906 0 0 0 10.088 25H7a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h3.088a22.906 22.906 0 0 0 1.472 3.541l-2.187 2.187a4 4 0 0 0 0 5.657l4.242 4.242a4 4 0 0 0 5.657 0l2.187-2.187A22.906 22.906 0 0 0 25 53.912V57a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4v-3.088a22.906 22.906 0 0 0 3.541-1.472l2.187 2.187a4 4 0 0 0 5.657 0l4.242-4.242a4 4 0 0 0 0-5.657l-2.187-2.187A22.906 22.906 0 0 0 53.912 39H57a4 4 0 0 0 4-4v-6a4 4 0 0 0-4-4ZM32 44a12 12 0 1 1 12-12 12 12 0 0 1-12 12Z"
                                                    style="" fill="#3392e6" data-original="#3392e6"
                                                    class=""></path>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                @error('staff_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 md:w-1/2 w-full">
                                <label for="" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">Email *</label>
                                <input type="email" placeholder="Email" id="email" name="email"
                                    value="{{ old('email') }}"
                                    class="h-11.5 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 md:w-1/2 w-full">
                                <label for="" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">Password *</label>
                                <input type="password" placeholder="Password" id="password" name="password"
                                    class="h-11.5 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 md:w-1/2 w-full">
                                <label for="" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">Monthly Salary *</label>
                                <input type="number" placeholder="Monthly Salary" id="monthly_salary"
                                    name="monthly_salary" value="{{ old('monthly_salary') }}"
                                    class="h-11.5 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                                @error('monthly_salary')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="p-2 xl:p-4 md:w-1/2 w-full">
                                <label for="" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block">Joining Date *</label>
                                <input type="date" placeholder="Joining Date" id="joining_date" name="joining_date"
                                    value="{{ old('joining_date') }}"
                                    class="h-11.5 grid items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                                @error('joining_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </fieldset>
                            <fieldset class="p-2 xl:p-4 md:w-1/2 w-full">
                                <label for=""
                                    class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 pb-3 block border-b-2 border-gray">Role Type</label>
                                <div class="flex items-center space-x-5.5">
                                    <div class="inline-flex items-center gap-2">
                                        <input type="radio" name="role" value="Staff"
                                            {{ old('role') == 'Staff' ? 'checked' : '' }} class="accent-purple w-4 h-4"
                                            checked>
                                        <label for="rolestaff">Staff</label>
                                    </div>
                                    <div class="inline-flex items-center gap-2">
                                        <input type="radio" name="role" value="Manager"
                                            {{ old('role') == 'Manager' ? 'checked' : '' }} class="accent-purple w-4 h-4">
                                        <label for="rolemanager">Manager</label>
                                    </div>
                                </div>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="p-3 sm:p-5 xl:p-10 xl:pt-0 xl:pb-7">
                        <div class="text-center">
                            <button type="submit"
                                class="bg-purple text-white font-semibold py-2.5 px-6 rounded-md cursor-pointer">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('custom-js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('generateStaffIdBtn').addEventListener('click', function() {
                fetch('/chameleon/generate-staff-id')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        document.getElementById('newStaffId').value = data.new_staff_id;
                    })
                    .catch(error => console.error('Error generating staff ID:', error));
            });
        });
    </script>
    {{-- JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggle = document.getElementById('dropdownToggle');
            const dropdownMenu = dropdownToggle.nextElementSibling;
            const selectedText = dropdownToggle.querySelector('.selected-text');
            const hiddenInput = document.getElementById('departmentInput');
            const searchInput = document.getElementById('dropdownSearch');
            const dropdownItems = document.getElementById('dropdownItems');

            // Toggle dropdown
            dropdownToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('invisible');
                dropdownMenu.classList.toggle('opacity-0');
            });

            // Handle selection
            dropdownItems.querySelectorAll('.dropdown-item').forEach(function(item) {
                item.addEventListener('click', function() {
                    const departmentId = item.getAttribute('data-id');
                    const departmentName = item.textContent.trim();

                    hiddenInput.value = departmentId;
                    selectedText.textContent = departmentName;

                    // Close the menu
                    dropdownMenu.classList.add('invisible');
                    dropdownMenu.classList.add('opacity-0');
                });
            });

            // Filter items by search
            searchInput.addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                dropdownItems.querySelectorAll('.dropdown-item').forEach(function(item) {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(filter) ? 'block' : 'none';
                });
            });

            // Close on outside click
            document.addEventListener('click', function(e) {
                if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('invisible');
                    dropdownMenu.classList.add('opacity-0');
                }
            });
        });
    </script>
@endsection
