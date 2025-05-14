 <!-- top bar -->
 <div class="flex lg:gap-4 items-center justify-between lg:pt-5">
     <div class="flex gap-4 items-center md:w-1/2">
         <button
             class="hamburger-menu bg-white w-10 h-10 flex items-center justify-center rounded-full shadow-primary lg:hidden cursor-pointer"><svg
                 class="w-5 h-5" width="100%" height="100%" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                 <path d="M3 12H21M3 6H21M3 18H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" />
             </svg></button>
         <label for="search"
             class="max-w-[360px] w-full sm:flex items-center shadow-primary bg-white rounded-full py-2 px-3 sm:py-4 sm:px-7 font-semibold hidden">
             <input id="search" type="text" class="w-full placeholder:text outline-none appearance-none"
                 placeholder='Try searching "NewProducts"'>
             <button class="cursor-pointer ml-1">
                 <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                     <path
                         d="M15 15L11.6945 11.6886M13.5263 7.26316C13.5263 8.92425 12.8665 10.5173 11.6919 11.6919C10.5173 12.8665 8.92425 13.5263 7.26316 13.5263C5.60207 13.5263 4.00901 12.8665 2.83444 11.6919C1.65987 10.5173 1 8.92425 1 7.26316C1 5.60207 1.65987 4.00901 2.83444 2.83444C4.00901 1.65987 5.60207 1 7.26316 1C8.92425 1 10.5173 1.65987 11.6919 2.83444C12.8665 4.00901 13.5263 5.60207 13.5263 7.26316Z"
                         stroke="#C3CAD9" stroke-width="2" stroke-linecap="round" />
                 </svg>
             </button>
         </label>
     </div>
     <div class="flex items-center justify-end gap-3 md:gap-4.5 md:w-1/2">
        
         <div class="profile relative group">
             <button class="flex items-center font-semibold cursor-pointer">
                 <img src="{{ Auth::user()->avatar ? asset('admin-uploads/avatar/' . Auth::user()->avatar) : asset('admin-assets/images/Group-1.jpg') }}" class="w-10 h-10 rounded-full" alt="user">
                 <span class="md:inline-block mx-2.5 hidden"> @if(Auth::check())
                     {{ Auth::user()->first_name }}  {{ Auth::user()->last_name }}
                @else
                    <script>
                        window.location.href = "{{ route('login') }}";
                    </script>
                @endif</span>
                 <svg class="ml-2 group-hover:rotate-180 duration-300" width="10" height="6" viewBox="0 0 10 6"
                     fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" clip-rule="evenodd"
                         d="M0.183925 1.10861C0.126384 1.04913 0.0804868 0.97798 0.0489123 0.899311C0.0173377 0.820642 0.000717943 0.73603 2.28109e-05 0.650413C-0.000672321 0.564795 0.0145711 0.479887 0.0448635 0.400642C0.075156 0.321397 0.119891 0.249403 0.176458 0.18886C0.233025 0.128317 0.300291 0.0804386 0.374332 0.048017C0.448372 0.0155954 0.527705 -0.000719564 0.607699 2.42994e-05C0.687694 0.00076864 0.76675 0.0185561 0.840253 0.0523495C0.913756 0.0861435 0.980235 0.135267 1.03581 0.196853L4.5777 3.98769C4.69068 4.10857 4.84389 4.17648 5.00364 4.17648C5.16339 4.17648 5.3166 4.10857 5.42958 3.98769L8.97147 0.196207C9.08452 0.0752995 9.23781 0.00740928 9.39763 0.00746983C9.55744 0.00753039 9.71069 0.0755378 9.82366 0.19653C9.93662 0.317523 10.0001 0.48159 10 0.652639C9.99994 0.823687 9.9364 0.987706 9.82336 1.10861L5.42958 5.81121C5.3166 5.93209 5.16339 6 5.00364 6C4.84389 6 4.69068 5.93209 4.5777 5.81121L0.183925 1.10861Z"
                         fill="#C3CAD9" />
                 </svg>
             </button>
             <div
                 class="z-20 profile-item w-36 md:w-48 absolute top-full right-0 pt-2 group-hover:visible group-hover:opacity-100 invisible opacity-0 duration-300">
                 <ul class="shadow-primary bg-white rounded-lg p-3 sm:p-4.5 text-sm font-medium space-y-4">
                     <li>
                         <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 md:gap-4 hover:text-purple duration-300">
                             <svg class="w-4 h-4" width="13" height="15" viewBox="0 0 13 15" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                     d="M6.22591 7.66667C4.11258 7.66667 2.39258 5.94667 2.39258 3.83333C2.39258 1.72 4.11258 0 6.22591 0C8.33925 0 10.0592 1.72 10.0592 3.83333C10.0592 5.94667 8.33925 7.66667 6.22591 7.66667ZM6.22591 1C4.66591 1 3.39258 2.27333 3.39258 3.83333C3.39258 5.39333 4.66591 6.66667 6.22591 6.66667C7.78591 6.66667 9.05924 5.39333 9.05924 3.83333C9.05924 2.27333 7.78591 1 6.22591 1Z"
                                     fill="currentColor" />
                                 <path
                                     d="M11.9533 14.3337C11.68 14.3337 11.4533 14.107 11.4533 13.8337C11.4533 11.5337 9.10669 9.66699 6.22669 9.66699C3.34666 9.66699 1 11.5337 1 13.8337C1 14.107 0.773333 14.3337 0.5 14.3337C0.226667 14.3337 0 14.107 0 13.8337C0 10.987 2.79333 8.66699 6.22669 8.66699C9.66003 8.66699 12.4533 10.987 12.4533 13.8337C12.4533 14.107 12.2266 14.3337 11.9533 14.3337Z"
                                     fill="currentColor" />
                             </svg>
                             Profile
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('logout') }}" class="flex items-center gap-2 md:gap-4 hover:text-purple duration-300">
                             <svg class="w-4 h-4" width="14" height="15" viewBox="0 0 14 15" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                     d="M6.97676 13.1247H1.74418C1.42324 13.1247 1.16279 12.8642 1.16279 12.5433V2.07819C1.16279 1.75725 1.42327 1.4968 1.74418 1.4968H6.97676C7.29827 1.4968 7.55814 1.23693 7.55814 0.915422C7.55814 0.593914 7.29827 0.333984 6.97676 0.333984H1.74418C0.782551 0.333984 0 1.11656 0 2.07819V12.5433C0 13.5049 0.782551 14.2875 1.74418 14.2875H6.97676C7.29827 14.2875 7.55814 14.0276 7.55814 13.7061C7.55814 13.3846 7.29827 13.1247 6.97676 13.1247Z"
                                     fill="currentColor" />
                                 <path
                                     d="M13.826 6.89697L10.2911 3.40859C10.0632 3.18301 9.69457 3.18593 9.46899 3.41442C9.2434 3.6429 9.24573 4.01092 9.47481 4.2365L12.001 6.72952H5.23177C4.91027 6.72952 4.65039 6.98939 4.65039 7.3109C4.65039 7.63241 4.91027 7.89231 5.23177 7.89231H12.001L9.47481 10.3853C9.24575 10.6109 9.244 10.9789 9.46899 11.2074C9.58293 11.3225 9.73294 11.3807 9.88295 11.3807C10.0306 11.3807 10.1783 11.3249 10.2911 11.2132L13.826 7.72483C13.9364 7.61554 13.9992 7.46668 13.9992 7.31087C13.9992 7.15512 13.937 7.00686 13.826 6.89697Z"
                                     fill="currentColor" />
                             </svg>
                             Logout
                         </a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </div>
