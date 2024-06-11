<div dir="{{ App::getLocale() == "en" ? "rtl" : "ltr" }}" class="relative flex flex-wrap flex-[100%]">
    <button class="flex-[50%] *:inline-block join-item px-2 bg-blue-200 font-bold shadow-sm
                    shadow-stone-800 dark:shadow-stone-200 sm:text-lg text-sm active:scale-90 transition-all
                    duration-300 hover:bg-blue-300 py-1 rounded-s-lg dark:hover:bg-[rgb(0,3,80)] dark:bg-[rgb(0,3,50)] dropdown-btn-ptr"
            id="btn-patterns" type="button">{{ __("choose-ptr-1") }}</button>
    <button id="btn-search" class="flex-[50%] *:inline-block join-item px-2 bg-blue-200
     font-bold shadow-sm shadow-stone-800 sm:text-lg text-sm active:scale-90 transition-all
                    duration-300 dark:shadow-stone-200 py-1 rounded-e-lg *:relative
                    *:top-[-1px] hover:bg-blue-300 border-s-2 dark:hover:bg-[rgb(0,3,80)] dark:bg-[rgb(0,3,50)] border-dashed border-blue-600 dark:border-blue-200"
            type="submit">{{ __("btnSearch") }}
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
             class="size-5">
            <path fill-rule="evenodd"
                  d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                  clip-rule="evenodd"/>
        </svg>
    </button>
    {{--  div choose ptr :  --}}
    <div class="hidden absolute z-10 bg-blue-50 dark:bg-stone-600 *:p-1 shadow-sm shadow-stone-800
                        *:text-sm *:sm:text-lg rounded-md *:rounded-md w-full
                         h-[50px] *:text-center *:cursor-pointer top-[36px] overflow-y-hidden
                         overflow-x-auto gap-2 flex-row *:whitespace-nowrap" id="dropdown-ptr">
        @for($p = 0; $p < 17; $p++)
            <p class="pPatternsType hover:bg-blue-200 dark:hover:bg-stone-800">{{ __("choose-ptr-" . $p + 2) }}</p>
        @endfor
    </div>
</div>
