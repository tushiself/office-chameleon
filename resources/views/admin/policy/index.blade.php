@extends('layouts.admin')

@section('content')
    <!-- data -->
    <div class="mt-10 lg:mt-11">
        <h2 class="font-bold text-base"></h2>
        <form class="bg-white shadow-primary rounded-10px mt-5.5">
            @csrf
            <div class="flex flex-wrap font-semibold rounded-10px">
                <div class="w-full">
                    <div class="flex items-center justify-between bg-lightgraybg border-b-2 rounded-t-10px p-3 sm:p-5 xl:p-7 xl:px-9 border-gray">
                        <h4 class="xl:text-base">Chameleon Infotech LLP - Policy</h4>
                        <div class="flex items-center gap-4">
                           
                            <!-- Edit Button -->
                            <a href="{{ route('policy.edit', $policy->id) }}"
                                class="text-gray-600 hover:text-purple transition duration-200" title="Edit">
                                <svg width="18" height="18" viewBox="0 0 15 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.52632 1.44493L10.2923 0.678944C11.1976 -0.226315 12.7731 -0.226315 13.6783 0.678944L14.2963 1.29696C14.5193 1.51804 14.6963 1.78108 14.817 2.07091C14.9378 2.36074 15 2.67162 15 2.98561C15 3.2996 14.9378 3.61048 14.817 3.90031C14.6963 4.19014 14.5193 4.45319 14.2963 4.67427L13.5303 5.44026L9.52632 1.43623V1.44493ZM8.60365 2.3676L0.673933 10.2973C0.421506 10.5497 0.264826 10.8805 0.238713 11.2374L0.00369398 13.7878C-0.0224192 14.1098 0.0907381 14.4232 0.317053 14.6582C0.525958 14.8671 0.795795 14.9803 1.08304 14.9803H1.17879L3.72918 14.7453C4.08606 14.7105 4.41683 14.5538 4.66926 14.3013L12.599 6.37163L8.59495 2.3676H8.60365Z"
                                        fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="p-3 sm:p-5 xl:p-10 xl:py-7">
                        <div id="policy-rendered" class="ql-editor">
                            {!! $policy->content !!}
                        </div>

                        <pre id="policy-source" class="hidden text-sm bg-gray-100 p-4 rounded-md overflow-x-auto">{!! htmlentities($policy->content) !!}</pre>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom-js')
   
@endsection
