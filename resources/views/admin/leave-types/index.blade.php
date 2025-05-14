@extends('layouts.admin')
@section('content')
    <div class="mt-10 lg:mt-11">
        <div class="bg-white shadow-primary mt-5.5 rounded-10px">
            <div class="bg-lightgraybg p-5 rounded-t-10px border-b-2 border-gray text-right">
                <div class="flex items-center justify-between">
                    <h2 class="font-bold sm:text-base">All Leave-Types List</h2>
                    <button
                        class="popup-button bg-purple text-white py-2.5 px-3 sm:px-5 rounded-md inline-flex gap-2 items-center sm:gap-4 font-semibold cursor-pointer text-xs sm:text-sm">
                        <span class="bg-[#ECE4FB] w-5.5 h-5.5 rounded-full flex items-center justify-center">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 1L6 11" stroke="#8833FF" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M1 6L11 6" stroke="#8833FF" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </span>
                        New Leave Type
                    </button>
                </div>
            </div>
            <div class="p-5 lg:p-9 custom-table-main">
                <table class="table-leavetype display nowrap custom-table custom-table-order" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Leave Type</th>
                            <th>Description</th>
                            <th>Assign Days</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leavetype as $key => $leave)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $leave->leave_type }}</td>
                                <td>{{ $leave->description }}</td>
                                <td>{{ $leave->assign_days }}</td>
                                <td class="text-darkgreen">Active</td>
                                <td>{{ \Carbon\Carbon::parse($leave->created_at)->format('jS F, Y - H:i') }}
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <button
                                            class="edit-popup-button cursor-pointer text-lightgray duration-300 hover:text-purple"
                                            data-id="{{ $leave->id }}" data-leave_type="{{ $leave->leave_type }}"
                                            data-description="{{ $leave->description }}"
                                            data-assign_days="{{ $leave->assign_days }}"
                                            data-apply_base="{{ $leave->apply_base }}"
                                            data-paid_type="{{ $leave->paid_type }}"
                                            data-early_leave="{{ $leave->early_leave }}"
                                            data-status="{{ $leave->status }}">
                                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25614 1.25227L8.92 0.588418C9.70456 -0.196139 11.07 -0.196139 11.8545 0.588418L12.3902 1.12403C12.5834 1.31563 12.7368 1.5436 12.8414 1.79479C12.9461 2.04598 13 2.31541 13 2.58753C13 2.85965 12.9461 3.12908 12.8414 3.38027C12.7368 3.63146 12.5834 3.85943 12.3902 4.05103L11.7263 4.71489L8.25614 1.24473V1.25227ZM7.4565 2.05192L0.584076 8.92434C0.365305 9.14311 0.229516 9.42978 0.206885 9.73907L0.00320145 11.9494C-0.01943 12.2285 0.0786397 12.5001 0.274779 12.7038C0.455831 12.8848 0.689689 12.9829 0.938636 12.9829H1.02162L3.23196 12.7792C3.54125 12.7491 3.82792 12.6133 4.04669 12.3945L10.9191 5.52208L7.44895 2.05192H7.4565Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </button>
                                        <button
                                            class="cursor-pointer text-lightgray duration-300 hover:text-red-400 delete-leave-btn"
                                            data-id="{{ $leave->id }}"><svg width="12" height="15"
                                                viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.8462 1.84615H8.30769V1.38462C8.30769 0.619904 7.68779 0 6.92308 0H5.07692C4.31221 0 3.69231 0.619904 3.69231 1.38462V1.84615H1.15385C0.516606 1.84615 0 2.36276 0 3V3.92308C0 4.17799 0.206625 4.38462 0.461538 4.38462H11.5385C11.7934 4.38462 12 4.17799 12 3.92308V3C12 2.36276 11.4834 1.84615 10.8462 1.84615ZM4.61538 1.38462C4.61538 1.13019 4.8225 0.923077 5.07692 0.923077H6.92308C7.1775 0.923077 7.38462 1.13019 7.38462 1.38462V1.84615H4.61538V1.38462ZM0.875885 5.30769C0.856367 5.30769 0.837052 5.31166 0.81911 5.31934C0.801169 5.32702 0.784974 5.33827 0.771505 5.3524C0.758037 5.36652 0.747576 5.38324 0.740756 5.40152C0.733935 5.41981 0.730898 5.43929 0.731827 5.45879L1.1126 13.4504C1.14779 14.19 1.75529 14.7692 2.49548 14.7692H9.50452C10.2447 14.7692 10.8522 14.19 10.8874 13.4504L11.2682 5.45879C11.2691 5.43929 11.2661 5.41981 11.2592 5.40152C11.2524 5.38324 11.242 5.36652 11.2285 5.3524C11.215 5.33827 11.1988 5.32702 11.1809 5.31934C11.1629 5.31166 11.1436 5.30769 11.1241 5.30769H0.875885ZM7.84615 6.46154C7.84615 6.20654 8.05269 6 8.30769 6C8.56269 6 8.76923 6.20654 8.76923 6.46154V12.4615C8.76923 12.7165 8.56269 12.9231 8.30769 12.9231C8.05269 12.9231 7.84615 12.7165 7.84615 12.4615V6.46154ZM5.53846 6.46154C5.53846 6.20654 5.745 6 6 6C6.255 6 6.46154 6.20654 6.46154 6.46154V12.4615C6.46154 12.7165 6.255 12.9231 6 12.9231C5.745 12.9231 5.53846 12.7165 5.53846 12.4615V6.46154ZM3.23077 6.46154C3.23077 6.20654 3.43731 6 3.69231 6C3.94731 6 4.15385 6.20654 4.15385 6.46154V12.4615C4.15385 12.7165 3.94731 12.9231 3.69231 12.9231C3.43731 12.9231 3.23077 12.7165 3.23077 12.4615V6.46154Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- popup -->
    <div
        class="popup-main fixed z-40 lg:max-w-[calc(100%-386px)] xl:max-w-[calc(100%-406px)] w-full ml-auto inset-y-0 right-0 left-5 lg:left-10 xl:left-14 invisible opacity-0 duration-300">
        <div
            class="z-10 w-full max-w-[320px] sm:max-w-[400px] bg-white absolute top-1/2 left-1/2 -translate-1/2 rounded-10px overflow-hidden">
            <h2 class="text-white bg-purple text-sm sm:text-base font-bold py-3.5 text-center">Add Leave Type</h2>
            <div class="bg-white p-3.5">
                <form id="addNewUserForm" action="{{ route('leave-types.store') }}" method="POST"
                    class="text-xs space-y-3.5">
                    @csrf
                    <input type="hidden" class="form-control type-id" name="type-id">
                    <fieldset class="flex border-[1.5px] border-gray rounded-md overflow-hidden">
                        <label for="leavetype" class="bg-purple inline-flex p-2.5"><svg width="14" height="14"
                                viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.4274 3.73509C10.31 3.85264 10.2441 4.01197 10.2441 4.1781C10.2441 4.34422 10.31 4.50356 10.4274 4.6211L11.8646 6.05877H5.02121C4.85501 6.05877 4.69561 6.12482 4.57808 6.24238C4.46056 6.35994 4.39453 6.5194 4.39453 6.68566C4.39453 6.85192 4.46056 7.01137 4.57808 7.12894C4.69561 7.2465 4.85501 7.31255 5.02121 7.31255H11.8646L10.4274 8.75022C10.3658 8.80761 10.3164 8.87682 10.2822 8.95372C10.2479 9.03061 10.2295 9.11363 10.228 9.1978C10.2265 9.28197 10.242 9.36558 10.2735 9.44364C10.3051 9.5217 10.352 9.59261 10.4115 9.65213C10.471 9.71166 10.5419 9.75859 10.6199 9.79012C10.6979 9.82165 10.7815 9.83714 10.8657 9.83565C10.9498 9.83416 11.0328 9.81574 11.1097 9.78148C11.1865 9.74721 11.2557 9.69781 11.3131 9.63622L13.8198 7.12866C13.9372 7.01112 14.0031 6.85178 14.0031 6.68566C14.0031 6.51953 13.9372 6.3602 13.8198 6.24266L11.3131 3.73509C11.1956 3.6177 11.0363 3.55176 10.8702 3.55176C10.7042 3.55176 10.5449 3.6177 10.4274 3.73509Z"
                                    fill="white" />
                                <path
                                    d="M0 6.68683C0 8.46029 0.704268 10.1611 1.95787 11.4151C3.21148 12.6692 4.91173 13.3737 6.6846 13.3737V10.2392C6.6846 9.451 6.6846 9.05731 6.43978 8.81241C6.19495 8.5675 5.8014 8.5675 5.01345 8.5675C4.51483 8.5675 4.03663 8.36936 3.68406 8.01667C3.33148 7.66397 3.13341 7.18562 3.13341 6.68683C3.13341 6.18805 3.33148 5.70969 3.68406 5.357C4.03663 5.0043 4.51483 4.80616 5.01345 4.80616C5.8014 4.80616 6.19495 4.80616 6.43978 4.56125C6.6846 4.31635 6.6846 3.92266 6.6846 3.13445V0C4.91173 0 3.21148 0.704503 1.95787 1.95853C0.704268 3.21255 0 4.91337 0 6.68683Z"
                                    fill="white" />
                            </svg>
                        </label>
                        <input id="leavetype" placeholder="Leave Type" type="text" name="leave_type"
                            class="w-full outline-none px-2.5" required>
                    </fieldset>
                    <fieldset class="flex border-[1.5px] border-gray rounded-md overflow-hidden">
                        <label for="availabledays" class="bg-purple inline-flex p-2.5"><svg width="14" height="14"
                                viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_7011_808)">
                                    <path
                                        d="M6.3905 9.7753C6.46804 9.85273 6.57315 9.89631 6.68284 9.89631C6.79243 9.89631 6.89753 9.85284 6.97508 9.7753L8.45089 8.29948C8.61239 8.13798 8.61239 7.87629 8.45089 7.71479C8.2895 7.5534 8.02771 7.5534 7.86631 7.71479L6.68284 8.89827L6.14323 8.35865C5.98173 8.19726 5.72004 8.19726 5.55854 8.35865C5.39715 8.52005 5.39715 8.78184 5.55854 8.94334L6.3905 9.7753Z"
                                        fill="white" />
                                    <path
                                        d="M7.00433 12.0271C8.81383 12.0271 10.2859 10.5549 10.2859 8.74544C10.2859 6.93594 8.81383 5.46387 7.00433 5.46387C5.19473 5.46387 3.72266 6.93594 3.72266 8.74544C3.72266 10.5549 5.19484 12.0271 7.00433 12.0271ZM7.00433 6.29059C8.35796 6.29059 9.45918 7.39182 9.45918 8.74544C9.45918 10.0991 8.35796 11.2004 7.00433 11.2004C5.65071 11.2004 4.54938 10.0991 4.54938 8.74544C4.54938 7.39182 5.65071 6.29059 7.00433 6.29059Z"
                                        fill="white" />
                                    <path
                                        d="M12.5055 0.880234H11.7515V0.413361C11.7515 0.185104 11.5664 0 11.3382 0C11.1099 0 10.9248 0.185104 10.9248 0.413361V0.880234H10.1125V0.413361C10.1125 0.185104 9.92738 0 9.69902 0C9.47076 0 9.28566 0.185104 9.28566 0.413361V0.880234H4.72096V0.413361C4.72096 0.185104 4.53586 0 4.3075 0C4.07924 0 3.89413 0.185104 3.89413 0.413361V0.880234H3.08183V0.413361C3.08183 0.185104 2.89673 0 2.66837 0C2.44011 0 2.255 0.185104 2.255 0.413361V0.880234H1.50092C0.763809 0.880234 0.164062 1.47998 0.164062 2.21719V12.6631C0.164062 13.4003 0.763809 14 1.50092 14H12.5055C13.2427 14 13.8423 13.4003 13.8423 12.6631V2.21719C13.8423 1.47998 13.2426 0.880234 12.5055 0.880234ZM13.0155 12.6631C13.0155 12.9444 12.7867 13.1733 12.5055 13.1733H1.50092C1.21968 13.1733 0.990784 12.9444 0.990784 12.6631V4.31754H13.0155V12.6631ZM0.990784 2.21719C0.990784 1.93585 1.21968 1.70706 1.50092 1.70706H2.255V2.17393C2.255 2.40219 2.44011 2.5873 2.66847 2.5873C2.89673 2.5873 3.08183 2.40219 3.08183 2.17393V1.70706H3.89413V2.17393C3.89413 2.40219 4.07924 2.5873 4.3076 2.5873C4.53586 2.5873 4.72096 2.40219 4.72096 2.17393V1.70706H9.28566V2.17393C9.28566 2.40219 9.47076 2.5873 9.69913 2.5873C9.92738 2.5873 10.1125 2.40219 10.1125 2.17393V1.70706H10.9248V2.17393C10.9248 2.40219 11.1099 2.5873 11.3382 2.5873C11.5665 2.5873 11.7516 2.40219 11.7516 2.17393V1.70706H12.5055C12.7867 1.70706 13.0156 1.93585 13.0156 2.21719V3.49071H0.990784V2.21719Z"
                                        fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_7011_808">
                                        <rect width="14" height="14" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </label>
                        <input id="availabledays" placeholder="Available Days" type="text" name="assigned"
                            class="w-full outline-none px-2.5">
                    </fieldset>
                    <fieldset>
                        <textarea class="border-[1.5px] border-gray rounded-md w-full resize-none h-28 outline-none p-2.5" name="description"
                            id="" placeholder="Description here"></textarea>
                    </fieldset>
                    <fieldset class="mb-6">
                        <label for="" class="font-bold w-full block">
                            Apply Base
                        </label>
                        <div class="flex space-x-5.5 items-center mt-2.5 font-medium">
                            <div class="flex items-center">
                                <input type="radio" name="apply_base" value="month" checked
                                    class="mr-2 accent-purple border-purple">
                                <label for="monthbase">Month Base</label><br>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="yearbase" name="apply_base" value="year"
                                    class="mr-2 accent-purple border-purple">
                                <label for="yearbase">Year Base</label><br>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mb-6">
                        <label for="" class="font-bold w-full block">
                            Leave Type
                        </label>
                        <div class="flex space-x-5.5 items-center mt-2.5 font-medium">
                            <div class="flex items-center">
                                <input type="radio" id="paidleave" name="paid_type" value="paid" checked
                                    class="mr-2 accent-purple border-purple">
                                <label for="paidleave">Paid Leave</label><br>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="unpaidleave" name="paid_type" value="unpaid"
                                    class="mr-2 accent-purple border-purple">
                                <label for="unpaidleave">Unpaid Leave</label><br>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="flex gap-2 mb-6">
                        <div class="inline-flex items-center">
                            <label class="flex items-center cursor-pointer relative">
                                <input type="checkbox" id="earlyleave" name="early_leave" value="1"
                                    class="peer h-3.5 w-3.5 cursor-pointer transition-all appearance-none rounded border border-[#8b8b8b] checked:bg-purple checked:border-purple"
                                    id="check" />
                                <span
                                    class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5" viewBox="0 0 20 20"
                                        fill="currentColor" stroke="currentColor" stroke-width="1">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </label>
                        </div>
                        <label for="earlyleave" class="font-medium cursor-pointer">Early Leave</label>
                    </fieldset>
                    <fieldset class="mb-6">
                        <div class="flex space-x-5.5 items-center font-medium">
                            <div class="flex items-center">
                                <input type="radio" id="active" name="status" value="1" checked
                                    class="mr-2 accent-purple border-purple">
                                <label for="active">Active</label><br>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="inactive" name="status" value="2"
                                    class="mr-2 accent-purple border-purple">
                                <label for="inactive">Inactive</label><br>
                            </div>
                        </div>
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

    {{-- edit model  --}}
    <div
        class="edit-popup-main fixed z-40 lg:max-w-[calc(100%-386px)] xl:max-w-[calc(100%-406px)] w-full ml-auto inset-y-0 right-0 left-5 lg:left-10 xl:left-14 invisible opacity-0 duration-300">
        <div
            class="z-10 w-full max-w-[320px] sm:max-w-[400px] bg-white absolute top-1/2 left-1/2 -translate-1/2 rounded-10px overflow-hidden">
            <h2 class="text-white bg-purple text-sm sm:text-base font-bold py-3.5 text-center">Edit Leave Type</h2>
            <div class="bg-white p-3.5">
                <form id="addNewUserForm" method="POST" class="text-xs space-y-3.5">
                    @csrf
                    <input type="hidden" class="form-control type-id" name="type-id">
                    <fieldset class="flex border-[1.5px] border-gray rounded-md overflow-hidden">
                        <label for="leavetype" class="bg-purple inline-flex p-2.5"><svg width="14" height="14"
                                viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.4274 3.73509C10.31 3.85264 10.2441 4.01197 10.2441 4.1781C10.2441 4.34422 10.31 4.50356 10.4274 4.6211L11.8646 6.05877H5.02121C4.85501 6.05877 4.69561 6.12482 4.57808 6.24238C4.46056 6.35994 4.39453 6.5194 4.39453 6.68566C4.39453 6.85192 4.46056 7.01137 4.57808 7.12894C4.69561 7.2465 4.85501 7.31255 5.02121 7.31255H11.8646L10.4274 8.75022C10.3658 8.80761 10.3164 8.87682 10.2822 8.95372C10.2479 9.03061 10.2295 9.11363 10.228 9.1978C10.2265 9.28197 10.242 9.36558 10.2735 9.44364C10.3051 9.5217 10.352 9.59261 10.4115 9.65213C10.471 9.71166 10.5419 9.75859 10.6199 9.79012C10.6979 9.82165 10.7815 9.83714 10.8657 9.83565C10.9498 9.83416 11.0328 9.81574 11.1097 9.78148C11.1865 9.74721 11.2557 9.69781 11.3131 9.63622L13.8198 7.12866C13.9372 7.01112 14.0031 6.85178 14.0031 6.68566C14.0031 6.51953 13.9372 6.3602 13.8198 6.24266L11.3131 3.73509C11.1956 3.6177 11.0363 3.55176 10.8702 3.55176C10.7042 3.55176 10.5449 3.6177 10.4274 3.73509Z"
                                    fill="white" />
                                <path
                                    d="M0 6.68683C0 8.46029 0.704268 10.1611 1.95787 11.4151C3.21148 12.6692 4.91173 13.3737 6.6846 13.3737V10.2392C6.6846 9.451 6.6846 9.05731 6.43978 8.81241C6.19495 8.5675 5.8014 8.5675 5.01345 8.5675C4.51483 8.5675 4.03663 8.36936 3.68406 8.01667C3.33148 7.66397 3.13341 7.18562 3.13341 6.68683C3.13341 6.18805 3.33148 5.70969 3.68406 5.357C4.03663 5.0043 4.51483 4.80616 5.01345 4.80616C5.8014 4.80616 6.19495 4.80616 6.43978 4.56125C6.6846 4.31635 6.6846 3.92266 6.6846 3.13445V0C4.91173 0 3.21148 0.704503 1.95787 1.95853C0.704268 3.21255 0 4.91337 0 6.68683Z"
                                    fill="white" />
                            </svg>
                        </label>
                        <input id="leavetype" placeholder="Leave Type" type="text" name="leave_type"
                            class="w-full outline-none px-2.5" required>
                    </fieldset>
                    <fieldset class="flex border-[1.5px] border-gray rounded-md overflow-hidden">
                        <label for="availabledays" class="bg-purple inline-flex p-2.5"><svg width="14"
                                height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_7011_808)">
                                    <path
                                        d="M6.3905 9.7753C6.46804 9.85273 6.57315 9.89631 6.68284 9.89631C6.79243 9.89631 6.89753 9.85284 6.97508 9.7753L8.45089 8.29948C8.61239 8.13798 8.61239 7.87629 8.45089 7.71479C8.2895 7.5534 8.02771 7.5534 7.86631 7.71479L6.68284 8.89827L6.14323 8.35865C5.98173 8.19726 5.72004 8.19726 5.55854 8.35865C5.39715 8.52005 5.39715 8.78184 5.55854 8.94334L6.3905 9.7753Z"
                                        fill="white" />
                                    <path
                                        d="M7.00433 12.0271C8.81383 12.0271 10.2859 10.5549 10.2859 8.74544C10.2859 6.93594 8.81383 5.46387 7.00433 5.46387C5.19473 5.46387 3.72266 6.93594 3.72266 8.74544C3.72266 10.5549 5.19484 12.0271 7.00433 12.0271ZM7.00433 6.29059C8.35796 6.29059 9.45918 7.39182 9.45918 8.74544C9.45918 10.0991 8.35796 11.2004 7.00433 11.2004C5.65071 11.2004 4.54938 10.0991 4.54938 8.74544C4.54938 7.39182 5.65071 6.29059 7.00433 6.29059Z"
                                        fill="white" />
                                    <path
                                        d="M12.5055 0.880234H11.7515V0.413361C11.7515 0.185104 11.5664 0 11.3382 0C11.1099 0 10.9248 0.185104 10.9248 0.413361V0.880234H10.1125V0.413361C10.1125 0.185104 9.92738 0 9.69902 0C9.47076 0 9.28566 0.185104 9.28566 0.413361V0.880234H4.72096V0.413361C4.72096 0.185104 4.53586 0 4.3075 0C4.07924 0 3.89413 0.185104 3.89413 0.413361V0.880234H3.08183V0.413361C3.08183 0.185104 2.89673 0 2.66837 0C2.44011 0 2.255 0.185104 2.255 0.413361V0.880234H1.50092C0.763809 0.880234 0.164062 1.47998 0.164062 2.21719V12.6631C0.164062 13.4003 0.763809 14 1.50092 14H12.5055C13.2427 14 13.8423 13.4003 13.8423 12.6631V2.21719C13.8423 1.47998 13.2426 0.880234 12.5055 0.880234ZM13.0155 12.6631C13.0155 12.9444 12.7867 13.1733 12.5055 13.1733H1.50092C1.21968 13.1733 0.990784 12.9444 0.990784 12.6631V4.31754H13.0155V12.6631ZM0.990784 2.21719C0.990784 1.93585 1.21968 1.70706 1.50092 1.70706H2.255V2.17393C2.255 2.40219 2.44011 2.5873 2.66847 2.5873C2.89673 2.5873 3.08183 2.40219 3.08183 2.17393V1.70706H3.89413V2.17393C3.89413 2.40219 4.07924 2.5873 4.3076 2.5873C4.53586 2.5873 4.72096 2.40219 4.72096 2.17393V1.70706H9.28566V2.17393C9.28566 2.40219 9.47076 2.5873 9.69913 2.5873C9.92738 2.5873 10.1125 2.40219 10.1125 2.17393V1.70706H10.9248V2.17393C10.9248 2.40219 11.1099 2.5873 11.3382 2.5873C11.5665 2.5873 11.7516 2.40219 11.7516 2.17393V1.70706H12.5055C12.7867 1.70706 13.0156 1.93585 13.0156 2.21719V3.49071H0.990784V2.21719Z"
                                        fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_7011_808">
                                        <rect width="14" height="14" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </label>
                        <input id="availabledays" placeholder="Available Days" type="text" name="assigned"
                            class="w-full outline-none px-2.5">
                    </fieldset>
                    <fieldset>
                        <textarea class="border-[1.5px] border-gray rounded-md w-full resize-none h-28 outline-none p-2.5" name="description"
                            id="" placeholder="Description here"></textarea>
                    </fieldset>
                    <fieldset class="mb-6">
                        <label for="" class="font-bold w-full block">
                            Apply Base
                        </label>
                        <div class="flex space-x-5.5 items-center mt-2.5 font-medium">
                            <div class="flex items-center">
                                <input type="radio" name="apply_base" value="month" checked
                                    class="mr-2 accent-purple border-purple">
                                <label for="monthbase">Month Base</label><br>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="yearbase" name="apply_base" value="year"
                                    class="mr-2 accent-purple border-purple">
                                <label for="yearbase">Year Base</label><br>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mb-6">
                        <label for="" class="font-bold w-full block">
                            Leave Type
                        </label>
                        <div class="flex space-x-5.5 items-center mt-2.5 font-medium">
                            <div class="flex items-center">
                                <input type="radio" id="paidleave" name="paid_type" value="paid" checked
                                    class="mr-2 accent-purple border-purple">
                                <label for="paidleave">Paid Leave</label><br>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="unpaidleave" name="paid_type" value="unpaid"
                                    class="mr-2 accent-purple border-purple">
                                <label for="unpaidleave">Unpaid Leave</label><br>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="flex gap-2 mb-6">
                        <div class="inline-flex items-center">
                            <label class="flex items-center cursor-pointer relative">
                                <input type="checkbox" id="earlyleave" name="early_leave" value="1"
                                    class="peer h-3.5 w-3.5 cursor-pointer transition-all appearance-none rounded border border-[#8b8b8b] checked:bg-purple checked:border-purple"
                                    id="check" />
                                <span
                                    class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5" viewBox="0 0 20 20"
                                        fill="currentColor" stroke="currentColor" stroke-width="1">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </label>
                        </div>
                        <label for="earlyleave" class="font-medium cursor-pointer">Early Leave</label>
                    </fieldset>
                    <fieldset class="mb-6">
                        <div class="flex space-x-5.5 items-center font-medium">
                            <div class="flex items-center">
                                <input type="radio" id="active" name="status" value="1" checked
                                    class="mr-2 accent-purple border-purple">
                                <label for="active">Active</label><br>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="inactive" name="status" value="2"
                                    class="mr-2 accent-purple border-purple">
                                <label for="inactive">Inactive</label><br>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="flex gap-1.5 justify-center mt-5.5">
                        <button type="submit"
                            class="cursor-pointer bg-purple text-white font-semibold py-1.5 px-4 rounded-sm">Save</button>
                        <button {{-- class="edit-popup-close cursor-pointer bg-purple text-white font-semibold py-1.5 px-4 rounded-sm">Close</button> --}} <button
                            class="edit-popup-close cursor-pointer bg-purple text-white font-semibold py-1.5 px-4 rounded-sm">Close</button>

                    </fieldset>
                </form>
            </div>
        </div>
        <div class="edit-popup-closebg bg-black/10 absolute inset-0"></div>
    </div>
@endsection
@section('custom-js')
    {{-- edit script --}}
    <script>
        $(document).on('click', '.edit-popup-button', function() {
            const modal = $('.edit-popup-main');

            // Get data attributes
            const id = $(this).data('id');
            const leave_type = $(this).data('leave_type');
            const description = $(this).data('description');
            const assign_days = $(this).data('assign_days');
            const apply_base = $(this).data('apply_base');
            const paid_type = $(this).data('paid_type');
            const early_leave = $(this).data('early_leave');
            const status = $(this).data('status');

            // Update form fields
            modal.find('input[name="leave_type"]').val(leave_type);
            modal.find('textarea[name="description"]').val(description);
            modal.find('input[name="assigned"]').val(assign_days);
            modal.find(`input[name="apply_base"][value="${apply_base}"]`).prop('checked', true);
            modal.find(`input[name="paid_type"][value="${paid_type}"]`).prop('checked', true);
            modal.find('input[type="checkbox"]#earlyleave').prop('checked', early_leave == 1);

            // Set hidden ID
            modal.find('input.type-id').val(id);

            // Update form action to the update route
            const form = modal.find('form#addNewUserForm');
            form.attr('action', `/chameleon/leave-types/${id}`);
            form.append('<input type="hidden" name="_method" value="PUT">');

            // Show modal
            modal.removeClass('invisible opacity-0').addClass('visible opacity-100');
        });
    </script>

    {{-- create model  --}}
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

        document.addEventListener('DOMContentLoaded', function() {
            const popupMain = document.querySelector('.edit-popup-main');

            // Open modal using jQuery (already handled in your script)

            // Close modal on button or background click
            document.addEventListener('click', function(e) {
                if (
                    e.target.classList.contains('edit-popup-close') ||
                    e.target.classList.contains('edit-popup-closebg')
                ) {
                    e.preventDefault();
                    popupMain.classList.add('invisible', 'opacity-0');
                    popupMain.classList.remove('visible', 'opacity-100');
                }
            });
        });


        $('.table-leavetype').DataTable({
            responsive: true,
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: -1
                }
            ],
            // paging: false,
            // ordering: false,
            // info: false,
            // searching: false
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Delete function --}}
    <script>
        $(document).ready(function() {
            $('.delete-leave-btn').click(function() {
                var teamId = $(this).data('id');

                // SweetAlert confirm dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You no longer want to keep this leave types?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/chameleon/leave-types/' + teamId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Leave Type has been deleted.',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location
                                        .reload(); // Or use jQuery to remove from DOM
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
