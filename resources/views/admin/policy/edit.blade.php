@extends('layouts.admin')
@section('content')
    <div class="mt-10 lg:mt-11">
        <div class="bg-white shadow-primary mt-5.5 rounded-10px">
            <div class="bg-lightgraybg p-5 rounded-t-10px border-b-2 border-gray">
                <div class="flex items-center justify-between">
                    <h2 class="font-bold sm:text-base">Form Editors</h2>
                    <!-- Submit button moved here -->
                    <button type="submit" form="editor-form"
                        class="popup-button bg-purple text-white py-2.5 px-3 sm:px-5 rounded-md inline-flex gap-2 items-center sm:gap-4 font-semibold cursor-pointer text-xs sm:text-sm">
                        Submit
                    </button>
                </div>

                <!-- Editor Form -->
                <form id="editor-form" action="{{ route('policy.update', $policy->id) }}" method="POST"
                    class="container mt-5">
                    @csrf
                    @method('put')
                    <!-- CKEditor Container -->
                    <div id="editor" style="height: 300px;">{!! old('content', $policy->content ?? '') !!}</div>
                    <input type="hidden" name="content" id="content">
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        let editorInstance;

        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editorInstance = editor;
            })
            .catch(error => {
                console.error(error);
            });

        document.querySelector('#editor-form').addEventListener('submit', function (e) {
            document.querySelector('#content').value = editorInstance.getData();
        });
    </script>
@endsection
