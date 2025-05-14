@extends('layouts.admin')
@section('content')
    <div class="mt-10 lg:mt-11">
        <div class="bg-white shadow-primary mt-5.5 rounded-10px">
            <div class="p-5 lg:p-8">
                <div class="flex flex-wrap -mx-3 mb-9">
                    <div class="w-full xl:w-1/2 2xl:w-1/3 px-3 my-3 2xl:my-0">
                        <span id="todaydate"
                            class="font-medium mb-3.5">{{ \Carbon\Carbon::now()->toFormattedDateString() }}</span>
                        <h2 class="font-bold text-3xl md:text-4xl capitalize">
                            Hey, <span class="text-purple">{{ Auth::user()->first_name }}</span> <br>
                            your attendance <img src="{{ asset('admin-assets/images/highfive.png') }}" alt="highfive"
                                class="inline w-12.5 h-12.5">
                        </h2>
                        <div class="flex flex-wrap gap-3 md:gap-5 mt-9">
                            <div
                                class="flex flex-col font-medium gap-5 bg-lightgraybg p-3.5 rounded-10px shadow-primary text-xs md:text-sm w-[calc(33%-12px)]">
                                <span>Working Days</span>
                                <h3 class="font-bold text-4xl md:text-5xl text-purple">{{ $totalWorkingDays }}</h3>
                            </div>
                            <div
                                class="flex flex-col font-medium gap-5 bg-lightgraybg p-3.5 rounded-10px shadow-primary text-xs md:text-sm w-[calc(33%-12px)]">
                                <span>Present Days</span>
                                <h3 class="font-bold text-4xl md:text-5xl text-green">{{ $presentDays }}</h3>
                            </div>
                            <div
                                class="flex flex-col font-medium gap-5 bg-lightgraybg p-3.5 rounded-10px shadow-primary text-xs md:text-sm w-[calc(33%-12px)]">
                                <span>Absent Days</span>
                                <h3 class="font-bold text-4xl md:text-5xl text-danger">{{ $absentDays }}</h3>
                            </div>
                        </div>
                    </div>
                    @php
                        use Carbon\Carbon;

                        $user = auth()->user();
                        $today = Carbon::now()->toDateString();

                        $attendance = \App\Models\Attendance::where('user_id', $user->id)
                            ->where('date', $today)
                            ->first();

                        $checkInTime = $attendance?->time_in ? Carbon::parse($attendance->time_in) : null;
                        $checkOutTime = $attendance?->time_out ? Carbon::parse($attendance->time_out) : null;

                        $isCheckedIn = $checkInTime && !$checkOutTime;
                        $status = $attendance?->check_in_type ?? 'free'; // default to 'free' if null
                    @endphp

                    <div class="w-full xl:w-1/2 2xl:w-1/3 px-3 my-3 2xl:my-0">
                        <div class="bg-lightgraybg p-9 text-center shadow-primary font-medium rounded-10px">
                            <h3 id="todayclock" class="text-4xl font-bold mb-4"></h3>
                            <p class="font-semibold">Today's Attendance</p>
                            <p class="text-xs">Mark your check-in and check-out for the day.</p>

                            <div class="mt-14.5 flex items-center space-x-8 justify-center">
                                <label class="switch cursor-pointer inline-flex items-center gap-2">
                                    <input id="statusSwitch" type="checkbox" {{ $isCheckedIn ? '' : 'disabled' }}
                                        {{ $status === 'working' ? 'checked' : '' }}
                                        class="appearance-none h-5 w-9.5 checked:bg-green/20 bg-danger/20 rounded-sm
                                        relative cursor-pointer before:block before:h-3.5 before:w-3.5
                                        before:-translate-1/2 before:absolute before:top-1/2 before:left-[calc(14px/2+4px)]
                                        checked:before:bg-green before:rounded-sm before:bg-danger before:duration-300 before:ease-linear
                                        checked:before:left-[calc(100%-(14px/2+4px))]">
                                    <span id="status" class="font-semibold">{{ ucfirst($status) }}</span>
                                </label>
                                <div class="flex items-center gap-2">
                                    <span class="w-8 h-8 bg-[#ECE4FB] flex items-center justify-center rounded-sm"><svg
                                            width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.90234 17.9893C4.2153 17.9893 0.402344 14.1763 0.402344 9.48926C0.402344 4.80222 4.2153 0.989258 8.90234 0.989258C13.5894 0.989258 17.4023 4.80222 17.4023 9.48926C17.4023 14.1763 13.5894 17.9893 8.90234 17.9893ZM8.90234 2.40592C4.99659 2.40592 1.81901 5.58351 1.81901 9.48926C1.81901 13.395 4.99659 16.5726 8.90234 16.5726C12.8081 16.5726 15.9857 13.395 15.9857 9.48926C15.9857 5.58351 12.8081 2.40592 8.90234 2.40592ZM10.6732 12.5563C11.0125 12.3608 11.1286 11.9273 10.9324 11.5888L9.61068 9.29942V5.23926C9.61068 4.84826 9.29405 4.53092 8.90234 4.53092C8.51064 4.53092 8.19401 4.84826 8.19401 5.23926V9.48926C8.19401 9.61392 8.22659 9.73576 8.28893 9.84342L9.70559 12.2971C9.83734 12.5245 10.0746 12.6513 10.3197 12.6513C10.4401 12.6513 10.562 12.6208 10.6732 12.5563Z"
                                                fill="#8C50EC" />
                                        </svg>
                                    </span>
                                    <div class="flex flex-col text-left">
                                        <span id="trakingTimer" class="font-semibold">00:00:00</span>
                                        <span class="text-[10px]">Duration</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 gap-4 flex justify-center">
                                <button id="timerPlayPause"
                                    class="bg-green text-white py-2.5 px-2 font-semibold rounded-md cursor-pointer w-32">Play</button>
                                <button id="clockInOut"
                                    class="bg-purple text-white py-2.5 px-2 font-semibold rounded-md cursor-pointer w-32">
                                    {{ $isCheckedIn ? 'Clock Out' : 'Clock In' }}
                                </button>
                            </div>

                            <p class="mt-4.5">
                                <span class="font-semibold">Check In :</span>
                                <span
                                    id="clockInTime">{{ $checkInTime ? $checkInTime->format('h:i:s A') : '--:--' }}</span>
                                (<span id="clockStatus">{{ $isCheckedIn ? 'Working' : 'Free' }}</span>)
                            </p>

                        </div>
                    </div>

                    <div class="w-full xl:w-1/2 2xl:w-1/3 px-3 my-3 2xl:my-0">
                        <div class="calendar bg-lightgraybg p-6 w-full shadow-primary font-medium rounded-10px">
                            <div class="cal-head text-center relative mb-4 flex justify-between">
                                <h3 class="title font-semibold text-xl">Month 0000</h3>
                                <div class="flex items-center gap-2">
                                    <button class="w-7.5 h-7.5 flex items-center justify-center rounded-full cursor-pointer"
                                        id="prev"><svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M4.26756 9.80322C4.31713 9.855 4.37642 9.89631 4.44198 9.92473C4.50754 9.95315 4.57805 9.9681 4.6494 9.96873C4.72074 9.96936 4.7915 9.95564 4.85754 9.92837C4.92358 9.90111 4.98357 9.86085 5.03402 9.80994C5.08448 9.75903 5.12437 9.69849 5.15139 9.63185C5.17841 9.56522 5.19201 9.49382 5.19139 9.42182C5.19077 9.34983 5.17594 9.27868 5.14778 9.21252C5.11962 9.14637 5.07868 9.08654 5.02736 9.03652L1.86833 5.84882C1.7676 5.74714 1.71101 5.60925 1.71101 5.46547C1.71101 5.3217 1.7676 5.18381 1.86833 5.08213L5.0279 1.89443C5.12866 1.79268 5.18523 1.65472 5.18518 1.51089C5.18513 1.36705 5.12846 1.22913 5.02763 1.12746C4.92681 1.02579 4.79008 0.968699 4.64754 0.96875C4.505 0.968801 4.36832 1.02599 4.26756 1.12773L0.348733 5.08213C0.247997 5.18381 0.191407 5.3217 0.191407 5.46547C0.191407 5.60925 0.247997 5.74714 0.348733 5.84882L4.26756 9.80322Z"
                                                fill="#6B7A99" />
                                        </svg>
                                    </button>
                                    <button
                                        class="w-7.5 h-7.5 flex items-center justify-center rounded-full cursor-pointer bg-purple"
                                        id="next"><svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M1.3965 9.80322C1.34693 9.855 1.28764 9.89631 1.22208 9.92473C1.15652 9.95315 1.08601 9.9681 1.01467 9.96873C0.943319 9.96936 0.872562 9.95564 0.806524 9.92837C0.740487 9.90111 0.680492 9.86085 0.630039 9.80994C0.579587 9.75903 0.539688 9.69849 0.51267 9.63185C0.485652 9.56522 0.472056 9.49382 0.472676 9.42182C0.473296 9.34983 0.488119 9.27868 0.516281 9.21252C0.544442 9.14637 0.585378 9.08654 0.6367 9.03652L3.79573 5.84882C3.89646 5.74714 3.95305 5.60925 3.95305 5.46547C3.95305 5.3217 3.89646 5.18381 3.79573 5.08213L0.636161 1.89443C0.535405 1.79268 0.47883 1.65472 0.47888 1.51089C0.478931 1.36705 0.535603 1.22913 0.63643 1.12746C0.737257 1.02579 0.87398 0.968701 1.01652 0.968751C1.15906 0.968802 1.29574 1.02599 1.3965 1.12773L5.31533 5.08213C5.41607 5.18381 5.47266 5.3217 5.47266 5.46547C5.47266 5.60925 5.41607 5.74714 5.31533 5.84882L1.3965 9.80322Z"
                                                fill="#FAFBFC" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="cal-body text-xs">
                                <ul class="days">
                                    <li>Mon</li>
                                    <li>Tue</li>
                                    <li>Wed</li>
                                    <li>Thu</li>
                                    <li>Fri</li>
                                    <li>Sat</li>
                                    <li>Sun</li>
                                </ul>
                                <ul class="dates">
                                    <li class="old"><span>30</span></li>
                                    <li class="old"><span>31</span></li>
                                    <li><span>1</span></li>
                                    <li><span>2</span></li>
                                    <li><span>3</span></li>
                                    <li><span>4</span></li>
                                    <li><span>5</span></li>
                                </ul>
                            </div>
                        </div>
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
        let isPaused = true;
        let duration = 0;
        let timerInterval;
        let timerEnabled = false; // ✅ Control flag

        function startLiveClock() {
            const clockElement = document.getElementById('clock');
            if (!clockElement) return; // Prevent error if element not found

            setInterval(() => {
                const now = new Date();
                clockElement.textContent = now.toLocaleTimeString();
            }, 1000);
        }


        function updateTimerDisplay() {
            const hours = String(Math.floor(duration / 3600)).padStart(2, '0');
            const minutes = String(Math.floor((duration % 3600) / 60)).padStart(2, '0');
            const seconds = String(duration % 60).padStart(2, '0');
            document.getElementById("trakingTimer").innerText = `${hours}:${minutes}:${seconds}`;
        }

        function toggleTimer() {
            if (!timerEnabled) return; // ❌ Prevent if not allowed
            if (isPaused) {
                timerInterval = setInterval(() => {
                    duration++;
                    updateTimerDisplay();
                }, 1000);
                document.getElementById("timerPlayPause").innerText = "Pause";
            } else {
                clearInterval(timerInterval);
                document.getElementById("timerPlayPause").innerText = "Play";
            }
            isPaused = !isPaused;
        }

        // ✅ Attach the event listener
        document.getElementById("timerPlayPause").addEventListener("click", toggleTimer);

        document.getElementById("clockInOut").addEventListener("click", () => {
            fetch("{{ route('attendance.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({})
                })
                .then(res => res.json())
                .then(data => {
                    const clockBtn = document.getElementById("clockInOut");

                    Swal.fire({
                        title: data.message === "Clocked in" ? "Success!" : "Done!",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    if ($.fn.DataTable.isDataTable('.table-leavetype')) {
                        $('.table-leavetype').DataTable().ajax.reload();
                    }

                    if (data.message === "Clocked in") {
                        clockBtn.innerText = "Clock Out";
                        document.getElementById("statusSwitch").disabled = false;
                        document.getElementById("clockInTime").innerText = new Date().toLocaleTimeString();
                        document.getElementById("clockStatus").innerText = "Working";
                        document.getElementById("timerPlayPause").disabled = false;

                        duration = 0;
                        updateTimerDisplay();
                        isPaused = true;
                        timerEnabled = true;
                        toggleTimer();

                    } else if (data.message === "Clocked out") {
                        const timeOut = new Date().toLocaleTimeString();
                        document.getElementById("clockOutTime")?.remove();
                        const checkInPara = document.querySelector("p.mt-4.5");
                        checkInPara.insertAdjacentHTML("beforeend",
                            ` <span id="clockOutTime"> | <span class="font-semibold">Check Out :</span> ${timeOut}</span>`
                        );

                        clockBtn.innerText = "Clocked Out";
                        clockBtn.disabled = true;
                        document.getElementById("statusSwitch").disabled = true;
                        document.getElementById("timerPlayPause").disabled = true;
                        timerEnabled = false;
                        clearInterval(timerInterval);
                    }
                });
        });


        document.getElementById("statusSwitch").addEventListener("change", function() {
            const status = this.checked ? "working" : "free";
            document.getElementById("status").innerText = status.charAt(0).toUpperCase() + status.slice(1);
            document.getElementById("clockStatus").innerText = document.getElementById("status").innerText;

            fetch("{{ route('attendance.status') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        status
                    })
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data.message);

                    // ✅ Reload DataTable after status update
                    if ($.fn.DataTable.isDataTable('.table-leavetype')) {
                        $('.table-leavetype').DataTable().ajax.reload();
                    }
                });
        });


        window.addEventListener('DOMContentLoaded', () => {
            startLiveClock();

            const isCheckedIn = @json($isCheckedIn);
            const startTime = @json($checkInTime ? $checkInTime->timestamp : null);
            const checkOutTime = @json($checkOutTime ? $checkOutTime->format('h:i:s A') : null);
            const now = Math.floor(Date.now() / 1000);

            if (isCheckedIn && startTime) {
                duration = now - startTime;
                updateTimerDisplay();
                isPaused = true;
                timerEnabled = true;
                toggleTimer();

                document.getElementById("clockInOut").innerText = "Clock Out";
                document.getElementById("statusSwitch").disabled = false;
                document.getElementById("timerPlayPause").disabled = false;
            } else if (checkOutTime) {
                document.getElementById("clockInOut").innerText = "Clocked Out";
                document.getElementById("clockInOut").disabled = true;
                document.getElementById("timerPlayPause").disabled = true;
                document.getElementById("statusSwitch").disabled = true;
                timerEnabled = false;

                const checkInPara = document.querySelector("p.mt-4.5");
                checkInPara.insertAdjacentHTML("beforeend",
                    ` <span id="clockOutTime"> | <span class="font-semibold">Check Out :</span> ${checkOutTime}</span>`
                );
            } else {
                // ❌ Initial page load: disable play/pause
                document.getElementById("timerPlayPause").disabled = true;
                timerEnabled = false;
            }
        });
    </script>

    {{-- yajra table data  --}}
    <script>
        $(document).ready(function() {
            $('.table-leavetype').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('myattendance') }}',
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

                ]
            });
        });
    </script>
    {{-- Today Time --}}
    <script>
        function updateClock() {
            const now = new Date();

            // Time in 12-hour format
            let hours = now.getHours();
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12 || 12; // Convert to 12-hour format
            const time = `${hours}:${minutes} ${ampm}`;

            // Date in DD/MM/YYYY format
            const day = now.getDate().toString().padStart(2, '0');
            const month = (now.getMonth() + 1).toString().padStart(2, '0');
            const year = now.getFullYear();
            const date = `${day}/${month}/${year}`;

            document.getElementById('todayclock').textContent = time;
        }

        setInterval(updateClock, 1000);
        updateClock(); // Initial call
    </script>
@endsection
