import './bootstrap';

// define variables :
const modalSettings = document.getElementById("modal-settings"),
    spanRange = document.getElementById("span-range"),
    rangeReturn = document.getElementById("range-return"),
    btnMode = document.getElementById("btn-theme"),
    inputLang = document.getElementById("input-lang"),
    pThemeOptions = document.getElementsByClassName("pThemeOption"),
    btnLang = document.getElementById("btn-lang"),
    inputPtr = document.getElementById("input-ptr"),
    messageBox = document.getElementById("message-box"),
    btnSearch = document.getElementById("btn-search"),
    resultPaper = document.getElementById("result-paper"),
    formSearch = document.getElementById("form-search"),
    btnPtr = document.getElementById("btn-patterns"),
    divPtr = document.getElementById("dropdown-ptr"),
    modalLoading = document.getElementById("modal-loading"),
    formLang = document.getElementById("form-lang"),
    boxLetters = document.getElementsByClassName("boxLetters"),
    pPatternsType = document.getElementsByClassName("pPatternsType"),
    pLangOptions = document.getElementsByClassName("pLangOption");

// close modals and dropdowns when click outside :
window.onclick = function (event) {
    // modals :
    if (event.target === modalSettings) {
        modalSettings.classList.toggle("hidden");
    }
    // dropdowns :
    if (!event.target.matches(".dropdown-btn-theme")) {
        const dropdown = document.getElementById("dropdown-theme");
        if (!dropdown.classList.contains("hidden")) {
            dropdown.classList.toggle("hidden");
        }
    }
    if (!event.target.matches(".dropdown-btn-lang")) {
        const dropdown = document.getElementById("dropdown-lang");
        if (!dropdown.classList.contains("hidden")) {
            dropdown.classList.toggle("hidden");
        }
    }
    // dropdown choose ptr :
    if (!event.target.matches(".dropdown-btn-ptr")) {
        if (!divPtr.classList.contains("hidden")) {
            divPtr.classList.toggle("hidden");
            divPtr.classList.toggle("flex");
        }
    }
};

// close modal settings when click on close button :
document.getElementById("modal-btnClose").onclick = function () {
    modalSettings.classList.toggle("hidden");
};

// open modal settings when click on the settings button :
document.getElementById("btn-settings").addEventListener
("click", function () {
    modalSettings.classList.toggle("hidden");
});

// print range of returned number :
rangeReturn.addEventListener("change", function () {
    let text = spanRange.innerHTML,
        valueRange = rangeReturn.value;
    if (text.includes("returns")) {
        spanRange.innerHTML = "returns max " + valueRange + " words :";
    } else {
        spanRange.innerHTML = "حداکثر " + valueRange + " لغت برمی گرداند :";
    }
});

// change theme with change on button :
for (let p = 0; p < pThemeOptions.length; p++) {
    pThemeOptions[p].addEventListener("click", function () {
        btnMode.innerHTML = pThemeOptions[p].innerHTML;
        if (p === 0) {
            localStorage.theme = "dark";
            document.documentElement.setAttribute("data-mode", "dark");
        } else if (p === 1) {
            localStorage.theme = "light";
            document.documentElement.removeAttribute("data-mode");
        } else {
            localStorage.removeItem("theme");
            if ((!("theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)) {
                document.documentElement.setAttribute("data-mode", "dark");
            } else {
                document.documentElement.removeAttribute("data-mode");
            }
        }
    });
    // set default type of theme inside button :
    if (p === 2) {
        if (typeTheme === "dark") {
            btnMode.innerHTML = pThemeOptions[0].innerHTML;
        } else if (typeTheme === "light") {
            btnMode.innerHTML = pThemeOptions[1].innerHTML;
        } else {
            btnMode.innerHTML = pThemeOptions[2].innerHTML;
        }
    }
}

// open dropdown theme :
btnMode.addEventListener("click", function () {
    document.getElementById("dropdown-theme").classList.toggle("hidden");
});

// open dropdown lang :
btnLang.addEventListener("click", function () {
    document.getElementById("dropdown-lang").classList.toggle("hidden");
});

// change lang with change on button :
for (let p = 0; p < pLangOptions.length; p++) {
    pLangOptions[p].addEventListener("click", function () {
        btnLang.innerHTML = pLangOptions[p].innerHTML;
        if (p === 0) {
            inputLang.value = "en";
        } else if (p === 1) {
            inputLang.value = "fa";
        }
        formLang.submit();
    });
    // set default type of lang inside button :
    if (p === 1) {
        let valueP = inputLang.value;
        if (valueP === "en") {
            btnLang.innerHTML = pLangOptions[0].innerHTML;
        } else {
            btnLang.innerHTML = pLangOptions[1].innerHTML;
        }
    }
}

// choose p of patterns :
for (let p = 0; p < pPatternsType.length; p++) {
    pPatternsType[p].addEventListener("click", function () {
        let valueOfP = pPatternsType[p].innerHTML;
        let btnContent = btnPtr.innerHTML;
        btnPtr.innerHTML = "";
        if (btnContent.includes("with")) {
            btnPtr.innerHTML = btnPtr.innerHTML + " with " + valueOfP;
            switch (p) {
                case 0:
                    inputPtr.value = "all";
                    break;
                case 1:
                    inputPtr.value = "ا";
                    break;
                case 2:
                    inputPtr.value = "ب";
                    break;
                case 3:
                    inputPtr.value = "پ";
                    break;
                case 4:
                    inputPtr.value = "ت";
                    break;
                case 5:
                    inputPtr.value = "ج";
                    break;
                case 6:
                    inputPtr.value = "چ";
                    break;
                case 7:
                    inputPtr.value = "ح";
                    break;
                case 8:
                    inputPtr.value = "خ";
                    break;
                case 9:
                    inputPtr.value = "د";
                    break;
                case 10:
                    inputPtr.value = "ذ";
                    break;
                case 11:
                    inputPtr.value = "ر";
                    break;
                case 12:
                    inputPtr.value = "ز";
                    break;
                case 13:
                    inputPtr.value = "ع";
                    break;
                case 14:
                    inputPtr.value = "غ";
                    break;
                case 15:
                    inputPtr.value = "ف";
                    break;
                case 16:
                    inputPtr.value = "ق";
                    break;
            }
        } else {
            btnPtr.innerHTML = btnPtr.innerHTML + " با " + valueOfP;
            switch (p) {
                case 0:
                    inputPtr.value = "all";
                    break;
                case 1:
                    inputPtr.value = "a";
                    break;
                case 2:
                    inputPtr.value = "b";
                    break;
                case 3:
                    inputPtr.value = "c";
                    break;
                case 4:
                    inputPtr.value = "d";
                    break;
                case 5:
                    inputPtr.value = "e";
                    break;
                case 6:
                    inputPtr.value = "f";
                    break;
                case 7:
                    inputPtr.value = "g";
                    break;
                case 8:
                    inputPtr.value = "h";
                    break;
                case 9:
                    inputPtr.value = "n";
                    break;
                case 10:
                    inputPtr.value = "m";
                    break;
                case 11:
                    inputPtr.value = "x";
                    break;
                case 12:
                    inputPtr.value = "z";
                    break;
                case 13:
                    inputPtr.value = "i";
                    break;
                case 14:
                    inputPtr.value = "l";
                    break;
                case 15:
                    inputPtr.value = "p";
                    break;
                case 16:
                    inputPtr.value = "w";
                    break;
            }
        }
        divPtr.classList.toggle("hidden");
        divPtr.classList.toggle("flex");
    });
}

// open ptn patterns with click on button ptr :
btnPtr.addEventListener("click", function () {
    divPtr.classList.toggle("hidden");
    divPtr.classList.toggle("flex");
});

// function clear all color fields and badges :
function clearFields(type) {
    for (let f = 0; f < boxLetters.length; f++) {
        boxLetters[f].classList.add("bg-[rgb(255,255,224)]");
        boxLetters[f].classList.add("dark:bg-[rgb(38,0,51)]");
        boxLetters[f].classList.remove("bg-green-200");
        boxLetters[f].classList.remove("dark:bg-[rgb(48,48,48)]");
        boxLetters[f].nextElementSibling.classList.remove("bg-green-300");
        boxLetters[f].nextElementSibling.classList.remove("dark:bg-[rgb(85,85,85)]");
        boxLetters[f].nextElementSibling.classList.add("bg-[rgb(248,131,121)]");
        boxLetters[f].nextElementSibling.classList.add("dark:bg-[rgb(20,0,51)]");
        if (type === "pattern") {
            boxLetters[f].nextElementSibling.classList.add("hidden");
        } else {
            boxLetters[f].nextElementSibling.classList.remove("hidden");
            boxLetters[f].nextElementSibling.innerHTML = f + 1 + "";
        }
    }
}

// function change color of fields and show pattern :
function showColorFields(numField, counter) {
    document.querySelector("[name=box" + numField + "]").classList.remove("bg-[rgb(255,255,224)]");
    document.querySelector("[name=box" + numField + "]").classList.remove("dark:bg-[rgb(38,0,51)]");
    document.querySelector("[name=box" + numField + "]").classList.add("bg-green-200");
    document.querySelector("[name=box" + numField + "]").classList.add("dark:bg-[rgb(48,48,48)]");
    document.querySelector("[name=box" + numField + "]").nextElementSibling.classList.remove("hidden");
    document.querySelector("[name=box" + numField + "]").nextElementSibling.classList.remove("bg-[rgb(248,131,121)]");
    document.querySelector("[name=box" + numField + "]").nextElementSibling.classList.remove("dark:bg-[rgb(20,0,51)]");
    document.querySelector("[name=box" + numField + "]").nextElementSibling.classList.add("bg-green-300");
    document.querySelector("[name=box" + numField + "]").nextElementSibling.classList.add("dark:bg-[rgb(85,85,85)]");
    document.querySelector("[name=box" + numField + "]").nextElementSibling.innerHTML = counter + 1 + "";
}

// send form to search with AJAX :
formSearch.addEventListener("submit", function (event) {
    // disable default event for form :
    event.preventDefault();
    // send data :
    const formData = new FormData(formSearch),
        http = new XMLHttpRequest(),
        arr = {};
    let counter = 0;
    for (const key of formData.keys()) {
        if (key.includes("box")) {
            arr[counter] = formData.get(key);
            counter++;
        }
    }
    // convert Javascript dictionary to JSON string :
    const jsonArr = JSON.stringify(arr);
    formData.append("inputs", jsonArr);
    formData.append("maxReturned", rangeReturn.value);
    http.open(formSearch.method, formSearch.action);
    http.onreadystatechange = function () {
        // check status good and get output :
        if (this.status === 200 && this.readyState === 4) {
            // get output :
            let output = JSON.parse(this.responseText),
                message = output["message"];
            if (message === "ok") {
                btnSearch.removeAttribute("disabled");
                resultPaper.classList.add("flex");
                resultPaper.classList.remove("hidden");
                resultPaper.innerHTML = "";
                let wordsList = output["words"],
                    lang = output["lang"];
                for (let w = 0; w < wordsList.length; w++) {
                    let word = wordsList[w]["word"],
                        score = wordsList[w]["score"],
                        pattern = wordsList[w]["pattern"];
                    // create word card :
                    const div = document.createElement("div"),
                        pTitle = document.createElement("p"),
                        hr = document.createElement("hr"),
                        pContent = document.createElement("p");
                    div.setAttribute("class", "text-sm sm:text-lg text-center bg-blue-200 px-2 " +
                        "py-1 rounded-lg shadow-stone-800 dark:shadow-stone-200 shadow-sm cursor-pointer w-[100px] sm:h-[80px] " +
                        "hover:bg-blue-300 dark:hover:bg-[rgb(70,0,0)] dark:bg-[rgb(50,0,0)]");
                    pTitle.setAttribute("class", "pb-1 font-bold");
                    hr.setAttribute("class", "border border-dashed border-blue-800 dark:border-blue-200");
                    pContent.setAttribute("class", "pt-1");
                    pTitle.innerHTML = word;
                    div.appendChild(pTitle);
                    div.appendChild(hr);
                    div.appendChild(pContent);
                    div.addEventListener("click", function () {
                        // remove all colors before :
                        clearFields("pattern");
                        for (let p = 0; p < pattern.length; p++) {
                            let sub = pattern.substring(p, p + 1);
                            if (lang === "fa") {
                                switch (sub) {
                                    case "a":
                                        showColorFields(1, p);
                                        break;
                                    case "b":
                                        showColorFields(2, p);
                                        break;
                                    case "c":
                                        showColorFields(3, p);
                                        break;
                                    case "d":
                                        showColorFields(4, p);
                                        break;
                                    case "e":
                                        showColorFields(5, p);
                                        break;
                                    case "f":
                                        showColorFields(6, p);
                                        break;
                                    case "g":
                                        showColorFields(7, p);
                                        break;
                                    case "h":
                                        showColorFields(8, p);
                                        break;
                                    case "n":
                                        showColorFields(9, p);
                                        break;
                                    case "m":
                                        showColorFields(10, p);
                                        break;
                                    case "x":
                                        showColorFields(11, p);
                                        break;
                                    case "z":
                                        showColorFields(12, p);
                                        break;
                                    case "i":
                                        showColorFields(13, p);
                                        break;
                                    case "l":
                                        showColorFields(14, p);
                                        break;
                                    case "p":
                                        showColorFields(15, p);
                                        break;
                                    case "w":
                                        showColorFields(16, p);
                                        break;
                                }
                            } else {
                                switch (sub) {
                                    case "ا":
                                        showColorFields(1, p);
                                        break;
                                    case "ب":
                                        showColorFields(2, p);
                                        break;
                                    case "پ":
                                        showColorFields(3, p);
                                        break;
                                    case "ت":
                                        showColorFields(4, p);
                                        break;
                                    case "ج":
                                        showColorFields(5, p);
                                        break;
                                    case "چ":
                                        showColorFields(6, p);
                                        break;
                                    case "ح":
                                        showColorFields(7, p);
                                        break;
                                    case "خ":
                                        showColorFields(8, p);
                                        break;
                                    case "د":
                                        showColorFields(9, p);
                                        break;
                                    case "ذ":
                                        showColorFields(10, p);
                                        break;
                                    case "ر":
                                        showColorFields(11, p);
                                        break;
                                    case "ز":
                                        showColorFields(12, p);
                                        break;
                                    case "ع":
                                        showColorFields(13, p);
                                        break;
                                    case "غ":
                                        showColorFields(14, p);
                                        break;
                                    case "ف":
                                        showColorFields(15, p);
                                        break;
                                    case "ق":
                                        showColorFields(16, p);
                                        break;
                                }
                            }
                        }
                    });
                    resultPaper.appendChild(div);
                    if (lang === "fa") {
                        pContent.setAttribute("dir", "rtl");
                        pContent.innerHTML = score + " امتیاز";
                    } else {
                        pContent.setAttribute("dir", "ltr");
                        pContent.innerHTML = score + " points";
                    }
                }
                // get timeout from server :
                document.getElementById("div-wait-time").classList.remove("hidden");
                document.getElementById("wait-time-span").innerHTML = output["timeout"];
                setTimeout(function () {
                    document.getElementById("div-wait-time").classList.add("hidden");
                }, 3000);
            } else {
                // animation and show message alert :
                messageBox.classList.remove("translate-y-[-80px]");
                messageBox.firstElementChild.innerHTML = message;
                // hide message alert after 3 seconds :
                setTimeout(function () {
                    messageBox.classList.add("translate-y-[-80px]");
                    btnSearch.removeAttribute("disabled");
                }, 3000);
            }
        }
    };
    http.onloadend = function () {
        // enable search alert when search is finished :
        modalLoading.classList.toggle("hidden");
    };
    http.onloadstart = function () {
        // clear color of fields and badges :
        clearFields("search");
        // hide result div :
        resultPaper.classList.add("hidden");
        resultPaper.classList.remove("flex");
        // start search alert and disable search btn :
        modalLoading.classList.toggle("hidden");
        btnSearch.setAttribute("disabled", null);
    };
    http.onabort = function () {
        // animation and show message alert :
        messageBox.classList.remove("translate-y-[-80px]");
        if (inputLang.value === "fa") {
            messageBox.firstElementChild.innerHTML = "جستجو با خطا مواجه شد! دوباره امتحان کنید";
        } else {
            messageBox.firstElementChild.innerHTML = "The search encountered an error! Please try again";
        }
        // hide message alert after 3 seconds :
        setTimeout(function () {
            messageBox.classList.add("translate-y-[-80px]");
            btnSearch.removeAttribute("disabled");
        }, 3000);
    };
    http.onerror = function () {
        // animation and show message alert :
        messageBox.classList.remove("translate-y-[-80px]");
        if (inputLang.value === "fa") {
            messageBox.firstElementChild.innerHTML = "خطا در اتصال به سرور! اتصال به اینترنت را بررسی کنید";
        } else {
            messageBox.firstElementChild.innerHTML = "Error connecting to the server! Check your internet connection";
        }
        // hide message alert after 3 seconds :
        setTimeout(function () {
            messageBox.classList.add("translate-y-[-80px]");
            btnSearch.removeAttribute("disabled");
        }, 3000);
    };
    http.ontimeout = function () {
        // animation and show message alert :
        messageBox.classList.remove("translate-y-[-80px]");
        if (inputLang.value === "fa") {
            messageBox.firstElementChild.innerHTML = "جستجو زیاد طول کشید! دوباره امتحان کنید";
        } else {
            messageBox.firstElementChild.innerHTML = "The search took too long! Please try again";
        }
        // hide message alert after 3 seconds :
        setTimeout(function () {
            messageBox.classList.add("translate-y-[-80px]");
            btnSearch.removeAttribute("disabled");
        }, 3000);
    };
    http.send(formData);
});

// functions to check letters :

function checkPersianLetters(ch) {
    switch (ch) {
        case "ض":
        case "ص":
        case "ث":
        case "ق":
        case "ف":
        case "غ":
        case "ع":
        case "ه":
        case "خ":
        case "ح":
        case "ج":
        case "چ":
        case "ش":
        case "س":
        case "ی":
        case "ب":
        case "ل":
        case "ا":
        case "ت":
        case "ن":
        case "م":
        case "ک":
        case "گ":
        case "پ":
        case "ظ":
        case "ط":
        case "ز":
        case "ژ":
        case "ر":
        case "ذ":
        case "د":
        case "و":
            return true;
        default:
            return false;
    }
}

function checkEnglishLetters(ch) {
    switch (ch) {
        case "q":
        case "w":
        case "e":
        case "r":
        case "t":
        case "y":
        case "u":
        case "i":
        case "o":
        case "p":
        case "a":
        case "s":
        case "d":
        case "f":
        case "g":
        case "h":
        case "j":
        case "k":
        case "l":
        case "z":
        case "x":
        case "c":
        case "v":
        case "b":
        case "n":
        case "m":
            return true;
        default:
            return false;
    }
}

function checkLetters(data) {
    if (data.length !== 1) {
        return "";
    } else {
        if (!checkEnglishLetters(data) && !checkPersianLetters(data)) {
            return "";
        } else {
            return data + "";
        }
    }
}

// validate value of inputs :
for (let box = 0; box < boxLetters.length; box++) {
    boxLetters[box].addEventListener("input", function () {
        let valBox = boxLetters[box].value;
        boxLetters[box].value = checkLetters(valBox);
        // move between inputs when typing :
        if (box === 15) {
            boxLetters[box].blur();
        } else {
            boxLetters[box + 1].focus();
        }
    });
    // select text of box auto :
    boxLetters[box].addEventListener("focus", function () {
        this.setSelectionRange(0, 1);
    });
}
