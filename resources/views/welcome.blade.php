@extends("layouts.main-layout")
@section("title")
    {{ App::getLocale() == "en" ? "Word Finder BOT - The bot finds words for you in online word games"
: "ربات لغت یاب - ربات ، لغات را برای شما در بازی های آنلاین واژگان پیدا می کند" }}
@endsection
@section("body")
    <body class="{{ App::getLocale() == "en" ? "tracking-wide" : "" }}
    bg-blue-50 text-black dark:text-white dark:bg-stone-900 min-h-full persian-font">
        {{--  div main bot :  --}}
        <div class="flex flex-row flex-wrap pt-4 justify-center min-h-full">
            {{--    inputs and buttons - search form :   --}}
            <form method="post" action="{{ route("words", App::getLocale() == "en" ? "englishBot" : "persianBot") }}"
                  class="grid gap-1 *:gap-2" id="form-search" enctype="multipart/form-data">
                @csrf
                {{--    input boxes :    --}}
                <x-boxes-of-letter/>
                {{--   manage buttons :   --}}
                <div class="flex justify-between items-start flex-row flex-wrap">
                    {{--   search button with ptr :   --}}
                    <x-search-button-with-ptr/>
                    {{--    settings button :     --}}
                    <x-settings-button/>
                </div>
                {{--   input send choice ptr :   --}}
                <label>
                    <input type="text" name="ptrType" value="all" class="hidden" id="input-ptr">
                </label>
                {{--   input send type of lang :   --}}
                <label>
                    <input type="text" name="langBot"
                           value="{{ App::getLocale() == "en" ? "en" : "fa" }}" class="hidden">
                </label>
            </form>
            {{--    show results :    --}}
            <div id="result-paper" class="flex-wrap flex-row gap-3 justify-center items-start
            px-1 pb-2 lg:w-[400px] hidden self-start"></div>
        </div>
        {{--    message alert :    --}}
        <x-message-alert/>
        {{--  waiting time alert :  --}}
        <x-waiting-time class="hidden" />
        {{--  modal settings :  --}}
        <x-modal-settings/>
        {{--   modal loading :  --}}
        <x-modal-loading class="hidden" />
    </body>
@endsection
