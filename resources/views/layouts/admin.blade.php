<!DOCTYPE html>
<html lang="en">

@include('includes.head')

<body>
    <div class="flex flex-wrap">
        @include('includes.sidebar')
        <!-- side bar remove background -->
        <div
            class="sidebar-removebg fixed inset-0 w-full h-full bg-black/30 z-10 opacity-0 invisible duration-300 block lg:hidden">
        </div>
        <div class="max-w-full ml-auto lg:max-w-[calc(100%-346px)] xl:max-w-[calc(100%-360px)] w-full lg:pl-5 xl:pl-6">

            @include('includes.header')
            @yield('content')
        </div>

    </div>
    @include('includes.scripts')

</body>

</html>
