@extends('layouts.admin')
@section('content')
    <!-- data -->
    <div class="mt-10 lg:mt-11">
        <div class="max-w-[680px] mx-auto w-full shadow-primary bg-lightgraybg rounded-10px">
            <div class="py-5 bg-white text-center font-bold text-base border-b-2 border-gray rounded-t-10px">
                <h4>Edit Your Leave</h4>
            </div>
            <form action="{{ route('leave.update', $leave->id) }}" method="POST"
                class="py-8 px-7 font-medium rounded-b-10px space-y-6 text-xs">
                @csrf
                @method('PUT')
                <input type="hidden" name="leave_id" value="{{ $leave->id }}">
                @if (session('success'))
                    <div id="success-banner"
                        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white py-3 px-6 rounded-b-lg shadow-lg z-50">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Leave Type --}}
                <fieldset>
                    <label for="">Leave Type</label>
                    <input type="hidden" name="leave_type_id" id="leave_type_id" value="{{ $leave->leave_type_id }}">
                    <div class="custom-dropdown relative text-xs mt-3.5">
                        <span
                            class="h-11.5 flex items-center custom-dropdown-select cursor-pointer w-full py-2 px-6 bg-white shadow-primary rounded-10px relative">
                            <span class="selected-text">
                                {{ optional($leave->leaveType)->leave_type ?? 'Select leave type' }}
                            </span>
                            <svg class="custom-dropdown-arrow duration-300 absolute right-6 top-5" width="11"
                                height="7" fill="none">
                                <path d="M10.7958 0.204076C10.6598 0.0679876 10.4987 0 10.3124 0H0.687552C0.501235 0 0.340164 0.0679876 0.204076 0.204076C0.0679876 0.340314 0 0.501385 0 0.687589C0 0.873756 0.0679876 1.03483 0.204076 1.17095L5.01652 5.9834C5.15276 6.11949 5.31383 6.18763 5.5 6.18763C5.68617 6.18763 5.84739 6.11949 5.98336 5.9834L10.7958 1.17091C10.9317 1.03483 11 0.873756 11 0.687552C11 0.501385 10.9317 0.340314 10.7958 0.204076Z" fill="currentColor"></path>
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
                                    @foreach ($leavetype as $type)
                                        <li class="p-3 bg-lightgray/20 rounded-md hover:bg-purple/20 cursor-pointer duration-300"
                                            data-id="{{ $type->id }}">
                                            {{ $type->leave_type }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @error('leave_type_id')
                        <div class="text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </fieldset>

                {{-- Start Date --}}
                <fieldset>
                    <label for="start_date" class="block">Start Date</label>
                    <input type="date" name="from_date" id="start_date" value="{{ $leave->from_date }}"
                        class="w-full mt-3.5 bg-white shadow-primary py-3 px-6 rounded-10px outline-none">
                    @error('from_date')
                        <div class="text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </fieldset>

                {{-- End Date --}}
                <fieldset>
                    <label for="end_date" class="block">End Date</label>
                    <input type="date" name="to_date" id="end_date" value="{{ $leave->to_date }}"
                        class="w-full mt-3.5 bg-white shadow-primary py-3 px-6 rounded-10px outline-none">
                    @error('to_date')
                        <div class="text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </fieldset>

                {{-- Total Days --}}
                <fieldset>
                    <label for="days_count" class="block">Total Days</label>
                    <input type="number" name="requested_days" id="days_count" value="{{ $leave->requested_days }}"
                        readonly class="w-full bg-white shadow-primary py-3 px-6 rounded-10px outline-none">
                </fieldset>

                {{-- Remarks --}}
                <fieldset>
                    <label for="remarks" class="block">Description</label>
                    <textarea name="remarks" id="remarks"
                        class="w-full mt-3.5 bg-white shadow-primary py-5 resize-none h-[120px] px-6 rounded-10px outline-none"
                        placeholder="Type here">{{ $leave->remarks }}</textarea>
                    @error('remarks')
                        <div class="text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </fieldset>

                {{-- Submit --}}
                <fieldset class="flex gap-1.5 justify-center mt-9 text-sm">
                    <button type="reset"
                        class="cursor-pointer bg-darkgray text-white font-semibold py-2.5 px-6 rounded-sm">Clear</button>
                    <button type="submit"
                        class="cursor-pointer bg-purple text-white font-semibold py-2.5 px-6 rounded-sm">Update</button>
                </fieldset>
            </form>


        </div>
    </div>
@endsection
@section('custom-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdown = document.querySelector(".custom-dropdown");
            const trigger = dropdown.querySelector(".custom-dropdown-select");
            const dropdownItems = dropdown.querySelector(".custom-dropdown-items");
            const options = dropdown.querySelectorAll("ul li[data-id]");
            const searchInput = dropdown.querySelector("input[type='search']");
            const selectedText = dropdown.querySelector(".selected-text");
            const hiddenInput = document.getElementById("leave_type_id");

            // Dropdown toggle
            trigger.addEventListener("click", function() {
                dropdownItems.classList.toggle("invisible");
                dropdownItems.classList.toggle("opacity-0");
            });

            // Select option
            options.forEach(option => {
                option.addEventListener("click", function() {
                    selectedText.textContent = option.textContent.trim();
                    hiddenInput.value = option.dataset.id;
                    dropdownItems.classList.add("invisible", "opacity-0");
                });
            });

            // Filter options
            searchInput.addEventListener("input", function() {
                const filter = this.value.toLowerCase();
                options.forEach(option => {
                    const text = option.textContent.toLowerCase();
                    option.style.display = text.includes(filter) ? "block" : "none";
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener("click", function(e) {
                if (!dropdown.contains(e.target)) {
                    dropdownItems.classList.add("invisible", "opacity-0");
                }
            });

            // Auto Day Counter
            const startDate = document.getElementById("start_date");
            const endDate = document.getElementById("end_date");
            const daysCount = document.getElementById("days_count");

            function updateDayCount() {
                const start = new Date(startDate.value);
                const end = new Date(endDate.value);
                if (!isNaN(start) && !isNaN(end) && end >= start) {
                    const diff = Math.floor((end - start) / (1000 * 60 * 60 * 24)) + 1;
                    daysCount.value = diff;
                } else {
                    daysCount.value = '';
                }
            }

            startDate.addEventListener("change", updateDayCount);
            endDate.addEventListener("change", updateDayCount);
        });
    </script>
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif
@endsection
