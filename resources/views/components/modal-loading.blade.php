<div id="modal-loading" {{ $attributes->merge(["class" => "fixed z-50 left-0 top-0 w-full
h-full bg-black/70"]) }}>
    <div dir="{{ App::getLocale() == "en" ? "ltr" : "rtl" }}"
         class="relative top-[15%] max-h-[60%] m-auto w-[60%] bg-white dark:bg-stone-900 p-1 sm:p-3 shadow-sm
         shadow-stone-800 dark:shadow-stone-200 rounded-lg animateTop flex items-center justify-center
         gap-2 flex-wrap">
        <span class="loading loading-infinity loading-lg"></span>
        <p class="sm:text-lg text-sm font-bold">{{ __("message-loading") }}</p>
        <span class="text-2xl">&#128522;</span>
    </div>
</div>
