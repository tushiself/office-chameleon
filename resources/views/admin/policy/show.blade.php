@extends('layouts.admin')

@section('custom-css')
    <!-- Quill CSS for consistent formatting -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
    <div class="mt-10">
        <div
            class="max-w-none text-gray-800 leading-relaxed bg-gradient-to-br from-gray-50 via-white to-gray-100 p-8 rounded-xl shadow-xl border border-gray-300">
            <article class="space-y-6 text-base">
                <h1 class="text-3xl font-bold text-indigo-700 border-b pb-2">📌 {{ $policy->title ?? 'Policy' }}</h1>

                <div class="ql-editor prose prose-indigo max-w-full text-gray-900">
                    {!! $policy->content !!}
                </div>
            </article>
        </div>

    </div>
@endsection
