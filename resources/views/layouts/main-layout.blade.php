<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("title")</title>
        {{--    CSS and Javascript :    --}}
        @vite(["resources/css/app.css", "resources/js/app.js"])
        {{--    IranSans font :    --}}
        <link rel="stylesheet" href="fonts/fontiran.css">
        {{--    Javascript type of theme - dark or light :    --}}
        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.theme === "dark" || (!("theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)) {
                document.documentElement.setAttribute("data-mode", "dark");
            } else {
                document.documentElement.removeAttribute("data-mode");
            }

            // change options of select tag :
            let typeTheme = "";
            if (localStorage.theme === "dark") {
                typeTheme = "dark";
            } else if (localStorage.theme === "light") {
                typeTheme = "light";
            } else if (!("theme" in localStorage)) {
                typeTheme = "os";
            }
        </script>
        {{--    favicon :    --}}
        <link rel="icon" href="images/favicon.ico">
    </head>
    @yield("body")
</html>
