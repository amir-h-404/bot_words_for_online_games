<div id="message-box" {{ $attributes->merge(["class" => "grid w-full translate-y-[-80px]
transition-all duration-500 fixed top-0 mt-4 p-1 justify-center items-center z-10"]) }}
dir="{{ App::getLocale() == "en" ? "ltr" : "rtl" }}">
    <p class="bg-yellow-200 inline-block p-3 text-lg rounded-2xl shadow-sm shadow-stone-900
    text-black font-bold dark:shadow-stone-500"></p>
</div>
