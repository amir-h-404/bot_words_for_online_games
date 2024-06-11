<div dir="{{ App::getLocale() == "en" ? "ltr" : "rtl" }}"
    {{ $attributes->merge(["class" => "text-center text-sm sm:text-lg font-bold rounded-2xl
bg-[rgba(168,162,158,0.6)] fixed bottom-2 right-2 p-1 sm:p-2 shadow-sm shadow-stone-800
dark:shadow-stone-200 dark:bg-[rgba(68,62,58,0.6)]"]) }} id="div-wait-time">
    <p class="pb-1">{{ __("info-jitter") }}</p>
    <hr class="border-stone-900 border dark:border-stone-500">
    @if(App::getLocale() == "en")
        <p class="pt-1"><span id="wait-time-span"></span> second(s)</p>
    @else
        <p class="pt-1"><span id="wait-time-span"></span> ثانیه</p>
    @endif
</div>
