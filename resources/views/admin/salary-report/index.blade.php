@extends('layouts.admin')
@section('content')
    <div class="mt-10 lg:mt-11">
        <h2 class="font-bold text-base">Salary Report -
            {{ \Carbon\Carbon::createFromFormat('m', $selectedMonth)->format('F') }}
            {{ $selectedYear }}</h2>
        <div class="bg-white shadow-primary mt-5.5 rounded-10px">
            <div class="bg-lightgraybg p-5 lg:p-7 rounded-t-10px border-b-2 border-gray">
                <form method="GET" action="{{ route('salary.report') }}"
                    class="text-xs flex items-center gap-1.5 font-medium">
                    <select name="month" id="month"
                        class="bg-white border border-gray cursor-pointer rounded-sm p-2.5 pr-5 custom-select">
                        @foreach (range(1, 12) as $m)
                            <option value="{{ $m }}" {{ $m == $selectedMonth ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                    <select name="year" id="year"
                        class="bg-white border border-gray cursor-pointer rounded-sm p-2.5 pr-5 custom-select">
                        @foreach (range(date('Y') - 5, date('Y') + 1) as $y)
                            <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>
                                {{ $y }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-purple text-white p-2.5 rounded-sm cursor-pointer">Filter</button>
                </form>
            </div>
            <div class="p-5 lg:p-8">
                <div class="flex flex-wrap -mx-2.5">
                        @foreach ($salaryData as $data)
                        <div class="w-full md:w-1/2 lg:w-full xl:w-1/2 2xl:w-1/3 p-2.5">
                            <div class="bg-lightgraybg rounded-lg border-2 border-gray">
                                <div
                                    class="flex flex-wrap items-center border-b-2 p-4 md:py-5.5 md:px-5.5 border-gray justify-between">
                                    <div class="flex items-center">
                                        <img src="{{ $data['avatar'] ? asset('admin-uploads/avatar/' . $data['avatar']) : asset('admin-assets/images/user-2.jpg') }}"
                                            alt="" class="rounded w-11 h-11">
                                        <div class="ml-4">
                                            <h4 class="font-bold">{{ $data['full_name'] }}</h4>
                                            <p class="text-xs font-semibold">{{ $data['department'] }}</p>
                                        </div>
                                    </div>
                                    <span
                                        class="md:text-lg font-extrabold bg-white -mr-4 md:-mr-5.5 py-2.5 px-3 md:px-5 rounded-10px rounded-tr-none rounded-br-none text-darkgreen shadow-primary">₹{{ round($data['payable_salary']) }}</span>
                                </div>
                                <div class="py-3.5 px-4 md:px-5.5">
                                    <div class="flex flex-wrap -mx-1.5">
                                        <div class="px-1.5 w-1/3">
                                            <div class="shadow-primary bg-white p-3 rounded-10px">
                                                <p class="text-xs font-medium mb-1">Working Days</p>
                                                <span
                                                    class="text-xl font-bold text-purple">{{ $data['working_days'] }}</span>
                                            </div>
                                        </div>
                                        <div class="px-1.5 w-1/3">
                                            <div class="shadow-primary bg-white p-3 rounded-10px">
                                                <p class="text-xs font-medium mb-1">Present Days</p>
                                                <span
                                                    class="text-xl font-bold text-green">{{ $data['present_days'] }}</span>
                                            </div>
                                        </div>
                                        <div class="px-1.5 w-1/3">
                                            <div class="shadow-primary bg-white p-3 rounded-10px">
                                                <p class="text-xs font-medium mb-1">Absent Days</p>
                                                <span
                                                    class="text-xl font-bold text-danger">{{ $data['absentDays'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-1.5 mt-5">
                                        <div class="w-1/2 px-1.5">
                                            <h5 class="font-semibold mb-3">Salary Insights</h5>
                                            <p class="text-[#CFCADB] text-xs mt-1">Salary Per Day : <b
                                                    class="text-darkgray">₹{{ round($data['salary_per_day']) }}</b>
                                            </p>
                                            <p class="text-[#CFCADB] text-xs mt-1">Monthly Salary : <b
                                                    class="text-darkgray">₹{{ round($data['total_salary']) }}</b>
                                            </p>
                                        </div>
                                        <div class="w-1/2 px-1.5">
                                            <h5 class="font-semibold mb-3">Leaves Insights</h5>
                                            <p class="text-[#CFCADB] text-xs mt-1">Paid Leaves : <b
                                                    class="text-darkgray">{{ $data['paid_leaves'] }}</b>
                                            </p>
                                            <p class="text-[#CFCADB] text-xs mt-1">Unpaid Leaves : <b
                                                    class="text-darkgray">{{ $data['unpaid_leaves'] }}</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
@endsection
