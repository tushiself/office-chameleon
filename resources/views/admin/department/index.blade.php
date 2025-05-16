@extends('layouts.admin')
@section('content')
    <!-- data -->
    <div class="flex flex-wrap mt-10 lg:mt-11">
        <h2 class="font-bold text-base">Department List</h2>
        <div class="flex flex-wrap -mx-3 pt-4 w-full">
            @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Manager'))
                <div class="w-full md:w-1/2 2xl:w-1/3 p-3">
                    <div class="px-5 2xl:px-7 py-6 bg- border-lightgray bg-borderimage rounded-10px h-full">
                        <button
                            class="popup-button flex flex-col justify-center items-center cursor-pointer w-full h-full hover:text-purple duration-300">
                            <span
                                class="bg-white w-8 h-8 md:w-12.5 md:h-12.5 flex items-center justify-center border-2 rounded-full"><svg
                                    class="w-4 h-4 md:w-5.5 md:h-5.5" width="22" height="23" viewBox="0 0 22 23"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.9335 10.5488H12.3703V1.98538C12.3703 1.39467 11.8907 0.915039 11.2998 0.915039C10.709 0.915039 10.2294 1.39467 10.2294 1.98538V10.5488H1.66605C1.07533 10.5488 0.595703 11.0284 0.595703 11.6191C0.595703 12.21 1.07533 12.6896 1.66605 12.6896H10.2294V21.2528C10.2294 21.8437 10.709 22.3234 11.2998 22.3234C11.8907 22.3234 12.3703 21.8437 12.3703 21.2528V12.6896H20.9335C21.5244 12.6896 22.004 12.21 22.004 11.6191C22.004 11.0284 21.5244 10.5488 20.9335 10.5488Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <span class="font-semibold text-sm md:text-base lg:text-lg mt-3">New Department</span>
                        </button>
                    </div>
                </div>
            @else
            @endif
            @foreach ($departmentData as $data)
                <div class="w-full md:w-1/2 2xl:w-1/3 p-3">
                    <div class="px-5 2xl:px-6 py-5 bg-white shadow-primary rounded-10px h-full">
                        <div class="flex items-center">
                            <div
                                class="border-2 border-gray rounded-full w-20 h-20 2xl:w-25 2xl:h-25 flex items-center justify-center">
                                <img src="{{ $data['department']->logo ? asset('admin-uploads/department-logos/' . $data['department']->logo) : asset('admin-assets/images/icons/shopify.png') }}"
                                    alt="shopify" class="w-9 h-9">
                            </div>
                            <div class="w-[calc(100%-98px)] 2xl:w-[calc(100%-130px)] px-2 2xl:px-8">
                                <h4 class="font-bold">{{ $data['department']->name }}</h4>
                                <div class="flex items-center font-bold text-xs my-3 md:my-4">
                                    <div class="relative w-full h-0.5 bg-gray">
                                        @php
                                            $totalUsers = 50; // total department users
                                            $presentUsers = count($data['users']); // users who have attendance today
                                            $percentage =
                                                $totalUsers > 0 ? round(($presentUsers / $totalUsers) * 100) : 0;

                                            // Optional: cap at 99% visually
                                            $barWidth = $percentage === 100 ? 99 : $percentage;
                                        @endphp
                                        <div class="absolute inset-0 bg-green h-full" style="width: {{ $barWidth }}%">
                                        </div>
                                    </div>
                                    <span class="ml-2">{{ $percentage }}%</span>
                                </div>

                                <div class="flex gap-1.5">
                                    @foreach ($data['users'] as $userData)
                                        <img src="{{ $userData['user']->avatar ? asset('admin-uploads/avatar/' . $userData['user']->avatar) : asset('admin-assets/images/user.jpg') }}"
                                            class="md:w-6 md:h-6 w-5 h-5 rounded-full object-cover cursor-pointer"
                                            alt="{{ $userData['user']->first_name }} {{ $userData['user']->last_name }}"
                                            title="{{ $userData['user']->first_name }} {{ $userData['user']->last_name }}">
                                    @endforeach

                                </div>

                            </div>
                            @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Manager'))
                                <div class="w-4.5 self-start relative">
                                    <button class="dropdown-toggle cursor-pointer"><svg width="17" height="5"
                                            viewBox="0 0 17 5" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                                Staff</a>
                                        </li>
                                        <li>
                                            <button class="duration-300 cursor-pointer hover:text-purple edit-button"
                                                data-id="{{ $data['department']->id }}"
                                                data-name="{{ $data['department']->name }}"
                                                data-description="{{ $data['department']->description }}">
                                                Edit
                                            </button>
                                        </li>

                                        <li>
                                            <button class="delete-button duration-300 cursor-pointer hover:text-purple"
                                                data-id="{{ $data['department']->id }}">
                                                Delete
                                            </button>
                                        </li>

                                        </li>
                                    </ul>
                                </div>
                            @else
                            @endif
                        </div>
                        <ul class="font-semibold mt-6 flex flex-wrap gap-y-5 -mx-1 2xl:text-sm text-xs">
                            <li class="flex items-center w-1/2 px-1"><svg class="mr-3.5" width="18" height="16"
                                    viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.8622 2.59993C11.6945 3.12175 12.2781 4.00479 12.3844 5.0298C12.7333 5.19398 13.1142 5.27926 13.4999 5.2796C14.958 5.2796 16.1398 4.09779 16.1398 2.63991C16.1398 1.1818 14.958 0 13.4999 0C12.0557 0.00044927 10.8842 1.16114 10.8622 2.59993ZM9.13276 8.00509C10.5909 8.00509 11.7727 6.82306 11.7727 5.36518C11.7727 3.9073 10.5906 2.7255 9.13276 2.7255C7.67488 2.7255 6.4924 3.90753 6.4924 5.36541C6.4924 6.82329 7.67488 8.00509 9.13276 8.00509ZM10.2526 8.18502H8.0125C6.14871 8.18502 4.63242 9.70154 4.63242 11.5653V14.3048L4.63939 14.3477L4.82808 14.4067C6.60674 14.9625 8.152 15.1478 9.42389 15.1478C11.9081 15.1478 13.348 14.4395 13.4368 14.3944L13.6131 14.3052H13.632V11.5653C13.6326 9.70154 12.1164 8.18502 10.2526 8.18502ZM14.6201 5.45975H12.3974C12.3748 6.31803 12.0139 7.13258 11.3933 7.72587C13.0499 8.2185 14.2621 9.75477 14.2621 11.5694V12.4136C16.4568 12.3331 17.7215 11.7111 17.8048 11.6693L17.9811 11.5799H18V8.83961C18 6.97604 16.4837 5.45975 14.6201 5.45975ZM4.50056 5.28005C5.017 5.28005 5.49749 5.12931 5.90453 4.87256C6.03225 4.04645 6.47176 3.30073 7.13261 2.78884C7.13531 2.73942 7.14002 2.69045 7.14002 2.64058C7.14002 1.18248 5.95799 0.000673856 4.50056 0.000673856C3.04223 0.000673856 1.86065 1.18248 1.86065 2.64058C1.86065 4.09802 3.04223 5.28005 4.50056 5.28005ZM6.87136 7.72587C6.2542 7.13542 5.89381 6.32606 5.86791 5.47233C5.78547 5.46627 5.70393 5.45975 5.61992 5.45975H3.38008C1.51629 5.45975 0 6.97604 0 8.83961V11.5795L0.00696368 11.6217L0.195657 11.6812C1.62254 12.1267 2.89599 12.332 4.0021 12.3967V11.5694C4.00255 9.75477 5.21423 8.21894 6.87136 7.72587Z"
                                        fill="#C3CAD9" />
                                </svg>
                                <span class="w-[calc(100%-32px)]">Staff: {{ $data['department']->users_count }} </span>
                            </li>
                            <li class="flex items-center w-1/2 px-1"><svg class="mr-3.5" width="18" height="17"
                                    viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                            <li class="flex items-center w-1/2 px-1">
                                <svg class="mr-3.5" width="20" height="19" viewBox="0 0 20 19" fill="none"
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
                                <span class="w-[calc(100%-32px)]">In work: {{ $data['workingCount'] }}</span>
                            </li>
                            <li class="flex items-center w-1/2 px-1">
                                <svg class="mr-3.5" width="20" height="20" viewBox="0 0 20 20" fill="none"
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
                </div>
            @endforeach
        </div>
    </div>

    <!-- Add Department Modal -->

    <div
        class="popup-main fixed z-40 lg:max-w-[calc(100%-386px)] xl:max-w-[calc(100%-406px)] w-full ml-auto inset-y-0 right-0 left-5 lg:left-10 xl:left-14 invisible opacity-0 duration-300">
        <div
            class="z-10 w-full max-w-[320px] sm:max-w-[400px] bg-white absolute top-1/2 left-1/2 -translate-1/2 rounded-10px overflow-hidden">
            <h2 class="text-white bg-purple text-sm sm:text-base font-bold py-3.5 text-center">Add Department</h2>
            <div class="bg-white p-3.5">
                <form action="{{ route('department.store') }}" method="POST" class="text-xs space-y-3.5"
                    enctype="multipart/form-data">
                    @csrf

                    <fieldset class="flex border-[1.5px] border-gray rounded-md overflow-hidden">
                        <label for="denartmentName" class="bg-purple inline-flex p-2.5"><svg width="14"
                                height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.4274 3.73509C10.31 3.85264 10.2441 4.01197 10.2441 4.1781C10.2441 4.34422 10.31 4.50356 10.4274 4.6211L11.8646 6.05877H5.02121C4.85501 6.05877 4.69561 6.12482 4.57808 6.24238C4.46056 6.35994 4.39453 6.5194 4.39453 6.68566C4.39453 6.85192 4.46056 7.01137 4.57808 7.12894C4.69561 7.2465 4.85501 7.31255 5.02121 7.31255H11.8646L10.4274 8.75022C10.3658 8.80761 10.3164 8.87682 10.2822 8.95372C10.2479 9.03061 10.2295 9.11363 10.228 9.1978C10.2265 9.28197 10.242 9.36558 10.2735 9.44364C10.3051 9.5217 10.352 9.59261 10.4115 9.65213C10.471 9.71166 10.5419 9.75859 10.6199 9.79012C10.6979 9.82165 10.7815 9.83714 10.8657 9.83565C10.9498 9.83416 11.0328 9.81574 11.1097 9.78148C11.1865 9.74721 11.2557 9.69781 11.3131 9.63622L13.8198 7.12866C13.9372 7.01112 14.0031 6.85178 14.0031 6.68566C14.0031 6.51953 13.9372 6.3602 13.8198 6.24266L11.3131 3.73509C11.1956 3.6177 11.0363 3.55176 10.8702 3.55176C10.7042 3.55176 10.5449 3.6177 10.4274 3.73509Z"
                                    fill="white" />
                                <path
                                    d="M0 6.68683C0 8.46029 0.704268 10.1611 1.95787 11.4151C3.21148 12.6692 4.91173 13.3737 6.6846 13.3737V10.2392C6.6846 9.451 6.6846 9.05731 6.43978 8.81241C6.19495 8.5675 5.8014 8.5675 5.01345 8.5675C4.51483 8.5675 4.03663 8.36936 3.68406 8.01667C3.33148 7.66397 3.13341 7.18562 3.13341 6.68683C3.13341 6.18805 3.33148 5.70969 3.68406 5.357C4.03663 5.0043 4.51483 4.80616 5.01345 4.80616C5.8014 4.80616 6.19495 4.80616 6.43978 4.56125C6.6846 4.31635 6.6846 3.92266 6.6846 3.13445V0C4.91173 0 3.21148 0.704503 1.95787 1.95853C0.704268 3.21255 0 4.91337 0 6.68683Z"
                                    fill="white" />
                            </svg>
                        </label>
                        <input id="departmentName" name="name" placeholder="Department Name" type="text"
                            class="w-full outline-none px-2.5">
                    </fieldset>
                    <fieldset>
                        <textarea class="border-[1.5px] border-gray rounded-md w-full resize-none h-28 outline-none p-2.5" name="description"
                            placeholder="Description here"></textarea>
                    </fieldset>
                    <!-- Logo Upload -->
                    <fieldset>
                        <label class="block text-gray-700 font-medium mb-1" for="logo">Department Logo</label>
                        <input type="file" name="logo" id="logo"
                            class="w-full border-[1.5px] border-gray rounded-md p-2.5 text-sm file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-sm file:bg-purple file:text-white hover:file:bg-purple-dark" />
                    </fieldset>
                    <fieldset class="flex gap-1.5 justify-center mt-5.5">
                        <button type="submit"
                            class="cursor-pointer bg-purple text-white font-semibold py-1.5 px-4 rounded-sm">Save</button>
                        <button
                            class="popup-close cursor-pointer bg-purple text-white font-semibold py-1.5 px-4 rounded-sm">Close</button>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="bg-black/10 absolute inset-0 popup-closebg"></div>
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
@endsection
@section('custom-js')
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
@endsection
