<div id="modal-settings" class="fixed z-50 left-0 top-0 w-full h-full bg-black/70 hidden">
    <div class="relative top-[15%] max-h-[60%] m-auto w-[60%] bg-white dark:bg-stone-900 p-3
        shadow-sm shadow-stone-800 dark:shadow-stone-200 rounded-lg animateTop flex flex-col
        items-end overflow-x-hidden overflow-y-auto">
            <span id="modal-btnClose" class="px-3 text-right font-bold text-3xl
            cursor-pointer hover:text-red-700 dark:hover:text-red-400">&times;</span>
        <div class="flex flex-row flex-wrap gap-8 mt-2 justify-between items-stretch
                w-full">
            <div class="flex-auto" dir="{{ App::getLocale() == "en" ? "ltr" : "rtl" }}">
                <p class="pb-2 text-center text-sm sm:text-lg font-bold">{{ __("modalSettings-title-set") }}</p>
                <hr class="border-2 border-stone-600 dark:border-stone-400 rounded-full">
                {{--      theme dropdown :    --}}
                <div class="relative inline-block mt-3">
                    <span class="sm:text-lg text-sm">{{ __("modalSettings-set-1") }}</span>
                    <button id="btn-theme" class="dropdown-btn-theme px-2 sm:py-1 bg-blue-200
                            test-sm sm:text-lg rounded-lg shadow-sm shadow-stone-800
                            dark:shadow-stone-200 dark:hover:bg-[rgb(0,3,80)] dark:bg-[rgb(0,3,50)] hover:bg-blue-300 active:scale-90
                            transition-all *:inline-block *:relative *:top-[-1px]"></button>
                    <div id="dropdown-theme" class="absolute z-10 bg-blue-50 dark:bg-blue-950 *:p-1
                            shadow-sm shadow-stone-800 dark:shadow-stone-200 hidden *:text-sm *:sm:text-lg
                            rounded-md *:rounded-md *:w-full">
                        <p class="*:inline-block pThemeOption dropdown-btn-theme hover:bg-blue-200
                                dark:hover:bg-blue-800 cursor-pointer *:relative *:top-[-1px]">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 fill="currentColor" class="size-6 dropdown-btn-theme">
                                <path fill-rule="evenodd" class="dropdown-btn-theme"
                                      d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z"
                                      clip-rule="evenodd"/>
                            </svg>
                            {{ __("modalSettings-set-3") }}</p>
                        <p class="*:inline-block pThemeOption hover:bg-blue-200
                                dark:hover:bg-blue-800 cursor-pointer dropdown-btn-theme *:relative *:top-[-1px]">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 fill="currentColor" class="size-6 dropdown-btn-theme">
                                <path class="dropdown-btn-theme"
                                    d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z"/>
                            </svg>
                            {{ __("modalSettings-set-4") }}</p>
                        <p class="*:inline-block pThemeOption hover:bg-blue-200
                                dark:hover:bg-blue-800 cursor-pointer dropdown-btn-theme *:relative *:top-[-1px]">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 fill="currentColor" class="size-6 dropdown-btn-theme">
                                <path fill-rule="evenodd" class="dropdown-btn-theme"
                                      d="M2.25 5.25a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3V15a3 3 0 0 1-3 3h-3v.257c0 .597.237 1.17.659 1.591l.621.622a.75.75 0 0 1-.53 1.28h-9a.75.75 0 0 1-.53-1.28l.621-.622a2.25 2.25 0 0 0 .659-1.59V18h-3a3 3 0 0 1-3-3V5.25Zm1.5 0v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5Z"
                                      clip-rule="evenodd"/>
                            </svg>
                            {{ __("modalSettings-set-7") }}</p>
                    </div>
                </div>
                {{--      lang dropdown :    --}}
                <div class="relative block mt-3 mb-3">
                    <span class="sm:text-lg text-sm">{{ __("modalSettings-set-2") }}</span>
                    <button id="btn-lang" class="dropdown-btn-lang px-2 sm:py-1 bg-blue-200
                            test-sm sm:text-lg rounded-lg shadow-sm shadow-stone-800
                            hover:bg-blue-300 dark:hover:bg-[rgb(0,3,80)] dark:bg-[rgb(0,3,50)] dark:shadow-stone-200
                             active:scale-90 transition-all *:inline-block"></button>
                    <div id="dropdown-lang" class="absolute z-10
                                bg-blue-50 *:p-1 shadow-sm shadow-stone-800 *:text-sm *:sm:text-lg
                            rounded-md *:rounded-md dark:shadow-stone-200 *:w-full sm:bottom-[38px]
                            hidden dark:bg-blue-950">
                        <p class="*:inline-block pLangOption min-w-32 hover:bg-blue-200
                                dark:hover:bg-blue-800 cursor-pointer">
                            <img src="images/usa-flag.png" class="dropdown-btn-lang rounded-full"
                                 width="20" height="20" alt="usa flag">
                            {{ __("modalSettings-set-5") }}</p>
                        <p class="*:inline-block pLangOption min-w-32 hover:bg-blue-200
                                dark:hover:bg-blue-800 cursor-pointer">
                            <img src="images/iran-flag.png" class="dropdown-btn-lang rounded-full"
                                 width="20" height="20" alt="iran flag">
                            {{ __("modalSettings-set-6") }}</p>
                    </div>
                </div>
                {{--       edit form send todo         --}}
                <form id="form-lang" action="{{ route("lang", App::getLocale() == "en" ? "englishBot" : "persianBot") }}"
                      method="get" enctype="multipart/form-data">
                    <label>
                        <input type="text" name="lang" value="{{ App::getLocale() == "en" ? "en" : "fa" }}"
                               class="hidden" id="input-lang">
                    </label>
                </form>
                <label class="text-sm sm:text-lg">
                        <span id="span-range">
                            @if(App::getLocale() == "en")
                                returns max 6 words :
                            @else
                                حداکثر 6 لغت برمی گرداند :
                            @endif
                        </span>
                    <input class="w-full" min="2" max="10" value="6" name="range" step="1"
                           id="range-return" type="range">
                </label>
            </div>
            <div class="flex-auto" dir="{{ App::getLocale() == 'en' ? "ltr" : "rtl" }}">
                <p class="pb-2 text-center text-sm sm:text-lg font-bold">{{ __("modalSettings-title-info") }}</p>
                <hr class="border-2 border-stone-600 rounded-full dark:border-stone-400">
                <p class="pt-2 text-sm sm:text-lg">{{ __("modalSettings-info-1") }}</p>
                <p class="text-sm sm:text-lg">{{ __("modalSettings-info-2") }}</p>
                <p class="text-sm sm:text-lg">{{ __("modalSettings-info-3") }}</p>
                <p class="text-sm sm:text-lg">{{ __("modalSettings-info-4") }}</p>
                <p class="text-sm sm:text-lg">{{ __("modalSettings-info-5") }}</p>
            </div>
        </div>
    </div>
</div>
