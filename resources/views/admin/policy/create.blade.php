@extends('layouts.admin')

@section('custom-css')
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
    <div class="mt-10 lg:mt-11">
        <div class="bg-white shadow-primary mt-5.5 rounded-10px">
            <div class="bg-lightgraybg p-5 rounded-t-10px border-b-2 border-gray text-right">
                <div class="flex items-center justify-between">
                    <h2 class="font-bold sm:text-base">Form Editors</h2>
                </div>

                <form action="{{ route('policy.store') }}" method="POST" class="container mt-5">
                    @csrf

                    <!-- Quill Editor -->
                    <div id="editor" style="height: 300px;">{!! old('content', $content ?? '') !!}</div>
                    <input type="hidden" name="content" id="content">

                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        document.querySelector('form').onsubmit = function() {
            document.querySelector('#content').value = quill.root.innerHTML;
        };
    </script>
@endsection
