@php
    $counter = 1;
@endphp
@for($x = 0; $x < 4; $x++)
    <div class="grid grid-cols-4">
        @for($y = 0; $y < 4; $y++)
            <label class="relative p-1">
                <input type="text" autocomplete="off" name="{{ "box" . $counter }}"
                       class="boxLetters sm:w-[80px] sm:h-[80px] w-[60px] h-[60px]
           input bg-[rgb(255,255,224)] dark:bg-[rgb(38,0,51)] text-center text-lg sm:text-3xl
           shadow-sm shadow-stone-800 dark:shadow-stone-200 focus:outline-stone-500">
                <span class="absolute bg-[rgb(248,131,121)] dark:bg-[rgb(20,0,51)] shadow-sm shadow-stone-800
                text-sm sm:text-lg dark:shadow-stone-200 font-bold left-[-3px] top-[-3px]
                px-1 sm:px-2 rounded-full sm:h-[24px]">{{ $counter }}</span>
            </label>
            @php
                $counter++;
            @endphp
        @endfor
    </div>
@endfor
