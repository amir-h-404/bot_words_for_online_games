<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class wordController extends Controller
{
    public function welcome(): RedirectResponse
    {
        $lang = "en";
        if (isset($_COOKIE["lang"]) and in_array($_COOKIE["lang"], ["en", "fa"]))
            $lang = $_COOKIE["lang"];
        if (!in_array($lang, ["en", "fa"])) abort(403);
        if ($lang == "fa") return redirect("/persianBot");
        else return redirect("/englishBot");
    }

    public function lang($id): View|RedirectResponse
    {
        $langUser = "";
        if (isset($_GET["lang"]) and !empty($_GET["lang"])) $langUser = $_GET["lang"];
        if (!empty($langUser)) {
            if (!in_array($langUser, ["en", "fa"])) abort(403);
            App::setLocale($langUser);
            setcookie("lang", $langUser, time() + (86400 * 30), "/");
            if ($langUser == "fa") return redirect("/persianBot");
            else return redirect("/englishBot");
        } else {
            if ($id == "persianBot") {
                App::setLocale("fa");
                setcookie("lang", "fa", time() + (86400 * 30), "/");
            } else if ($id == "englishBot") {
                App::setLocale("en");
                setcookie("lang", "en", time() + (86400 * 30), "/");
            } else abort(404);
            return view("welcome");
        }
    }

    public function words(): void
    {
        # inputs :
        $box1 = $box2 = $box3 = $box4 = $box5 = $box6 = $box7 = $box8 = $box9 = $box10 =
        $box11 = $box12 = $box13 = $box14 = $box15 = $box16 = $jsonInputs = "";
        # set arrays (words - patterns - results) :
        $bank_words = $arr_ptrWords = $sorted_results = $arrALL = array();
        $langType = "fa";
        $ptrType = "all";
        $numMax = 6;

        function checkData($data): string
        {
            $data = trim($data);
            $data = stripslashes($data);
            return htmlspecialchars($data);
        }

        function ptrReplacePersian($string, ...$inputs): string
        {
            $ptr = array("/a/", "/b/", "/c/", "/d/", "/e/", "/f/", "/g/",
                "/h/", "/n/", "/m/", "/x/", "/z/", "/i/", "/l/", "/p/", "/w/");
            if (count($inputs) == 16)
                for ($r = 0; $r < count($inputs); $r++)
                    $string = preg_replace($ptr[$r], $inputs[$r], $string);
            return $string;
        }

        function ptrReplaceEnglish($string, ...$inputs): string
        {
            $ptr = array("/ا/", "/ب/", "/پ/", "/ت/", "/ج/", "/چ/", "/ح/",
                "/خ/", "/د/", "/ذ/", "/ر/", "/ز/", "/ع/", "/غ/", "/ف/", "/ق/");
            if (count($inputs) == 16)
                for ($r = 0; $r < count($inputs); $r++)
                    $string = preg_replace($ptr[$r], $inputs[$r], $string);
            return $string;
        }

        # function score letters - 3 point :
        function char3pPer($c): bool
        {
            return match ($c) {
                "ض", "ذ", "ط", "ظ", "ژ", "غ", "چ", "ث", "ص", "ح" => true,
                default => false,
            };
        }

        # function score letters - 2 point :
        function char2pPer($c): bool
        {
            return match ($c) {
                "پ", "ق", "ف", "ک", "ش", "گ", "خ", "ز", "ج", "ع" => true,
                default => false,
            };
        }

        # function count score letters :
        function countPointsPersian($word): int
        {
            $point = 0;
            for ($w = 0; $w < mb_strlen($word); $w++) {
                $c = mb_substr($word, $w, 1);
                if (char3pPer($c)) $point += 3;
                elseif (char2pPer($c)) $point += 2;
                else $point += 1;
            }
            return $point;
        }

        function char3Eng($ch): bool
        {
            return match ($ch) {
                "x", "q", "z", "j", "k", "v", "w" => true,
                default => false
            };
        }

        function char2Eng($ch): bool
        {
            return match ($ch) {
                "y", "f", "b", "g", "u", "p", "d", "h", "c", "m" => true,
                default => false
            };
        }

        function countPointsEnglish($word): int
        {
            $point = 0;
            for ($w = 0; $w < strlen($word); $w++) {
                $ch = substr($word, $w, 1);
                if (char3Eng($ch)) $point += 3;
                else if (char2Eng($ch)) $point += 2;
                else $point += 1;
            }
            return $point;
        }

        # start access time :
        $startTimer = microtime(true);
        # get letters - associative array :
        if (isset($_POST["inputs"])) $jsonInputs = $_POST["inputs"];
        $arrayInputs = json_decode($jsonInputs, true);
        if (isset($arrayInputs) and is_array($arrayInputs)) {
            foreach ($arrayInputs as $value) {
                if (!is_string($value) or empty($value)) $arrALL[] = "";
                else $arrALL[] = checkData($value);
            }
            if (count($arrALL) == 16) {
                $box1 = $arrALL[0];
                $box2 = $arrALL[1];
                $box3 = $arrALL[2];
                $box4 = $arrALL[3];
                $box5 = $arrALL[4];
                $box6 = $arrALL[5];
                $box7 = $arrALL[6];
                $box8 = $arrALL[7];
                $box9 = $arrALL[8];
                $box10 = $arrALL[9];
                $box11 = $arrALL[10];
                $box12 = $arrALL[11];
                $box13 = $arrALL[12];
                $box14 = $arrALL[13];
                $box15 = $arrALL[14];
                $box16 = $arrALL[15];
            }
        }
        # get max number :
        if (isset($_POST["maxReturned"])) $numMax = checkData((int)$_POST["maxReturned"]);
        # get type of lang :
        if (isset($_POST["langBot"])) $langType = checkData($_POST["langBot"]);
        # set default error :
        $msgServer = $langType == "fa" ? "خطایی سمت سرور رخ داده است! لطفا دوباره تلاش کنید."
            : "An error occurred on the server! Please try again";
        # get type of ptr :
        if (isset($_POST["ptrType"])) $ptrType = checkData($_POST["ptrType"]);
        # check inputs not empty :
        if (empty($box1) or empty($box2) or empty($box3) or empty($box4) or empty($box5)
            or empty($box6) or empty($box7) or empty($box8) or empty($box9) or empty($box10)
            or empty($box11) or empty($box12) or empty($box13) or empty($box14) or
            empty($box15) or empty($box16))
            $msgServer = $langType == "fa" ? "لطفا همه خانه ها را پر کنید!"
                : "Please fill in all the fields!";
        else {
            # check inputs match with pattern (validate inputs) :
            $truePattern = $langType == "fa" ? "/^[ضصثقفغعهخحجچشسیبلاتنمکگپظطزرذدوژ]{1,2}$/"
                : "/^[a-z]$/";
            if (!preg_match($truePattern, $box1) or
                !preg_match($truePattern, $box2) or
                !preg_match($truePattern, $box3) or
                !preg_match($truePattern, $box4) or
                !preg_match($truePattern, $box5) or
                !preg_match($truePattern, $box6) or
                !preg_match($truePattern, $box7) or
                !preg_match($truePattern, $box8) or
                !preg_match($truePattern, $box9) or
                !preg_match($truePattern, $box10) or
                !preg_match($truePattern, $box11) or
                !preg_match($truePattern, $box12) or
                !preg_match($truePattern, $box13) or
                !preg_match($truePattern, $box14) or
                !preg_match($truePattern, $box15) or
                !preg_match($truePattern, $box16))
                $msgServer = $langType == "fa" ? "برخی یا همه خانه ها نامعتبر است!"
                    : "Some or all fields are invalid!";
            else {
                $fileDic = $langType == "fa" ? "files/persian.txt" : "files/english.txt";
                if (Storage::disk("local")->exists($fileDic) and
                    isset($_COOKIE["timeoutStorage"])) {
                    $file = Storage::disk("local")->get($fileDic);
                    $bank_words = explode("-", $file);
                } else {
                    if (file_exists($fileDic)) {
                        # open file :
                        $resWrd = @fopen($fileDic, "r");
                        if ($resWrd === false)
                            $msgServer = $langType == "fa" ? "سرور نمی تواند بانک لغات را بازکند!"
                                : "Server unable to open dictionary file!";
                        else {
                            # read file and get array of words :
                            $str_wrd = fread($resWrd, filesize($fileDic));
                            # set cookie for update file every month :
                            setcookie("timeoutStorage", "Amirhossein Emadi", time() + (86400 * 30), "/");
                            if ($str_wrd === false)
                                $msgServer = $langType == "fa" ? "سرور نمی تواند بانک لغات را بخواند!"
                                    : "Server unable to read dictionary file!";
                            else {
                                Storage::disk("local")->put($fileDic, $str_wrd);
                                $bank_words = explode("-", $str_wrd);
                            }
                        }
                        # close file :
                        fclose($resWrd);
                    } else $msgServer = $langType == "fa" ? "فایل دیکشنری یافت نشد!"
                        : "Dictionary file not found!";
                }
                $filePtr = $langType == "fa" ? "files/persianPatterns.txt"
                    : "files/englishPatterns.txt";
                if (Storage::disk("local")->exists($filePtr)) {
                    $file = Storage::disk("local")->get($filePtr);
                    $arr_ptrWords = explode("-", $file);
                    # create associative array for show pattern every word :
                    $arr_ptrWords = array_combine($arr_ptrWords, $arr_ptrWords);
                    # replace associative array with user inputs :
                    $arr_rep = array();
                    foreach ($arr_ptrWords as $key => $item) {
                        if ($langType == "fa")
                            $arr_rep[$key] = ptrReplacePersian($item, $box1, $box2, $box3, $box4,
                                $box5, $box6, $box7, $box8, $box9, $box10, $box11, $box12,
                                $box13, $box14, $box15, $box16);
                        else $arr_rep[$key] = ptrReplaceEnglish($item, $box1, $box2, $box3, $box4,
                            $box5, $box6, $box7, $box8, $box9, $box10, $box11, $box12,
                            $box13, $box14, $box15, $box16);
                    }
                    # delete repeated items from array :
                    $arr_rep = array_unique($arr_rep);
                    $arr_ptrWords = $arr_rep;
                } else {
                    if (file_exists($filePtr)) {
                        # open file :
                        $ptr_words = @fopen($filePtr, "r");
                        if ($ptr_words === false)
                            $msgServer = $langType == "fa" ? "سرور نمی تواند الگوی لغات را بازکند!"
                                : "Server unable to open patterns file!";
                        else {
                            # read file :
                            $str_ptr = fread($ptr_words, filesize($filePtr));
                            if ($str_ptr === false)
                                $msgServer = $langType == "fa" ? "سرور نمی تواند الگوی لغات را بخواند!"
                                    : "Server unable to read patterns file!";
                            else {
                                Storage::disk("local")->put($filePtr, $str_ptr);
                                $arr_ptrWords = explode("-", $str_ptr);
                            }
                            # create associative array for show pattern every word :
                            $arr_ptrWords = array_combine($arr_ptrWords, $arr_ptrWords);
                            # replace associative array with user inputs :
                            $arr_rep = array();
                            foreach ($arr_ptrWords as $key => $item) {
                                if ($langType == "fa")
                                    $arr_rep[$key] = ptrReplacePersian($item, $box1, $box2, $box3, $box4,
                                        $box5, $box6, $box7, $box8, $box9, $box10, $box11, $box12,
                                        $box13, $box14, $box15, $box16);
                                else $arr_rep[$key] = ptrReplaceEnglish($item, $box1, $box2, $box3, $box4,
                                    $box5, $box6, $box7, $box8, $box9, $box10, $box11, $box12,
                                    $box13, $box14, $box15, $box16);
                            }
                            # delete repeated items from array :
                            $arr_rep = array_unique($arr_rep);
                            $arr_ptrWords = $arr_rep;
                        }
                        # close file :
                        fclose($ptr_words);
                    } else $msgServer = $langType == "fa" ? "فایل الگوی لغات یافت نشد!"
                        : "Pattern of words file not found!";
                }
                if (!empty($bank_words) and !empty($arr_ptrWords)) {
                    # compare arrays -> patterns vs words :
                    $result_words = array_intersect($arr_ptrWords, $bank_words);
                    # category array with score -> 10^ > 9 > 8 > 7 > 6 > 5 > 4 > 3 :
                    $sort_3 = $sort_4 = $sort_5 = $sort_6 = $sort_7 = $sort_8 = $sort_9
                        = $sort_10_h = array();
                    foreach ($result_words as $key => $word) {
                        # calculate score :
                        if ($langType == "fa") $point_wrd = countPointsPersian($word);
                        else $point_wrd = countPointsEnglish($word);
                        if ($ptrType !== "all") {
                            if (str_contains($key, $ptrType))
                                $wordSC = array("pattern" => $key, "word" => $word,
                                    "score" => $point_wrd);
                            else continue;
                        } else $wordSC = array("pattern" => $key, "word" => $word,
                            "score" => $point_wrd);
                        if ($point_wrd == 3) $sort_3[] = $wordSC;
                        else if ($point_wrd == 4) $sort_4[] = $wordSC;
                        else if ($point_wrd == 5) $sort_5[] = $wordSC;
                        else if ($point_wrd == 6) $sort_6[] = $wordSC;
                        else if ($point_wrd == 7) $sort_7[] = $wordSC;
                        else if ($point_wrd == 8) $sort_8[] = $wordSC;
                        else if ($point_wrd == 9) $sort_9[] = $wordSC;
                        else $sort_10_h[] = $wordSC;
                    }
                    $resultArrWords = array_merge($sort_10_h, $sort_9, $sort_8, $sort_7, $sort_6,
                        $sort_5, $sort_4, $sort_3);
                    # check empty or not :
                    if (empty($resultArrWords))
                        $msgServer = $langType == "fa" ? "لغت بامعنی یافت نشد!"
                            : "Meaningful word not found!";
                    else {
                        $msgServer = "ok";
                        # limited result :
                        if (count($resultArrWords) <= $numMax)
                            $sorted_results["words"] = $resultArrWords;
                        else {
                            $arrLocal = [];
                            for ($i = 0; $i < $numMax; $i++) $arrLocal[] = $resultArrWords[$i];
                            $sorted_results["words"] = $arrLocal;
                        }
                    }
                }
            }
        }
        # end access time :
        $endTimer = microtime(true);
        # return output - json :
        $sorted_results["message"] = $msgServer;
        $sorted_results["lang"] = $langType;
        $sorted_results["timeout"] = round($endTimer - $startTimer, 1);
        $res = new Response();
        $res->header("Content-Type", "application/json");
        $res->setContent(json_encode($sorted_results));
        $res->setStatusCode(200);
        $res->send();
    }
}
