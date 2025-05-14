@extends('layouts.admin')
@section('content')
    @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Manager'))
        <div class="flex flex-wrap -mx-5 mt-10 lg:mt-11">
            <div class="w-full xl:w-2/3 px-4">
                <div class="shadow-primary bg-white p-4 md:py-6 md:px-6 2xl:px-9 rounded-10px">
                    <div class="flex flex-wrap -mx-2 2xl:-mx-3">
                        <div class="w-1/2 2xl:w-1/4 p-2 2xl:px-3">
                            <div class="bg-lightgraybg p-4 h-full sm:p-6 rounded-10px">
                                <h5 class="mb-3.5 font-semibold text-base">Active Staff</h5>
                                <div class="text-green flex items-center font-extrabold text-4xl">
                                    <span
                                        class="mr-3.5 w-10 h-10 bg-green/10 rounded-md flex justify-center items-center"><svg
                                            width="22" height="20" viewBox="0 0 22 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.2761 3.92085C14.2933 4.55864 15.0066 5.63791 15.1364 6.8907C15.563 7.09136 16.0285 7.19559 16.4999 7.196C18.282 7.196 19.7264 5.75158 19.7264 3.96972C19.7264 2.18759 18.282 0.743164 16.4999 0.743164C14.7348 0.743713 13.303 2.16233 13.2761 3.92085ZM11.1623 10.5272C12.9444 10.5272 14.3888 9.08246 14.3888 7.30061C14.3888 5.51875 12.9441 4.07433 11.1623 4.07433C9.38041 4.07433 7.93516 5.51903 7.93516 7.30088C7.93516 9.08274 9.38041 10.5272 11.1623 10.5272ZM12.5309 10.7471H9.79306C7.51509 10.7471 5.66185 12.6006 5.66185 14.8786V18.2268L5.67036 18.2792L5.90099 18.3514C8.0749 19.0306 9.96356 19.2572 11.5181 19.2572C14.5544 19.2572 16.3143 18.3915 16.4227 18.3363L16.6382 18.2273H16.6613V14.8786C16.6621 12.6006 14.8089 10.7471 12.5309 10.7471ZM17.8691 7.4162H15.1524C15.1248 8.4652 14.6836 9.46077 13.9251 10.1859C15.9499 10.788 17.4314 12.6657 17.4314 14.8835V15.9153C20.1138 15.817 21.6596 15.0568 21.7614 15.0057L21.9769 14.8964H22V11.5471C22 9.26943 20.1468 7.4162 17.8691 7.4162ZM5.50069 7.19655C6.13189 7.19655 6.71916 7.01233 7.21665 6.69851C7.37275 5.68883 7.90992 4.77739 8.71763 4.15175C8.72093 4.09135 8.72669 4.0315 8.72669 3.97055C8.72669 2.18842 7.28199 0.743988 5.50069 0.743988C3.71828 0.743988 2.27413 2.18842 2.27413 3.97055C2.27413 5.75185 3.71828 7.19655 5.50069 7.19655ZM8.39833 10.1859C7.64402 9.46423 7.20355 8.47502 7.1719 7.43157C7.07113 7.42416 6.97147 7.4162 6.86879 7.4162H4.13121C1.85324 7.4162 0 9.26943 0 11.5471V14.8959L0.00851117 14.9475L0.239136 15.0202C1.9831 15.5647 3.53955 15.8156 4.89145 15.8947V14.8835C4.892 12.6657 6.37294 10.7885 8.39833 10.1859Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    {{ $staff }}
                                </div>
                                <p class="font-medium text-lightgray mt-3.5">Registered Staff</p>
                            </div>
                        </div>
                        <div class="w-1/2 2xl:w-1/4 p-2 2xl:px-3">
                            <div class="bg-lightgraybg p-4 h-full sm:p-6 rounded-10px">
                                <h5 class="mb-3.5 font-semibold text-base">Department</h5>
                                <div class="text-orange flex items-center font-extrabold text-4xl">
                                    <span class="mr-3.5 w-10 h-10 bg-orange/10 rounded-md flex justify-center items-center">
                                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.4613 1.00547C21.1023 0.646474 20.6709 0.466797 20.1666 0.466797H1.83333C1.32918 0.466797 0.897704 0.646474 0.53847 1.00547C0.179436 1.36458 0 1.79601 0 2.30021V14.767C0 15.2713 0.179436 15.7027 0.53847 16.0619C0.897704 16.4209 1.32918 16.6002 1.83333 16.6002H8.06677C8.06677 16.8904 8.00561 17.1886 7.88336 17.4939C7.7612 17.7995 7.63895 18.0668 7.5167 18.2959C7.39462 18.5252 7.33349 18.6931 7.33349 18.7999C7.33349 18.9985 7.40601 19.1708 7.55118 19.3155C7.69626 19.4608 7.86815 19.5336 8.06677 19.5336H13.9334C14.1321 19.5336 14.304 19.4609 14.4491 19.3155C14.5943 19.1708 14.6669 18.9986 14.6669 18.7999C14.6669 18.7009 14.6056 18.5346 14.4834 18.3017C14.3612 18.0689 14.2389 17.7974 14.1168 17.4883C13.9946 17.1789 13.9335 16.8829 13.9335 16.6002H20.1669C20.671 16.6002 21.1024 16.4209 21.4614 16.0619C21.8205 15.7027 22 15.2713 22 14.767V2.30021C22.0002 1.79601 21.8205 1.36458 21.4613 1.00547ZM20.5333 11.8336C20.5333 11.9329 20.4971 12.0187 20.4245 12.0914C20.3519 12.1638 20.2659 12.2 20.1666 12.2H1.83333C1.73408 12.2 1.64812 12.1638 1.57556 12.0914C1.50304 12.0185 1.46671 11.9329 1.46671 11.8336V2.30021C1.46671 2.20088 1.50292 2.115 1.57556 2.04243C1.64816 1.96999 1.73412 1.93359 1.83333 1.93359H20.1669C20.266 1.93359 20.3522 1.96987 20.4245 2.04243C20.4971 2.11504 20.5333 2.20092 20.5333 2.30021V11.8336Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    {{ $department }}
                                </div>
                                <p class="font-medium text-lightgray mt-3.5">Available
                                    Departments</p>
                            </div>
                        </div>
                        <div class="w-1/2 2xl:w-1/4 p-2 2xl:px-3">
                            <div class="bg-lightgraybg p-4 h-full sm:p-6 rounded-10px">
                                <h5 class="mb-3.5 font-semibold text-base">Leave Types</h5>
                                <div class="text-purple flex items-center font-extrabold text-4xl">
                                    <span class="mr-3.5 w-10 h-10 bg-purple/10 rounded-md flex justify-center items-center">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M19.9377 8.84876C19.8952 8.74707 19.8344 8.65457 19.7569 8.57706L17.2575 6.07775C16.9317 5.75273 16.405 5.75273 16.0791 6.07775C15.7533 6.40359 15.7533 6.93111 16.0791 7.25613L17.1567 8.33369H12.5013C12.0405 8.33369 11.668 8.70703 11.668 9.16705C11.668 9.62708 12.0405 10.0004 12.5013 10.0004H17.1567L16.0791 11.078C15.7532 11.4038 15.7532 11.9313 16.0791 12.2564C16.2416 12.4197 16.4549 12.5006 16.6683 12.5006C16.8817 12.5006 17.095 12.4197 17.2575 12.2564L19.7569 9.75705C19.8344 9.68036 19.8952 9.58786 19.9377 9.48535C20.0218 9.2815 20.0218 9.05261 19.9377 8.84876Z"
                                                fill="currentColor" />
                                            <path
                                                d="M14.1676 11.6673C13.7067 11.6673 13.3342 12.0406 13.3342 12.5007V16.6676H10.0007V3.3335C10.0007 2.96598 9.75898 2.64096 9.40645 2.53514L6.51208 1.66677H13.3342V5.83367C13.3342 6.2937 13.7067 6.66704 14.1676 6.66704C14.6284 6.66704 15.001 6.2937 15.001 5.83367V0.833404C15.001 0.37334 14.6284 0 14.1676 0H0.833376C0.803374 0 0.776693 0.0125007 0.74755 0.0158212C0.708368 0.0200011 0.672545 0.0266421 0.635043 0.0358222C0.549847 0.057436 0.468577 0.0923032 0.394206 0.139148C0.375885 0.150828 0.353383 0.151649 0.335882 0.16497C0.329163 0.170009 0.326663 0.179189 0.319982 0.18419C0.229156 0.255834 0.153331 0.343339 0.0983269 0.447524C0.0866465 0.470025 0.0841463 0.494206 0.075005 0.517528C0.0483236 0.580852 0.019181 0.642535 0.0091803 0.712538C0.00500034 0.73754 0.0125008 0.760861 0.0116805 0.785042C0.0108601 0.801723 0 0.816724 0 0.833365V17.5009C0 17.8985 0.280839 18.2402 0.670045 18.3177L9.00393 19.9844C9.05811 19.9961 9.11311 20.0011 9.16726 20.0011C9.35996 20.0011 9.5467 19.9342 9.69561 19.8119C9.79089 19.7337 9.86765 19.6354 9.92039 19.524C9.97313 19.4126 10.0005 19.291 10.0006 19.1677V18.3343H14.1676C14.6284 18.3343 15.001 17.961 15.001 17.501V12.5007C15.001 12.0406 14.6284 11.6673 14.1676 11.6673Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    {{ $leavetype }}
                                </div>
                                <p class="font-medium text-lightgray mt-3.5">Active Leave Types</p>
                            </div>
                        </div>
                        <div class="w-1/2 2xl:w-1/4 p-2 2xl:px-3">
                            <div class="bg-lightgraybg p-4 h-full sm:p-6 rounded-10px">
                                <h5 class="mb-3.5 font-semibold text-base">Leave</h5>
                                <div class="text-blue flex items-center font-extrabold text-4xl">
                                    <span class="mr-3.5 w-10 h-10 bg-blue/10 rounded-md flex justify-center items-center">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M16.3779 6.3633C16.1934 6.548 16.0898 6.79839 16.0898 7.05944C16.0898 7.3205 16.1934 7.57088 16.3779 7.75559L18.6371 10.0148H7.87964C7.61838 10.0148 7.36781 10.1186 7.18306 10.3033C6.99832 10.4881 6.89453 10.7386 6.89453 10.9999C6.89453 11.2612 6.99832 11.5117 7.18306 11.6965C7.36781 11.8812 7.61838 11.985 7.87964 11.985H18.6371L16.3779 14.2442C16.2811 14.3344 16.2035 14.4431 16.1496 14.564C16.0958 14.6848 16.0668 14.8153 16.0645 14.9475C16.0622 15.0798 16.0865 15.2112 16.136 15.3339C16.1856 15.4565 16.2593 15.568 16.3529 15.6615C16.4464 15.755 16.5579 15.8288 16.6805 15.8783C16.8032 15.9279 16.9346 15.9522 17.0668 15.9499C17.1991 15.9475 17.3296 15.9186 17.4504 15.8648C17.5712 15.8109 17.68 15.7333 17.7702 15.6365L21.7106 11.696C21.8951 11.5113 21.9987 11.261 21.9987 10.9999C21.9987 10.7388 21.8951 10.4885 21.7106 10.3037L17.7702 6.3633C17.5855 6.17882 17.3351 6.0752 17.074 6.0752C16.813 6.0752 16.5626 6.17882 16.3779 6.3633Z"
                                                fill="currentColor" />
                                            <path
                                                d="M0 11.0001C0 13.7869 1.10708 16.4596 3.07769 18.4303C5.0483 20.4009 7.72101 21.5079 10.5079 21.5079V16.5824C10.5079 15.3438 10.5079 14.7251 10.123 14.3403C9.73817 13.9554 9.11952 13.9554 7.88091 13.9554C7.0971 13.9554 6.3454 13.644 5.79117 13.0898C5.23693 12.5356 4.92557 11.7839 4.92557 11.0001C4.92557 10.2163 5.23693 9.46456 5.79117 8.91032C6.3454 8.35609 7.0971 8.04472 7.88091 8.04472C9.11952 8.04472 9.73817 8.04472 10.123 7.65987C10.5079 7.27502 10.5079 6.65637 10.5079 5.41775V0.492188C7.72101 0.492188 5.0483 1.59926 3.07769 3.56987C1.10708 5.54048 0 8.2132 0 11.0001Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    {{ $leave }}
                                </div>
                                <p class="font-medium text-lightgray mt-3.5">Active Leave Types</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3.5 pt-7">
                    <div class="w-full md:w-1/4 px-3.5">
                        <div class="flex flex-wrap -mx-3 md:-my-3.5 mb-5">
                            <div class="w-1/2 py-3.5 px-3 md:w-full">
                                <div
                                    class="shadow-primary bg-white p-4 md:py-7 md:px-6 2xl:py-10 2xl:px-7 rounded-10px h-full">
                                    <div class="flex items-end justify-center">
                                        <h4 class="font-extrabold text-4xl 2xl:text-5xl leading-none">{{ $pendingleave }}
                                        </h4>

                                    </div>
                                    <p class="text-base font-semibold text-center mt-2">Pending Leave</p>
                                </div>
                            </div>
                            <div class="w-1/2 py-3.5 px-3 md:w-full">
                                <div
                                    class="shadow-primary bg-white p-4 md:py-7 md:px-6 2xl:py-10 2xl:px-7 rounded-10px h-full">
                                    <div class="flex items-end justify-center">
                                        <h4 class="font-extrabold text-4xl 2xl:text-5xl leading-none">{{ $aprovleave }}
                                        </h4>

                                    </div>
                                    <p class="text-base font-semibold text-center mt-2">Approved Leave</p>
                                </div>
                            </div>
                            <div class="w-1/2 py-3.5 px-3 md:w-full">
                                <div
                                    class="shadow-primary bg-white p-4 md:py-7 md:px-6 2xl:py-10 2xl:px-7 rounded-10px h-full">
                                    <div class="flex items-end justify-center">
                                        <h4 class="font-extrabold text-4xl 2xl:text-5xl leading-none">{{ $rejectedleave }}
                                        </h4>
                                    </div>
                                    <p class="text-base font-semibold text-center mt-2">Rejected Leave</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-3/4 px-3.5 space-y-7">
                        <div class="p-4 md:py-6 md:px-6 2xl:px-9 bg-white shadow-primary rounded-10px">
                            <div class="flex items-center justify-between">
                                <h4 class="text-base font-semibold">Today’s Attendance</h4>
                                <a href="{{ route('attendance.index') }}"
                                    class="bg-primarybg py-2 px-5.5 rounded-full font-semibold hover:bg-gray duration-300">View
                                    All</a>
                            </div>
                            <table class="table-index display nowrap custom-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>First name</th>
                                        <th>Status</th>
                                        <th class="text-center">Time In</th>
                                        <th class="text-center">Time Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentAttendance as $attendance)
                                        <tr>
                                            <td>
                                                <div class="flex items-center"><img
                                                        src="{{ $attendance->user->avatar
                                                            ? asset('admin-uploads/avatar/' . $attendance->user->avatar)
                                                            : asset('admin-assets/images/user-2.jpg') }}"
                                                        alt=" {{ $attendance->user->first_name ?? '' }}
                                                            {{ $attendance->user->last_name }}"
                                                        class="rounded-full w-9 h-9 mr-2.5">
                                                    {{ $attendance->user->first_name ?? '' }}
                                                    {{ $attendance->user->last_name ?? '' }}</div>

                                            </td>
                                            <td class="table-warning">{{ strtoupper($attendance->check_in_type) }}</td>
                                            <td style="text-align: center">
                                                {{ \Carbon\Carbon::parse($attendance->time_in)->format('h:i A') }}</td>
                                            <td style="text-align: center">
                                                {{ \Carbon\Carbon::parse($attendance->time_out)->format('h:i A') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4 md:py-6 md:px-6 2xl:px-9 bg-white shadow-primary rounded-10px">
                            <div class="flex items-center justify-between">
                                <h4 class="text-base font-semibold">Recent Leave</h4>
                                <a href="{{ route('allleave') }}"
                                    class="bg-primarybg py-2 px-5.5 rounded-full font-semibold hover:bg-gray duration-300">View
                                    All</a>
                            </div>
                            <table class="table-index display nowrap custom-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Leave Type</th>
                                        <th>start Date</th>
                                        <th>End Date</th>
                                        <th>Request Days</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentLeave as $leave)
                                        <tr>
                                            <td style="text-align: center">
                                                <div class="flex items-center">
                                                    {{ $attendance->user->first_name ?? '' }}
                                                    {{ $attendance->user->last_name ?? '' }}</div>

                                            </td>
                                            <td style="text-align: center">{{ $leave->leavetype->leave_type }}</td>
                                            <td style="text-align: center">{{ $leave->from_date }}</td>
                                            <td style="text-align: center">{{ $leave->to_date }}</td>
                                            <td style="text-align: center">{{ $leave->requested_days }}</td>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full mt-7 xl:mt-0 xl:w-1/3 px-4">
                <div class="shadow-primary bg-white rounded-10px">
                    <div class="overflow-auto overflow-y-hidden custom-scroll">
                        <ul id="tabs-nav"
                            class="flex justify-between px-5 2xl:px-7 border-b-2 border-gray font-semibold whitespace-nowrap">
                            <li class="pr-3 duration-300"><a class="relative inline-block py-5 after:duration-300"
                                    href="#tab1">Department</a></li>
                            <li class="px-3 duration-300"><a class="relative inline-block py-5 after:duration-300"
                                    href="#tab2">All Staff</a></li>
                            <li class="px-3 duration-300"><a class="relative inline-block py-5 after:duration-300"
                                    href="#tab3">Salary Report</a></li>
                        </ul>
                    </div>
                    <div id="tabs-content" class="">
                        <div id="tab1" class="tab-content">
                            @foreach ($departmentData as $data)
                                <div class="px-5 2xl:px-7 py-6 border-b-2 border-gray">
                                    <div class="flex items-center">
                                        <div
                                            class="border-2 border-gray rounded-full w-20 h-20 2xl:w-26 2xl:h-26 flex items-center justify-center">
                                            <img src="{{ $data['department']->logo ? asset('admin-uploads/department-logos/' . $data['department']->logo) : asset('admin-assets/images/icons/shopify.png') }}"
                                                alt="shopify" class="w-9 h-9">
                                        </div>
                                        <div class="w-[calc(100%-98px)] 2xl:w-[calc(100%-130px)] px-2 2xl:px-8">
                                            <h4 class="font-bold">{{ $data['department']->name }}</h4>
                                            @php
                                                $totalUsers = 50; // total department users
                                                $presentUsers = count($data['users']); // users who have attendance today
                                                $percentage =
                                                    $totalUsers > 0 ? round(($presentUsers / $totalUsers) * 100) : 0;

                                                // Optional: cap at 99% visually
                                                $barWidth = $percentage === 100 ? 99 : $percentage;
                                            @endphp
                                            <div class="flex items-center font-bold text-xs my-3 md:my-4.5">
                                                <div style="--width:{{ $barWidth }}%"
                                                    class="w-full bg-gray relative before:inset-x-0 before:absolute before:h-full before:w-[var(--width)] before:bg-green h-0.5 mr-4.5">
                                                </div>
                                                {{ $percentage }}%
                                            </div>
                                            <div class="flex gap-1.5">
                                                @foreach ($data['users'] as $userData)
                                                    <img src="{{ $userData['user']->avatar ? asset('admin-uploads/avatar/' . $userData['user']->avatar) : asset('admin-assets/images/user.jpg') }}"
                                                        class="md:w-6 md:h-6 w-5 h-5 rounded-full object-cover"
                                                        alt="{{ $userData['user']->first_name }} {{ $userData['user']->last_name }}">
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="w-4.5 self-start relative">
                                            <button class="dropdown-toggle cursor-pointer"><svg width="17"
                                                    height="5" viewBox="0 0 17 5" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14.875 4.25C16.0486 4.25 17 3.2986 17 2.125C17 0.951395 16.0486 0 14.875 0C13.7014 0 12.75 0.951395 12.75 2.125C12.75 3.2986 13.7014 4.25 14.875 4.25Z"
                                                        fill="#C3CAD9" />
                                                    <path
                                                        d="M8.5 4.25C9.6736 4.25 10.625 3.2986 10.625 2.125C10.625 0.951395 9.6736 0 8.5 0C7.32639 0 6.375 0.951395 6.375 2.125C6.375 3.2986 7.32639 4.25 8.5 4.25Z"
                                                        fill="#C3CAD9" />
                                                    <path
                                                        d="M2.125 4.25C3.2986 4.25 4.25 3.2986 4.25 2.125C4.25 0.951395 3.2986 0 2.125 0C0.951395 0 0 0.951395 0 2.125C0 3.2986 0.951395 4.25 2.125 4.25Z"
                                                        fill="#C3CAD9" />
                                                </svg>
                                            </button>
                                            <ul
                                                class="dropdown-menu absolute right-0 top-full w-28 rounded-10px p-4.5 bg-white shadow-primary text-xs font-medium space-y-3 invisible opacity-0 duration-300">
                                                <li><a href="{{ route('new-staff.index') }}"
                                                        class="duration-300 cursor-pointer hover:text-purple">View
                                                        Staff</a></li>
                                                <li>
                                                    <button
                                                        class="duration-300 cursor-pointer hover:text-purple edit-button"
                                                        data-id="{{ $data['department']->id }}"
                                                        data-name="{{ $data['department']->name }}"
                                                        data-description="{{ $data['department']->description }}">
                                                        Edit
                                                    </button>
                                                </li>

                                                <li>
                                                    <button
                                                        class="delete-button duration-300 cursor-pointer hover:text-purple"
                                                        data-id="{{ $data['department']->id }}">
                                                        Delete
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <ul class="font-semibold mt-6 flex flex-wrap gap-y-5 -mx-1 2xl:text-sm text-xs">
                                        <li class="flex items-center w-1/2 px-1"><svg class="mr-3.5" width="18"
                                                height="16" viewBox="0 0 18 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.8622 2.59993C11.6945 3.12175 12.2781 4.00479 12.3844 5.0298C12.7333 5.19398 13.1142 5.27926 13.4999 5.2796C14.958 5.2796 16.1398 4.09779 16.1398 2.63991C16.1398 1.1818 14.958 0 13.4999 0C12.0557 0.00044927 10.8842 1.16114 10.8622 2.59993ZM9.13276 8.00509C10.5909 8.00509 11.7727 6.82306 11.7727 5.36518C11.7727 3.9073 10.5906 2.7255 9.13276 2.7255C7.67488 2.7255 6.4924 3.90753 6.4924 5.36541C6.4924 6.82329 7.67488 8.00509 9.13276 8.00509ZM10.2526 8.18502H8.0125C6.14871 8.18502 4.63242 9.70154 4.63242 11.5653V14.3048L4.63939 14.3477L4.82808 14.4067C6.60674 14.9625 8.152 15.1478 9.42389 15.1478C11.9081 15.1478 13.348 14.4395 13.4368 14.3944L13.6131 14.3052H13.632V11.5653C13.6326 9.70154 12.1164 8.18502 10.2526 8.18502ZM14.6201 5.45975H12.3974C12.3748 6.31803 12.0139 7.13258 11.3933 7.72587C13.0499 8.2185 14.2621 9.75477 14.2621 11.5694V12.4136C16.4568 12.3331 17.7215 11.7111 17.8048 11.6693L17.9811 11.5799H18V8.83961C18 6.97604 16.4837 5.45975 14.6201 5.45975ZM4.50056 5.28005C5.017 5.28005 5.49749 5.12931 5.90453 4.87256C6.03225 4.04645 6.47176 3.30073 7.13261 2.78884C7.13531 2.73942 7.14002 2.69045 7.14002 2.64058C7.14002 1.18248 5.95799 0.000673856 4.50056 0.000673856C3.04223 0.000673856 1.86065 1.18248 1.86065 2.64058C1.86065 4.09802 3.04223 5.28005 4.50056 5.28005ZM6.87136 7.72587C6.2542 7.13542 5.89381 6.32606 5.86791 5.47233C5.78547 5.46627 5.70393 5.45975 5.61992 5.45975H3.38008C1.51629 5.45975 0 6.97604 0 8.83961V11.5795L0.00696368 11.6217L0.195657 11.6812C1.62254 12.1267 2.89599 12.332 4.0021 12.3967V11.5694C4.00255 9.75477 5.21423 8.21894 6.87136 7.72587Z"
                                                    fill="#C3CAD9" />
                                            </svg>
                                            <span class="w-[calc(100%-32px)]">Staff:
                                                {{ $data['department']->users_count }}</span>
                                        </li>
                                        <li class="flex items-center w-1/2 px-1"><svg class="mr-3.5" width="18"
                                                height="17" viewBox="0 0 18 17" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18 12.8571V14.4643C18 15.3508 17.2787 16.0714 16.3929 16.0714H2.57143C1.15329 16.0714 0 14.9181 0 13.5V2.57143C0 1.15329 1.15329 0 2.57143 0H14.4643C14.5909 -2.66857e-09 14.7163 0.0249419 14.8333 0.0734018C14.9503 0.121862 15.0566 0.19289 15.1461 0.282433C15.2357 0.371975 15.3067 0.478277 15.3552 0.59527C15.4036 0.712262 15.4286 0.837654 15.4286 0.964286C15.4286 1.09092 15.4036 1.21631 15.3552 1.3333C15.3067 1.45029 15.2357 1.5566 15.1461 1.64614C15.0566 1.73568 14.9503 1.80671 14.8333 1.85517C14.7163 1.90363 14.5909 1.92857 14.4643 1.92857H2.57143C2.40591 1.93598 2.24962 2.00694 2.13511 2.12669C2.02059 2.24644 1.95669 2.40574 1.95669 2.57143C1.95669 2.73712 2.02059 2.89642 2.13511 3.01617C2.24962 3.13592 2.40591 3.20688 2.57143 3.21429H16.3929C17.2787 3.21429 18 3.93493 18 4.82143V6.42857H14.7857C13.0134 6.42857 11.5714 7.8705 11.5714 9.64286C11.5714 11.4152 13.0134 12.8571 14.7857 12.8571H18Z"
                                                    fill="#C3CAD9" />
                                                <path
                                                    d="M18.0003 7.71484V11.572H14.786C14.2745 11.572 13.784 11.3688 13.4223 11.0071C13.0606 10.6454 12.8574 10.1549 12.8574 9.64342C12.8574 9.13193 13.0606 8.64139 13.4223 8.27971C13.784 7.91803 14.2745 7.71484 14.786 7.71484H18.0003Z"
                                                    fill="#C3CAD9" />
                                            </svg>
                                            <span class="w-[calc(100%-32px)]">Total expense:
                                                ₹{{ number_format($data['totalExpense']) }}</span>
                                        </li>
                                        <li class="flex items-center w-1/2 px-1"><svg class="mr-3.5" width="20"
                                                height="19" viewBox="0 0 20 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9.65562 4.36035V6.22906C9.86213 6.22906 10.0602 6.14703 10.2062 6.00101C10.3522 5.85498 10.4343 5.65694 10.4343 5.45043V5.13898C10.4343 4.93248 10.3522 4.73443 10.2062 4.58841C10.0602 4.44239 9.86213 4.36035 9.65562 4.36035ZM3.42659 4.36035V6.22906C3.22009 6.22906 3.02204 6.14703 2.87602 6.00101C2.73 5.85498 2.64796 5.65694 2.64796 5.45043V5.13898C2.64796 4.93248 2.73 4.73443 2.87602 4.58841C3.02204 4.44239 3.22009 4.36035 3.42659 4.36035ZM0 16.8184H19.31V18.6871H0V16.8184ZM6.22966 14.6644V16.1955H7.76106C7.69578 15.8131 7.51339 15.4604 7.23908 15.1861C6.96477 14.9118 6.61206 14.7297 6.22966 14.6644Z"
                                                    fill="#C3CAD9" />
                                                <path
                                                    d="M14.3269 13.3921C14.843 13.3921 15.2613 12.9738 15.2613 12.4578C15.2613 11.9418 14.843 11.5234 14.3269 11.5234C13.8109 11.5234 13.3926 11.9418 13.3926 12.4578C13.3926 12.9738 13.8109 13.3921 14.3269 13.3921Z"
                                                    fill="#C3CAD9" />
                                                <path
                                                    d="M17.7526 8.7207H10.9006C10.6528 8.7207 10.4152 8.81914 10.2399 8.99437C10.0647 9.16959 9.96628 9.40725 9.96628 9.65506V16.1955H17.7526C18.0004 16.1955 18.238 16.0971 18.4133 15.9219C18.5885 15.7466 18.6869 15.509 18.6869 15.2612V9.65506C18.6869 9.40725 18.5885 9.16959 18.4133 8.99437C18.238 8.81914 18.0004 8.7207 17.7526 8.7207ZM14.3266 14.0154C14.0186 14.0154 13.7175 13.924 13.4614 13.7529C13.2053 13.5818 13.0058 13.3386 12.8879 13.0541C12.77 12.7695 12.7392 12.4564 12.7993 12.1543C12.8594 11.8522 13.0077 11.5748 13.2255 11.357C13.4432 11.1392 13.7207 10.9909 14.0228 10.9308C14.3249 10.8707 14.638 10.9015 14.9225 11.0194C15.2071 11.1373 15.4503 11.3369 15.6214 11.593C15.7925 11.849 15.8839 12.1501 15.8839 12.4581C15.8834 12.871 15.7191 13.2668 15.4272 13.5587C15.1353 13.8507 14.7395 14.0149 14.3266 14.0154ZM9.37484 9.34579C9.36425 9.34579 9.35397 9.34361 9.34369 9.34361H8.25361V9.49933C8.25361 9.95364 8.07314 10.3893 7.75189 10.7106C7.43064 11.0318 6.99494 11.2123 6.54063 11.2123C6.08632 11.2123 5.65061 11.0318 5.32936 10.7106C5.00812 10.3893 4.82764 9.95364 4.82764 9.49933V9.34361H3.73756C2.91154 9.34361 2.11935 9.67174 1.53527 10.2558C0.951182 10.8399 0.623047 11.6321 0.623047 12.4581V14.9497C0.623047 15.2801 0.754301 15.597 0.987935 15.8307C1.22157 16.0643 1.53844 16.1955 1.86885 16.1955H5.60627V14.6383H2.80321C2.72061 14.6383 2.64139 14.6055 2.58298 14.5471C2.52457 14.4887 2.49176 14.4094 2.49176 14.3268C2.49176 14.2442 2.52457 14.165 2.58298 14.1066C2.64139 14.0482 2.72061 14.0154 2.80321 14.0154H5.91772C6.3374 14.0156 6.75009 14.1228 7.11681 14.3268H9.34369V9.65506C9.34373 9.55119 9.35416 9.44758 9.37484 9.34579Z"
                                                    fill="#C3CAD9" />
                                                <path
                                                    d="M7.86089 14.9497C8.149 15.3079 8.33178 15.7393 8.3888 16.1955H9.34465V14.9497H7.86089ZM10.4347 3.97475V3.89315C10.4347 3.38189 10.334 2.87564 10.1384 2.4033C9.94273 1.93096 9.65596 1.50179 9.29445 1.14028C8.93294 0.778764 8.50376 0.491997 8.03142 0.296348C7.55909 0.100699 7.05284 0 6.54158 0C5.50906 0 4.51882 0.410169 3.78871 1.14028C3.05861 1.87038 2.64844 2.86062 2.64844 3.89315V3.97475C2.87857 3.81989 3.14968 3.73725 3.42707 3.73742H4.57134C5.63668 3.7762 6.67448 3.39412 7.46036 2.67381C7.57721 2.5571 7.73561 2.49157 7.90076 2.49161C7.9101 2.49161 7.91944 2.49161 7.92879 2.49224C8.01078 2.49597 8.09123 2.51586 8.16552 2.55076C8.23981 2.58566 8.30648 2.63489 8.36171 2.69561L9.30883 3.73742H9.6561C9.93348 3.73725 10.2046 3.81989 10.4347 3.97475ZM5.4515 9.14266V9.49927C5.4515 9.78838 5.56635 10.0656 5.77078 10.2701C5.97521 10.4745 6.25248 10.5894 6.54158 10.5894C6.83069 10.5894 7.10796 10.4745 7.31239 10.2701C7.51682 10.0656 7.63166 9.78838 7.63166 9.49927V9.14266C6.92958 9.4103 6.15358 9.4103 5.4515 9.14266Z"
                                                    fill="#C3CAD9" />
                                                <path
                                                    d="M7.90126 3.11426C7.02713 3.91554 5.88441 4.36005 4.6986 4.36006H4.05078V6.22877C4.05078 6.88959 4.31329 7.52334 4.78056 7.99061C5.24783 8.45788 5.88158 8.72039 6.54239 8.72039C7.20321 8.72039 7.83696 8.45788 8.30423 7.99061C8.7715 7.52334 9.03401 6.88959 9.03401 6.22877V4.36006L7.90126 3.11426Z"
                                                    fill="#C3CAD9" />
                                            </svg>
                                            <span class="w-[calc(100%-32px)]">In work:
                                                {{ $data['workingCount'] }}</span>
                                        </li>
                                        <li class="flex items-center w-1/2 px-1"><svg class="mr-3.5" width="20"
                                                height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.3438 9.33594H10C9.88411 9.33594 9.77083 9.30157 9.67447 9.23718C9.57811 9.1728 9.50301 9.08128 9.45867 8.97421C9.41432 8.86715 9.40272 8.74933 9.42533 8.63567C9.44794 8.52201 9.50375 8.41761 9.5857 8.33566L10.9292 6.99219H10C9.67641 6.99219 9.41406 6.72984 9.41406 6.40625C9.41406 6.08266 9.67641 5.82031 10 5.82031H12.3438C12.4596 5.82031 12.5729 5.85468 12.6693 5.91907C12.7656 5.98345 12.8407 6.07497 12.8851 6.18204C12.9294 6.2891 12.941 6.40692 12.9184 6.52058C12.8958 6.63424 12.84 6.73864 12.758 6.82059L11.4146 8.16406H12.3438C12.6673 8.16406 12.9297 8.42641 12.9297 8.75C12.9297 9.07359 12.6673 9.33594 12.3438 9.33594ZM17.0312 4.64844H14.6875C14.5716 4.64844 14.4583 4.61407 14.362 4.54968C14.2656 4.4853 14.1905 4.39378 14.1462 4.28671C14.1018 4.17965 14.0902 4.06183 14.1128 3.94817C14.1354 3.83451 14.1913 3.73011 14.2732 3.64816L15.6167 2.30469H14.6875C14.3639 2.30469 14.1016 2.04234 14.1016 1.71875C14.1016 1.39516 14.3639 1.13281 14.6875 1.13281H17.0312C17.1471 1.13281 17.2604 1.16718 17.3568 1.23157C17.4531 1.29595 17.5282 1.38747 17.5726 1.49454C17.6169 1.6016 17.6285 1.71942 17.6059 1.83308C17.5833 1.94674 17.5275 2.05114 17.4455 2.13309L16.1021 3.47656H17.0312C17.3548 3.47656 17.6172 3.73891 17.6172 4.0625C17.6172 4.38609 17.3548 4.64844 17.0312 4.64844Z"
                                                    fill="#C3CAD9" />
                                                <path
                                                    d="M10 20C4.48598 20 0 15.5051 0 9.98006C0 7.42885 0.959688 5.00264 2.70234 3.14838C4.50281 1.23256 6.99383 0.11463 9.71656 0.000528459C9.83199 -0.0043788 9.94629 0.024979 10.0451 0.0849046C10.1438 0.14483 10.2227 0.232644 10.2716 0.337286C10.3851 0.579396 10.338 0.898263 10.0254 1.10072C9.34137 1.54397 7.10938 3.24076 7.10938 6.46443C7.10938 9.99686 9.9832 12.8707 13.5156 12.8707C16.6384 12.8707 18.3145 10.8399 18.8902 9.96686C19.1721 9.53908 19.5475 9.6544 19.6628 9.70842C19.7674 9.75744 19.8551 9.83629 19.915 9.93504C19.9749 10.0338 20.0043 10.1481 19.9995 10.2635C19.8855 12.9836 18.7653 15.4768 16.8454 17.2839C14.9845 19.0354 12.5534 20 10 20Z"
                                                    fill="#C3CAD9" />
                                            </svg>
                                            <span class="w-[calc(100%-32px)]">Free: {{ $data['freeCount'] }}</span>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                        <div id="tab2" class="tab-content">
                            @foreach ($departmentData as $dept)
                                @foreach ($dept['users'] as $data)
                                    @php
                                        $user = $data['user'];
                                        $status = $data['attendanceStatus'] ?? '';
                                    @endphp
                                    <div class="px-5 2xl:px-7 py-6 border-b-2 border-gray">
                                        <div class="flex items-center">
                                            <div
                                                class="border-2 border-gray rounded-full w-20 h-20 2xl:w-26 2xl:h-26 flex items-center justify-center">
                                                <img src="{{ $user->avatar ? asset('admin-uploads/avatar/' . $user->avatar) : asset('admin-assets/images/user-2.jpg') }}"
                                                    alt="user" class="2xl:w-24 2xl:h-24 h-16 w-16 rounded-full">
                                            </div>
                                            <div class="w-[calc(100%-98px)] 2xl:w-[calc(100%-130px)] px-2 2xl:px-8">
                                                <h4 class="font-bold">{{ $user->first_name }} {{ $user->last_name }}
                                                </h4>
                                                <p class="my-2 text-sx">{{ ucfirst($user->designation ?? '') }}</p>
                                            </div>
                                            <div class="w-4.5 self-start relative">
                                                <button class="dropdown-toggle cursor-pointer"><svg width="17"
                                                        height="5" viewBox="0 0 17 5" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.875 4.25C16.0486 4.25 17 3.2986 17 2.125C17 0.951395 16.0486 0 14.875 0C13.7014 0 12.75 0.951395 12.75 2.125C12.75 3.2986 13.7014 4.25 14.875 4.25Z"
                                                            fill="#C3CAD9" />
                                                        <path
                                                            d="M8.5 4.25C9.6736 4.25 10.625 3.2986 10.625 2.125C10.625 0.951395 9.6736 0 8.5 0C7.32639 0 6.375 0.951395 6.375 2.125C6.375 3.2986 7.32639 4.25 8.5 4.25Z"
                                                            fill="#C3CAD9" />
                                                        <path
                                                            d="M2.125 4.25C3.2986 4.25 4.25 3.2986 4.25 2.125C4.25 0.951395 3.2986 0 2.125 0C0.951395 0 0 0.951395 0 2.125C0 3.2986 0.951395 4.25 2.125 4.25Z"
                                                            fill="#C3CAD9" />
                                                    </svg>
                                                </button>
                                                <ul
                                                    class="dropdown-menu absolute right-0 top-full w-28 rounded-10px p-4.5 bg-white shadow-primary text-xs font-medium space-y-3 invisible opacity-0 duration-300">
                                                    <li><a href="{{ route('new-staff.show', $user->id) }}"
                                                            class="duration-300 cursor-pointer hover:text-purple">Staff
                                                            Details</a></li>
                                                    <li><a href="{{ route('new-staff.edit', $user->id) }}"
                                                            class="duration-300 cursor-pointer hover:text-purple">Edit</a>
                                                    </li>
                                                    <li><button data-id="{{ $user->id }}"
                                                            class="delete-button duration-300 cursor-pointer hover:text-purple">Delete</button>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <ul class="font-semibold mt-6 flex flex-wrap gap-y-5 -mx-1 2xl:text-sm text-xs">
                                            <li class="flex items-center w-1/2 px-1"><svg
                                                    class="mr-3.5 w-4.5 h-4.5 fill-lightgray"
                                                    xmlns="http://www.w3.org/2000/svg" id="Filled" viewBox="0 0 24 24"
                                                    width="512" height="512">
                                                    <path
                                                        d="M23.954,5.542,15.536,13.96a5.007,5.007,0,0,1-7.072,0L.046,5.542C.032,5.7,0,5.843,0,6V18a5.006,5.006,0,0,0,5,5H19a5.006,5.006,0,0,0,5-5V6C24,5.843,23.968,5.7,23.954,5.542Z" />
                                                    <path
                                                        d="M14.122,12.546l9.134-9.135A4.986,4.986,0,0,0,19,1H5A4.986,4.986,0,0,0,.744,3.411l9.134,9.135A3.007,3.007,0,0,0,14.122,12.546Z" />
                                                </svg>
                                                <span class="w-[calc(100%-32px)] truncate">{{ $user->email }}</span>
                                            </li>
                                            <li class="flex items-center w-1/2 px-1"><svg
                                                    class="mr-3.5 w-4.5 h-4.5 fill-lightgray"
                                                    xmlns="http://www.w3.org/2000/svg" id="Filled" viewBox="0 0 24 24"
                                                    width="512" height="512">
                                                    <path
                                                        d="M22.485,10.975,12,17.267,1.515,10.975A1,1,0,1,0,.486,12.69l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z" />
                                                    <path
                                                        d="M22.485,15.543,12,21.834,1.515,15.543A1,1,0,1,0,.486,17.258l11,6.6a1,1,0,0,0,1.03,0l11-6.6a1,1,0,1,0-1.029-1.715Z" />
                                                    <path
                                                        d="M.485,8.357l9.984,5.991a2.97,2.97,0,0,0,3.062,0l9.984-5.991a1,1,0,0,0,0-1.714L13.531.652a2.973,2.973,0,0,0-3.062,0L.485,6.643a1,1,0,0,0,0,1.714Z" />
                                                </svg>
                                                <span class="w-[calc(100%-32px)] truncate">Department:
                                                    {{ $user->department->name }}</span>
                                            </li>
                                            <li class="flex items-center w-1/2 px-1"><svg
                                                    class="mr-3.5 w-4.5 h-4.5 fill-lightgray"
                                                    xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="m5,6C5,2.691,7.691,0,11,0s6,2.691,6,6-2.691,6-6,6-6-2.691-6-6Zm16.685,10.267l-3.041-.507c-.373-.062-.644-.382-.644-.76,0-.551.448-1,1-1h2c.552,0,1,.449,1,1h2c0-1.654-1.346-3-3-3v-2h-2v2c-1.654,0-3,1.346-3,3,0,1.36.974,2.51,2.315,2.733l3.041.507c.373.062.644.382.644.76,0,.551-.448,1-1,1h-2c-.552,0-1-.449-1-1h-2c0,1.654,1.346,3,3,3v2h2v-2c1.654,0,3-1.346,3-3,0-1.36-.974-2.51-2.315-2.733Zm-7.685,2.733v-4c0-.286.038-.561.084-.834l-.084-.166h-7.5c-2.481,0-4.5,2.019-4.5,4.5v5.5h15v-.424c-1.763-.774-3-2.531-3-4.576Z" />
                                                </svg>
                                                <span class="w-[calc(100%-32px)] truncate">Salary:
                                                    ₹{{ number_format($user->monthly_salary) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                        <div id="tab3" class="tab-content">
                            @foreach ($salaryData as $data)
                                <div class="px-5 2xl:px-7 py-6 border-b-2 border-gray">
                                    <div class="flex items-center">
                                        <div
                                            class="border-2 border-gray rounded-full w-20 h-20 2xl:w-26 2xl:h-26 flex items-center justify-center">
                                            <img src="{{ !empty($data['avatar']) ? asset('admin-uploads/avatar/' . $data['avatar']) : asset('admin-assets/images/user-2.jpg') }}"
                                                alt="user" class="2xl:w-24 2xl:h-24 h-16 w-16 rounded-full">

                                        </div>
                                        <div class="w-[calc(100%-98px)] 2xl:w-[calc(100%-130px)] px-2 2xl:px-8">
                                            <h4 class="font-bold">{{ $data['full_name'] }}</h4>
                                            <p class="my-2 text-sx">{{ $data['department'] }}</p>
                                        </div>

                                    </div>
                                    <ul class="font-semibold mt-6 flex flex-wrap gap-y-4 -mx-1 2xl:text-sm text-xs">
                                        <li class="flex items-center w-1/2 px-1 truncate"><span
                                                class="mr-2 text-lightgray">Working Days:</span>
                                            {{ $data['working_days'] }}
                                        </li>
                                        <li class="flex items-center w-1/2 px-1 truncate"><span
                                                class="mr-2 text-lightgray">Sundays:</span> {{ $data['sundays'] }}
                                        </li>
                                        <li class="flex items-center w-1/2 px-1 truncate"><span
                                                class="mr-2 text-lightgray">Present:</span>
                                            {{ $data['present_days'] }}
                                        </li>
                                        <li class="flex items-center w-1/2 px-1 truncate"><span
                                                class="mr-2 text-lightgray">Paid Leaves:</span>
                                            {{ $data['paid_leaves'] }}
                                        </li>
                                        <li class="flex items-center w-1/2 px-1 truncate"><span
                                                class="mr-2 text-lightgray">Unpaid Leaves:</span>
                                            {{ $data['unpaid_leaves'] }}
                                        </li>
                                        <li class="flex items-center w-1/2 px-1 truncate"><span
                                                class="mr-2 text-lightgray">Salary Per Day:</span>
                                            ₹{{ number_format($data['salary_per_day'], 2) }}</li>
                                        <li class="flex items-center w-full px-1 truncate"><span
                                                class="mr-2 text-lightgray">Total Monthly Salary:</span>
                                            ₹{{ number_format($data['total_salary'], 2) }}</li>
                                        <li class="flex items-center w-full px-1 truncate text-green"><span
                                                class="mr-2 text-lightgray">Payable Salary:</span>
                                            ₹{{ number_format($data['payable_salary'], 2) }}</li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Department Modal -->
        <div id="editModal"
            class="edit-popup-main fixed z-40 lg:max-w-[calc(100%-386px)] xl:max-w-[calc(100%-406px)] w-full ml-auto inset-y-0 right-0 left-5 lg:left-10 xl:left-14 invisible opacity-0 duration-300">

            <div
                class="z-10 w-full max-w-[320px] sm:max-w-[400px] bg-white absolute top-1/2 left-1/2 -translate-1/2 rounded-10px overflow-hidden">

                <h2 class="text-white bg-purple text-sm sm:text-base font-bold py-3.5 text-center">Edit Department</h2>

                <div class="bg-white p-3.5">
                    <form method="POST" action="" class="text-xs space-y-3.5" id="editForm"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editId">

                        <fieldset class="flex border-[1.5px] border-gray rounded-md overflow-hidden">
                            <label for="editDepartmentName" class="bg-purple inline-flex p-2.5">
                                <!-- You can reuse the same SVG icon -->
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10.4274 3.73509C10.31 3.85264 10.2441 4.01197 10.2441 4.1781C10.2441 4.34422 10.31 4.50356 10.4274 4.6211L11.8646 6.05877H5.02121C4.85501 6.05877 4.69561 6.12482 4.57808 6.24238C4.46056 6.35994 4.39453 6.5194 4.39453 6.68566C4.39453 6.85192 4.46056 7.01137 4.57808 7.12894C4.69561 7.2465 4.85501 7.31255 5.02121 7.31255H11.8646L10.4274 8.75022C10.3658 8.80761 10.3164 8.87682 10.2822 8.95372C10.2479 9.03061 10.2295 9.11363 10.228 9.1978C10.2265 9.28197 10.242 9.36558 10.2735 9.44364C10.3051 9.5217 10.352 9.59261 10.4115 9.65213C10.471 9.71166 10.5419 9.75859 10.6199 9.79012C10.6979 9.82165 10.7815 9.83714 10.8657 9.83565C10.9498 9.83416 11.0328 9.81574 11.1097 9.78148C11.1865 9.74721 11.2557 9.69781 11.3131 9.63622L13.8198 7.12866C13.9372 7.01112 14.0031 6.85178 14.0031 6.68566C14.0031 6.51953 13.9372 6.3602 13.8198 6.24266L11.3131 3.73509C11.1956 3.6177 11.0363 3.55176 10.8702 3.55176C10.7042 3.55176 10.5449 3.6177 10.4274 3.73509Z"
                                        fill="white" />
                                    <path
                                        d="M0 6.68683C0 8.46029 0.704268 10.1611 1.95787 11.4151C3.21148 12.6692 4.91173 13.3737 6.6846 13.3737V10.2392C6.6846 9.451 6.6846 9.05731 6.43978 8.81241C6.19495 8.5675 5.8014 8.5675 5.01345 8.5675C4.51483 8.5675 4.03663 8.36936 3.68406 8.01667C3.33148 7.66397 3.13341 7.18562 3.13341 6.68683C3.13341 6.18805 3.33148 5.70969 3.68406 5.357C4.03663 5.0043 4.51483 4.80616 5.01345 4.80616C5.8014 4.80616 6.19495 4.80616 6.43978 4.56125C6.6846 4.31635 6.6846 3.92266 6.6846 3.13445V0C4.91173 0 3.21148 0.704503 1.95787 1.95853C0.704268 3.21255 0 4.91337 0 6.68683Z"
                                        fill="white" />
                                </svg>
                            </label>
                            <input id="editDepartmentName" name="name" placeholder="Department Name" type="text"
                                class="w-full outline-none px-2.5">
                        </fieldset>

                        <fieldset>
                            <textarea class="border-[1.5px] border-gray rounded-md w-full resize-none h-28 outline-none p-2.5" name="description"
                                id="editDescription" placeholder="Description here"></textarea>
                        </fieldset>

                        <fieldset>
                            <label class="block text-gray-700 font-medium mb-1" for="logo">Department Logo</label>
                            <input type="file" name="logo" id="logo"
                                class="w-full border-[1.5px] border-gray rounded-md p-2.5 text-sm file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-sm file:bg-purple file:text-white hover:file:bg-purple-dark" />
                        </fieldset>

                        <fieldset class="flex gap-1.5 justify-center mt-5.5">
                            <button type="submit"
                                class="cursor-pointer bg-purple text-white font-semibold py-1.5 px-4 rounded-sm">Update</button>
                            <button type="button" onclick="closeEditModal()"
                                class="edit-popup-close cursor-pointer bg-purple text-white font-semibold py-1.5 px-4 rounded-sm">Close</button>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="bg-black/10 absolute inset-0 edit-popup-closebg"></div>
        </div>
    @else
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
                                    <h3 class="font-bold text-4xl md:text-5xl text-purple">
                                        {{ $attendanceSummary['workingDays'] }}</h3>
                                </div>
                                <div
                                    class="flex flex-col font-medium gap-5 bg-lightgraybg p-3.5 rounded-10px shadow-primary text-xs md:text-sm w-[calc(33%-12px)]">
                                    <span>Present Days</span>
                                    <h3 class="font-bold text-4xl md:text-5xl text-green">
                                        {{ $attendanceSummary['presentDays'] }}</h3>
                                </div>
                                <div
                                    class="flex flex-col font-medium gap-5 bg-lightgraybg p-3.5 rounded-10px shadow-primary text-xs md:text-sm w-[calc(33%-12px)]">
                                    <span>Absent Days</span>
                                    <h3 class="font-bold text-4xl md:text-5xl text-danger">
                                        {{ $attendanceSummary['absentDays'] }}</h3>
                                </div>
                            </div>
                        </div>
                        @php
                            $user = auth()->user();
                            $today = Carbon\Carbon::now()->toDateString();

                            $attendance = \App\Models\Attendance::where('user_id', $user->id)
                                ->where('date', $today)
                                ->first();

                            $checkInTime = $attendance?->time_in ? Carbon\Carbon::parse($attendance->time_in) : null;
                            $checkOutTime = $attendance?->time_out ? Carbon\Carbon::parse($attendance->time_out) : null;

                            $isCheckedIn = $checkInTime && !$checkOutTime;
                            $status = $attendance?->check_in_type ?? 'Offline';
                        @endphp
                        <div class="w-full xl:w-1/2 2xl:w-1/3 px-3 my-3 2xl:my-0">
                            <div class="bg-lightgraybg p-9 text-center shadow-primary font-medium rounded-10px">
                                <h3 id="today" class="text-4xl font-bold mb-4"></h3>
                                <p class="font-semibold">Today's Attendance</p>
                                <p class="text-xs">Mark your check-in and check-out for the day.</p>
                                <p class="mt-2">
                                    <span class="font-semibold">Check In :</span>
                                    <span
                                        id="clockInTime">{{ $checkInTime ? $checkInTime->format('h:i:s A') : '--:--' }}</span>
                                    (<span id="clockStatus">{{ ucfirst($status) }}</span>)
                                </p>


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
                                    {{-- Timer Play/Pause --}}
                                    <button id="timerPlayPause"
                                        class="bg-green text-white py-2.5 px-2 font-semibold rounded-md cursor-pointer w-32"
                                        {{ !$isCheckedIn ? 'disabled' : '' }}>
                                        {{ session('timer_paused') === true ? 'Play' : 'Pause' }}
                                    </button>

                                    {{-- Check In Button --}}
                                    <button id="checkInBtn"
                                        class="bg-purple text-white py-2.5 px-2 font-semibold rounded-md cursor-pointer w-32"
                                        style="{{ $isCheckedIn && !$checkOutTime ? 'display: none;' : '' }}">
                                        Check In
                                    </button>

                                    {{-- Check Out Button --}}
                                    <button id="checkOutBtn"
                                        class="bg-purple text-white py-2.5 px-2 font-semibold rounded-md cursor-pointer w-32"
                                        style="{{ !$isCheckedIn || $checkOutTime ? 'display: none;' : '' }}">
                                        Check Out
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="w-full xl:w-1/2 2xl:w-1/3 px-3 my-3 2xl:my-0">
                            <div class="calendar bg-lightgraybg p-6 w-full shadow-primary font-medium rounded-10px">
                                <div class="cal-head text-center relative mb-4 flex justify-between">
                                    <h3 class="title font-semibold text-xl">Month 0000</h3>
                                    <div class="flex items-center gap-2">
                                        <button
                                            class="w-7.5 h-7.5 flex items-center justify-center rounded-full cursor-pointer"
                                            id="prev"><svg width="6" height="10" viewBox="0 0 6 10"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.26756 9.80322C4.31713 9.855 4.37642 9.89631 4.44198 9.92473C4.50754 9.95315 4.57805 9.9681 4.6494 9.96873C4.72074 9.96936 4.7915 9.95564 4.85754 9.92837C4.92358 9.90111 4.98357 9.86085 5.03402 9.80994C5.08448 9.75903 5.12437 9.69849 5.15139 9.63185C5.17841 9.56522 5.19201 9.49382 5.19139 9.42182C5.19077 9.34983 5.17594 9.27868 5.14778 9.21252C5.11962 9.14637 5.07868 9.08654 5.02736 9.03652L1.86833 5.84882C1.7676 5.74714 1.71101 5.60925 1.71101 5.46547C1.71101 5.3217 1.7676 5.18381 1.86833 5.08213L5.0279 1.89443C5.12866 1.79268 5.18523 1.65472 5.18518 1.51089C5.18513 1.36705 5.12846 1.22913 5.02763 1.12746C4.92681 1.02579 4.79008 0.968699 4.64754 0.96875C4.505 0.968801 4.36832 1.02599 4.26756 1.12773L0.348733 5.08213C0.247997 5.18381 0.191407 5.3217 0.191407 5.46547C0.191407 5.60925 0.247997 5.74714 0.348733 5.84882L4.26756 9.80322Z"
                                                    fill="#6B7A99" />
                                            </svg>
                                        </button>
                                        <button
                                            class="w-7.5 h-7.5 flex items-center justify-center rounded-full cursor-pointer bg-purple"
                                            id="next"><svg width="6" height="10" viewBox="0 0 6 10"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
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
                        <table class="table-userdata display nowrap custom-table custom-table-order" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Date</th>
                                    <th style="text-align: center">Full Name</th>
                                    <th style="text-align: center">Time In</th>
                                    <th style="text-align: center">Time Out</th>
                                    <th style="text-align: center">Total Hours</th>
                                    <th style="text-align: center">Status</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
@section('custom-js')
    {{-- new-staff delete   --}}
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
    {{-- edit model --}}
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
    </script>

    <script>
        const editButtons = document.querySelectorAll('.edit-button');
        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');

        const editId = document.getElementById('editId');
        const editDepartmentName = document.getElementById('editDepartmentName');
        const editDescription = document.getElementById('editDescription');

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.dataset.id;
                const name = button.dataset.name;
                const description = button.dataset.description;

                editId.value = id;
                editDepartmentName.value = name;
                editDescription.value = description;

                editForm.action = `/chameleon/department/${id}`; // make sure your route matches this

                // Show popup (remove "invisible" and set opacity to 100%)
                editModal.classList.remove('invisible');
                editModal.classList.add('opacity-100');
            });
        });

        function closeEditModal() {
            // Hide popup (add "invisible" and remove opacity)
            editModal.classList.add('invisible');
            editModal.classList.remove('opacity-100');
        }

        // Optional: Close modal if background overlay is clicked
        document.querySelectorAll('.edit-popup-close, .edit-popup-closebg').forEach(el => {
            el.addEventListener('click', closeEditModal);
        });
    </script>
    {{-- department delete  --}}
    <script>
        $(document).ready(function() {
            // Listen for clicks on delete buttons
            $('.delete-button').click(function() {
                var departmentId = $(this).data('id'); // Get department ID from data-id attribute
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
                            url: '/chameleon/department/' +
                                departmentId, // URL to delete department
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}', // Include CSRF token
                            },
                            success: function(response) {
                                // Success: Show success message and reload
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'The department has been deleted.',
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

    {{-- play and pause duration --}}
    <script>
        let isPaused = true;
        let duration = 0;
        let timerInterval;
        let timerEnabled = false;

        function startLiveClock() {
            const clockElement = document.getElementById('todayclock');
            if (!clockElement) return;
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
            if (!timerEnabled) return;

            if (isPaused) {
                timerInterval = setInterval(() => {
                    duration++;
                    updateTimerDisplay();
                }, 1000);
                document.getElementById("timerPlayPause").innerText = "Pause";
                localStorage.setItem("attendanceTimerPaused", "false");
            } else {
                clearInterval(timerInterval);
                document.getElementById("timerPlayPause").innerText = "Play";
                localStorage.setItem("attendanceTimerPaused", "true");
            }

            localStorage.setItem("attendanceTimerLastUpdated", Math.floor(Date.now() / 1000));
            localStorage.setItem("attendanceTimerDuration", duration);
            isPaused = !isPaused;
        }


        // --- EVENTS ---
        document.getElementById("timerPlayPause").addEventListener("click", () => {
            fetch(isPaused ? "{{ route('attendance.startSession') }}" :
                "{{ route('attendance.pauseSession') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    }
                });
            toggleTimer();
        });

        document.getElementById("checkInBtn").addEventListener("click", () => {
            fetch("{{ route('attendance.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    }
                })
                .then(res => res.json())
                .then(data => {
                    Swal.fire("Success", data.message, "success").then(() => {
                        location.reload();
                    });
                });
        });

        document.getElementById("checkOutBtn").addEventListener("click", () => {
            const timerText = document.getElementById("trakingTimer").innerText;
            const [h, m, s] = timerText.split(":").map(Number);
            const totalSeconds = h * 3600 + m * 60 + s;

            fetch("{{ route('attendance.clockOut') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        duration: totalSeconds
                    })
                })
                .then(res => res.json())
                .then(data => {
                    Swal.fire("Success", data.message, "success").then(() => {
                        location.reload();
                    });
                });
        });

        // Status Switch (Working/Free)
        document.getElementById("statusSwitch").addEventListener("change", function() {
            const status = this.checked ? "working" : "free";

            document.getElementById("status").innerText = status.charAt(0).toUpperCase() + status.slice(1);
            document.getElementById("clockStatus").innerText = status.charAt(0).toUpperCase() + status.slice(1);

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
                .then(() => {
                    if ($.fn.DataTable.isDataTable('.table-userdata')) {
                        $('.table-userdata').DataTable().ajax.reload(null, false);
                    }
                });
        });

        // INIT
        window.addEventListener("DOMContentLoaded", () => {
            startLiveClock();

            const isCheckedIn = @json($isCheckedIn);
            const checkInTimestamp = @json($checkInTime ? $checkInTime->timestamp : null);
            const checkOutTime = @json($checkOutTime ? $checkOutTime->format('h:i:s A') : null);
            const now = Math.floor(Date.now() / 1000);

            const savedDuration = parseInt(localStorage.getItem("attendanceTimerDuration") || "0");
            const lastUpdated = parseInt(localStorage.getItem("attendanceTimerLastUpdated") || now);
            const paused = localStorage.getItem("attendanceTimerPaused") === "true";

            if (isCheckedIn && checkInTimestamp) {
                if (paused) {
                    duration = savedDuration;
                } else {
                    duration = savedDuration + (now - lastUpdated);
                }

                updateTimerDisplay();
                timerEnabled = true;
                isPaused = true;

                if (!paused) {
                    toggleTimer(); // Start ticking
                }

                document.getElementById("clockInOut").innerText = "Clock Out";
                document.getElementById("statusSwitch").disabled = false;
                document.getElementById("timerPlayPause").disabled = false;

            } else if (checkOutTime) {
                document.getElementById("clockInOut").innerText = "Clocked Out";
                document.getElementById("clockInOut").disabled = true;
                document.getElementById("timerPlayPause").disabled = true;
                document.getElementById("statusSwitch").disabled = true;
                timerEnabled = false;
                localStorage.clear();
            } else {
                document.getElementById("timerPlayPause").disabled = true;
                timerEnabled = false;
                localStorage.clear();
            }
        });
    </script>

    {{-- yajra table data  --}}
    <script>
        $(document).ready(function() {
            $('.table-userdata').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('dashboard') }}',
                columns: [ // ← Correct key
                    {
                        data: 'date',
                        name: 'date',
                        className: 'text-center'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name',
                        className: 'text-center'
                    },
                    {
                        data: 'time_in',
                        name: 'time_in',
                        className: 'text-center'
                    },
                    {
                        data: 'time_out',
                        name: 'time_out',
                        className: 'text-center'
                    },
                    {
                        data: 'total_hr',
                        name: 'total_hr',
                        className: 'text-center'
                    },
                    {
                        data: 'check_in_type',
                        name: 'check_in_type',
                        className: 'text-center'
                    }
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

            document.getElementById('today').textContent = time;
        }

        setInterval(updateClock, 1000);
        updateClock(); // Initial call
    </script>

    <script>
        const dates = document.querySelector(".dates");
        const header = document.querySelector(".title");
        const nav = document.querySelectorAll("#prev, #next");

        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December",
        ];

        let date = new Date();
        let month = date.getMonth();
        let year = date.getFullYear();

        // 📅 Define holidays in "YYYY-MM-DD" format
        const holidays = {!! json_encode(
            $holidays->keys()->map(function ($day) use ($currentDate) {
                return $currentDate->copy()->day($day)->format('Y-m-d');
            }),
        ) !!};


        function renderCalendar() {
            const start = (new Date(year, month, 1).getDay() + 6) % 7;
            const endDate = new Date(year, month + 1, 0).getDate();
            const endDatePrev = new Date(year, month, 0).getDate();

            let datesHtml = "";

            // Previous month dates
            for (let i = start; i > 0; i--) {
                datesHtml += `<li class="old"><span>${endDatePrev - i + 1}</span></li>`;
            }

            // Current month dates
            for (let i = 1; i <= endDate; i++) {
                const isToday = i === new Date().getDate() && month === new Date().getMonth() &&
                    year === new Date().getFullYear();
                const dayOfWeek = new Date(year, month, i).getDay();
                const isSunday = dayOfWeek === 0;
                const formattedDate = `${year}-${String(month + 1).padStart(2, '0' )}-${String(i).padStart(2, '0' )}`;
                const
                    isHoliday = holidays.includes(formattedDate);
                let classList = [];
                if (isToday) classList.push("today");
                if (isSunday)
                    classList.push("cal-sunday");
                if (isHoliday) classList.push("holiday");
                const classAttr = classList.length ? `
        class="${classList.join(" ")}" ` : "";
                datesHtml += `<li${classAttr}><span>${i}</span></li>`;
            }

            // Next month filler dates
            const totalCells = start + endDate;
            const nextDays = (7 - (totalCells % 7)) % 7;
            for (let i = 1; i <= nextDays; i++) {
                datesHtml += `<li class="old"><span>${i}</span></li>`;
            }

            dates.innerHTML = datesHtml;
            header.textContent = `${months[month]} ${year}`;
        }

        nav.forEach(navBtn => {
            navBtn.addEventListener("click", e => {
                const btnId = e.target.id;
                if (btnId === 'prev' && month === 0) {
                    year--;
                    month = 11;
                } else if (btnId === 'next' && month === 11) {
                    year++;
                    month = 0;
                } else {
                    month = (btnId === 'next') ? month + 1 : month - 1;
                }

                date = new Date(year, month, new Date().getDate());
                year = date.getFullYear();
                month = date.getMonth();

                renderCalendar();
            });
        });

        renderCalendar();
    </script>
@endsection
