<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 // Route::get('/', function () {
 //    return view('welcome');
 // });
// Route::get('/', 'ShareController@welcome');
//Route::get('/', 'HomeController@index');



Route::get('/','english\HomeController_englishApp@index')->name('home');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home','english\HomeController_englishApp@index')->name('home');

Route::get('/privacy-policy', 'HomeController@privacy_and_policy')->name('privacy_and_policy');
Route::get('/terms-of-service', 'HomeController@Terms_of_Service')->name('Terms_of_Service');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/About-us', 'HomeController@About_us')->name('About_us');

Route::group(['prefix'=>'en','namespace'=>'english'], function(){
          Route::get('/','HomeController_englishApp@index')->name('home');
        //  Route::get('/defult_app_en','HomeController_englishApp@defult_app_en');
          Route::get('/get_englishapp_data','HomeController_englishApp@getallapps');
          //app1
          Route::get('/What-will-God-bless-you-with','AppCreateController_en@en_app1');
          Route::get('/en_app1_createimg','AppCreateController_en@en_app1_createimg');
          //app2
          Route::get('/Which-Skills-did-God-gave-you','AppCreateController_en@en_app2');
          Route::get('/en_app2_createimg','AppCreateController_en@en_app2_createimg');
          //app3
          Route::get('/How-Rich-will-you-be-in-7-years','AppCreateController_en@en_app3');
          Route::post('/en_app3_createimg','AppCreateController_en@en_app3_createimg');
          //app4
          Route::get('/How-will-your-body-change-in-2018','AppCreateController_en@en_app4');
          Route::get('/en_app4_createimg','AppCreateController_en@en_app4_createimg');
          //app5
          Route::get('/What-is-the-first-thing-people-notice-about-you','AppCreateController_en@en_app5');
          Route::get('/en_app5_createimg','AppCreateController_en@en_app5_createimg');

          //app6
          Route::get('/Create-Personalized-NEW-YEAR-Card','AppCreateController_en@en_app6');
          Route::get('/en_app6_createimg','AppCreateController_en@en_app6_createimg');

          //app7::get('/What-Awaits-You-From-2018-to-2020','AppCreateController_en@en_app7');
          Route::get('/en_app7_createimg','AppCreateController_en@en_app7_createimg');

          //app8
          Route::get('/Which-Phrase-Best-Describes-Your-Life','AppCreateController_en@en_app8');
          Route::get('/en_app8_createimg','AppCreateController_en@en_app8_createimg');

          //app9
          Route::get('/Which-Word-Summarise-Your-Life','AppCreateController_en@en_app9');
          Route::get('/en_app9_createimg','AppCreateController_en@en_app9_createimg');

          //app10
          Route::get('/What-Does-Your-Warning-Label-Say','AppCreateController_en@en_app10');
          Route::get('/en_app10_createimg','AppCreateController_en@en_app10_createimg');

          //app11
          Route::get('/How-Fake-Are-You','AppCreateController_en@en_app11');
          Route::get('/en_app11_createimg','AppCreateController_en@en_app11_createimg');

          //app12
          Route::get('/What-Is-Your-Message-To-The-World','AppCreateController_en@en_app12');
          Route::get('/en_app12_createimg','AppCreateController_en@en_app12_createimg');


          //app13
          Route::get('/Whats-The-One-Thing-You-Regret-Losing','AppCreateController_en@en_app13');
          Route::get('/en_app13_createimg','AppCreateController_en@en_app13_createimg');

          //app14
          Route::get('/What-Does-Your-Profile-Photo-NOT-Reveal-About-Your-Personality','AppCreateController_en@en_app14');
          Route::get('/en_app14_createimg','AppCreateController_en@en_app14_createimg');

          //app15
          Route::get('/Which-Word-Reflects-Your-Love-Life','AppCreateController_en@en_app15');
          Route::get('/en_app15_createimg','AppCreateController_en@en_app15_createimg');

          //app16
          Route::get('/What-Strength-Has-God-Blessed-You-With','AppCreateController_en@en_app16');
          Route::get('/en_app16_createimg','AppCreateController_en@en_app16_createimg');

          //app17
          Route::get('/What-Compliment-You-Are-Tired-Of','AppCreateController_en@en_app17');
          Route::get('/en_app17_createimg','AppCreateController_en@en_app17_createimg');

          //app18
          Route::get('/Create-Diwali-Greeting-and-Send-Your-Loved','AppCreateController_en@en_app18');
          Route::get('/en_app18_createimg','AppCreateController_en@en_app18_createimg');

          //app19
          Route::get('/Which-Rock-Band-Do-You-Belong-To','AppCreateController_en@en_app19');
          Route::get('/en_app19_createimg','AppCreateController_en@en_app19_createimg');

          //app20
          Route::get('/What-Are-Three-Truths-About-You','AppCreateController_en@en_app20');
          Route::get('/en_app20_createimg','AppCreateController_en@en_app20_createimg');

          //app21
          Route::get('/At-What-Age-Will-You-Get-Married','AppCreateController_en@en_app21');
          Route::get('/en_app21_createimg','AppCreateController_en@en_app21_createimg');

          //app22
          Route::get('/How-Would-Your-Indian-Army-ID-Card-Look-Like','AppCreateController_en@en_app22');
          Route::get('/en_app22_createimg','AppCreateController_en@en_app22_createimg');

          //app23
          Route::get('/Who-Are-You-When-You-Get-Mad','AppCreateController_en@en_app23');
          Route::get('/en_app23_createimg','AppCreateController_en@en_app23_createimg');

          //app24
          Route::get('/What-Can-Be-The-Smartest-Decision-Of-Your-Life','AppCreateController_en@en_app24');
          Route::get('/en_app24_createimg','AppCreateController_en@en_app24_createimg');

          //app25
          Route::get('/five-Facts-About-You','AppCreateController_en@en_app25');
          Route::get('/en_app25_createimg','AppCreateController_en@en_app25_createimg');

          //app26
          Route::get('/You-are-You-Coz','AppCreateController_en@en_app26');
          Route::get('/en_app26_createimg','AppCreateController_en@en_app26_createimg');

          //app27
          Route::get('/How-Awesome-Are-You','AppCreateController_en@en_app27');
          Route::get('/en_app27_createimg','AppCreateController_en@en_app27_createimg');

          //app28
          Route::get('/What-Does-Your-Love-First-Aid-Box-Contain','AppCreateController_en@en_app28');
          Route::get('/en_app28_createimg','AppCreateController_en@en_app28_createimg');

          //app29
          Route::get('/Which-Celebrity-Would-You-Date','AppCreateController_en@en_app29');
          Route::get('/en_app29_createimg','AppCreateController_en@en_app29_createimg');

          //app30
          Route::get('/What-Is-The-Color-Of-Your-Heart','AppCreateController_en@en_app30');
          Route::get('/en_app30_createimg','AppCreateController_en@en_app30_createimg');

          //app31
          Route::get('/Which-Halloween-Creature-Are-You','AppCreateController_en@en_app31');
          Route::get('/en_app31_createimg','AppCreateController_en@en_app31_createimg');

          //app32
          Route::get('/What-Do-Your-Eyes-Reveal-About-You','AppCreateController_en@en_app32');
          Route::get('/en_app32_createimg','AppCreateController_en@en_app32_createimg');

          //app33
          Route::get('/Which-Rapper-Wants-to-Train-You','AppCreateController_en@en_app33');
          Route::get('/en_app33_createimg','AppCreateController_en@en_app33_createimg');

          //app34
          Route::get('/Which-Half-human-Are-You-Based-On-Your-Photo','AppCreateController_en@en_app34');
          Route::get('/en_app34_createimg','AppCreateController_en@en_app34_createimg');

          //app35
          Route::get('/Which-Different-Combinations-of-Hogwarts-and-Ilvermorny-Houses-Are-You','AppCreateController_en@en_app35');
          Route::get('/en_app35_createimg','AppCreateController_en@en_app35_createimg');

          //app36
          Route::get('/How-Hot-Are-You','AppCreateController_en@en_app36');
          Route::get('/en_app36_createimg','AppCreateController_en@en_app36_createimg');

          //app37
          Route::get('/How-Mean-Are-You','AppCreateController_en@en_app37');
          Route::get('/en_app37_createimg','AppCreateController_en@en_app37_createimg');

          //app38
          Route::get('/What-Is-The-Key-To-Your-Happiness','AppCreateController_en@en_app38');
          Route::get('/en_app38_createimg','AppCreateController_en@en_app38_createimg');

          //app39
          Route::get('/What-is-your-inspiring-Bible-verse','AppCreateController_en@en_app39');
          Route::get('/en_app39_createimg','AppCreateController_en@en_app39_createimg');

          //app40
          Route::get('/How-Old-Are-You-Based-On-Your-Photo','AppCreateController_en@en_app40');
          Route::get('/en_app40_createimg','AppCreateController_en@en_app40_createimg');

          //app41
          Route::get('/How-Would-Be-Your-Next-Boyfriend-Girlfriend','AppCreateController_en@en_app41');
          Route::get('/en_app41_createimg','AppCreateController_en@en_app41_createimg');

          //app42
          Route::get('/What-Are-Your-Wolf-Instincts','AppCreateController_en@en_app42');
          Route::get('/en_app42_createimg','AppCreateController_en@en_app42_createimg');

          //app43
          Route::get('/Can-We-Guess-If-2018-Will-Be-Better-Than-2017-For-You','AppCreateController_en@en_app43');
          Route::get('/en_app43_createimg','AppCreateController_en@en_app43_createimg');

          //app44
          Route::get('/How-Much-Do-You-Love-Him-Her','AppCreateController_en@en_app44');
          Route::get('/en_app44_createimg','AppCreateController_en@en_app44_createimg');

          //app45
          Route::get('/Can-We-Guess-Your-Future-By-Your-Picture','AppCreateController_en@en_app45');
          Route::get('/en_app45_createimg','AppCreateController_en@en_app45_createimg');

          //app46
          Route::get('/How-Would-Your-Future-House-Car-and-Love-Look-Like','AppCreateController_en@en_app46');
          Route::get('/en_app46_createimg','AppCreateController_en@en_app46_createimg');

          //app47
          Route::get('/What-Is-Locked-Up-In-Your-Heart','AppCreateController_en@en_app47');
          Route::get('/en_app47_createimg','AppCreateController_en@en_app47_createimg');

          //app48
          Route::get('/What-6-Word-Story-Describes-Your-Personality','AppCreateController_en@en_app48');
          Route::get('/en_app48_createimg','AppCreateController_en@en_app48_createimg');

          //app49
          Route::get('/What-type-of-angel-are-you','AppCreateController_en@en_app49');
          Route::get('/en_app49_createimg','AppCreateController_en@en_app49_createimg');

          //app50
          Route::get('/Which-career-fits-your-face','AppCreateController_en@en_app50');
          Route::get('/en_app50_createimg','AppCreateController_en@en_app50_createimg');

          //app51
          Route::get('/five-things-You-Should-Quit-Right-Now','AppCreateController_en@en_app51');
          Route::get('/en_app51_createimg','AppCreateController_en@en_app51_createimg');

          //app52
          Route::get('/What-Are-Your-five-Secrets','AppCreateController_en@en_app52');
          Route::get('/en_app52_createimg','AppCreateController_en@en_app52_createimg');

         //app53
          Route::get('/What-Do-You-Pray-For','AppCreateController_en@en_app53');
          Route::get('/en_app53_createimg','AppCreateController_en@en_app53_createimg');

          //app54
          Route::get('/What-Is-Common-Between-You-And-Dhoni','AppCreateController_en@en_app54');
          Route::get('/en_app54_createimg','AppCreateController_en@en_app54_createimg');

          //app55
          Route::get('/How-Would-Your-Official-Life-Look-Like-After-10-Years','AppCreateController_en@en_app55');
          Route::get('/en_app55_createimg','AppCreateController_en@en_app55_createimg');


          //app56
          Route::get('/This-is-what-God-wants-you-to-hear-in-2018','AppCreateController_en@en_app56');
          Route::get('/en_app56_createimg','AppCreateController_en@en_app56_createimg');


          //app57
          Route::get('/What-will-your-biography-say','AppCreateController_en@en_app57');
          Route::get('/en_app57_createimg','AppCreateController_en@en_app57_createimg');

          //app58
          Route::get('Find-out-which-7-things-make-you-unique','AppCreateController_en@en_app58');
          Route::get('/en_app58_createimg','AppCreateController_en@en_app58_createimg');

          //app59
          Route::get('What-will-you-change-about-your-self-in-2018','AppCreateController_en@en_app59');
          Route::get('/en_app59_createimg','AppCreateController_en@en_app59_createimg');

          //app60
          Route::get('What-will-your-biggest-sin-be-in-2018','AppCreateController_en@en_app60');
          Route::get('/en_app60_createimg','AppCreateController_en@en_app60_createimg');

          //app61
          Route::get('/What-was-your-profession-in-the-wild-west','AppCreateController_en@en_app61');
          Route::get('/en_app61_createimg','AppCreateController_en@en_app61_createimg');

          //app62
          Route::get('/What-will-happen-to-you-in-each-month-of-2018','AppCreateController_en@en_app62');
          Route::get('/en_app62_createimg','AppCreateController_en@en_app62_createimg');

          //app63
          Route::get('/What-is-your-DNA-ancestry-based-on-your-photo','AppCreateController_en@en_app63');
          Route::get('/en_app63_createimg','AppCreateController_en@en_app63_createimg');

          //app64
          Route::get('/What-kind-of-spirit-watches-over-you','AppCreateController_en@en_app64');
          Route::get('/en_app64_createimg','AppCreateController_en@en_app64_createimg');

          //app65
          Route::get('/Which-3-careers-are-right-for-you','AppCreateController_en@en_app65');
          Route::get('/en_app65_createimg','AppCreateController_en@en_app65_createimg');

          //app66
          Route::get('/Let-us-guess-your-height','AppCreateController_en@en_app66');
          Route::get('/en_app66_createimg','AppCreateController_en@en_app66_createimg');

          //app67
          Route::get('/Which-is-more-important-to-you-money-or-love','AppCreateController_en@en_app67');
          Route::get('/en_app67_createimg','AppCreateController_en@en_app67_createimg');

          //app68
          Route::get('/Which-parent-are-you-like-the-most','AppCreateController_en@en_app68');
          Route::get('/en_app68_createimg','AppCreateController_en@en_app68_createimg');

          //app69
          Route::get('/Heaven-or-Hell-Where-are-you-headed','AppCreateController_en@en_app69');
          Route::get('/en_app69_createimg','AppCreateController_en@en_app69_createimg');

          //app70
          Route::get('/How-many-people-want-to-kiss-marry-and-kill-you-in-2018','AppCreateController_en@en_app70');
          Route::get('/en_app70_createimg','AppCreateController_en@en_app70_createimg');

          //app71
          Route::get('/Who-is-your-famous-celebrity-lookalike','AppCreateController_en@en_app71');
          Route::get('/en_app71_createimg','AppCreateController_en@en_app71_createimg');

          //app72
          Route::get('/What-does-Satan-have-to-say-about-you','AppCreateController_en@en_app72');
          Route::get('/en_app72_createimg','AppCreateController_en@en_app72_createimg');

          //app73
          Route::get('/Which-color-suits-the-journey-of-your-life','AppCreateController_en@en_app73');
          Route::get('/en_app73_createimg','AppCreateController_en@en_app73_createimg');

          //app74
          Route::get('/What-are-your-3-qualities-and-1-flaw','AppCreateController_en@en_app74');
          Route::get('/en_app74_createimg','AppCreateController_en@en_app74_createimg');

          //app75
          Route::get('/Can-we-guess-your-profession-by-just-one-look-at-your-profile-picture','AppCreateController_en@en_app75');
          Route::get('/en_app75_createimg','AppCreateController_en@en_app75_createimg');

          //app76
          Route::get('/See-your-life-in-2018','AppCreateController_en@en_app76');
          Route::get('/en_app76_createimg','AppCreateController_en@en_app76_createimg');

          //app77
          Route::get('/Can-we-tell-your-income-based-on-your-face','AppCreateController_en@en_app77');
          Route::get('/en_app77_createimg','AppCreateController_en@en_app77_createimg');

          //app78
          Route::get('/Who-is-the-love-of-your-life','AppCreateController_en@en_app78');
          Route::get('/en_app78_createimg','AppCreateController_en@en_app78_createimg');

          //app79
          Route::get('/How-dirty-is-your-mind','AppCreateController_en@en_app79');
          Route::get('/en_app79_createimg','AppCreateController_en@en_app79_createimg');

          //app80
          Route::get('/What-will-your-daughter-look-like','AppCreateController_en@en_app80');
          Route::get('/en_app80_createimg','AppCreateController_en@en_app80_createimg');

          //app81
          Route::get('/Which-friend-will-influence-your-year-the-most','AppCreateController_en@en_app81');
          Route::get('/en_app81_createimg','AppCreateController_en@en_app81_createimg');

          //app82
          Route::get('/Which-friend-will-hold-your-hand-forever','AppCreateController_en@en_app82');
          Route::get('/en_app82_createimg','AppCreateController_en@en_app82_createimg');

          //app83
          Route::get('/Who-is-the-person-that-will-always-be-by-your-side','AppCreateController_en@en_app83');
          Route::get('/en_app83_createimg','AppCreateController_en@en_app83_createimg');

          //app84
          Route::get('/See-Your-Photo-Wall-Of-Wonderful-Memories','AppCreateController_en@en_app84');
          Route::get('/en_app84_createimg','AppCreateController_en@en_app84_createimg');

          //app85
          Route::get("/Who-is-In-Your-Family-Tree",'AppCreateController_en@en_app85');
          Route::get('/en_app85_createimg','AppCreateController_en@en_app85_createimg');

          //app86
          Route::get('/Which-one-word-describes-you','AppCreateController_en@en_app86');
          Route::get('/en_app86_createimg','AppCreateController_en@en_app86_createimg');

          //app87
          Route::get('/Whom-do-you-look-like','AppCreateController_en@en_app87');
          Route::get('/en_app87_createimg','AppCreateController_en@en_app87_createimg');

          //app88
          Route::get('/What-award-should-you-get-this-year','AppCreateController_en@en_app88');
          Route::get('/en_app88_createimg','AppCreateController_en@en_app88_createimg');

          //app89
          Route::get('/Where-will-you-travel-in-January','AppCreateController_en@en_app89');
          Route::get('/en_app89_createimg','AppCreateController_en@en_app89_createimg');

          //app90
          Route::get('/How-will-you-start-2018-based-on-your-name','AppCreateController_en@en_app90');
          Route::get('/en_app90_createimg','AppCreateController_en@en_app90_createimg');

          //app91
          Route::get('/Are-you-more-like-your-father-or-your-mother','AppCreateController_en@en_app91');
          Route::get('/en_app91_createimg','AppCreateController_en@en_app91_createimg');

          //app92
          Route::get('/What-is-your-word-for-2018','AppCreateController_en@en_app92');
          Route::get('/en_app92_createimg','AppCreateController_en@en_app92_createimg');

          //app93
          Route::get('/What-is-the-best-thing-about-you','AppCreateController_en@en_app93');
          Route::get('/en_app93_createimg','AppCreateController_en@en_app93_createimg');

          //app94
          Route::get('/What-are-the-5-things-that-will-make-you-happy','AppCreateController_en@en_app94');
          Route::get('/en_app94_createimg','AppCreateController_en@en_app94_createimg');

          //app95
          Route::get('/Are-you-more-like-a-cat-or-a-dog','AppCreateController_en@en_app95');
          Route::get('/en_app95_createimg','AppCreateController_en@en_app95_createimg');

          //app96
          Route::get('/See-how-your-life-will-change-in-2018','AppCreateController_en@en_app96');
          Route::get('/en_app96_createimg','AppCreateController_en@en_app96_createimg');

          //app97
          Route::get('/What-animal-is-in-your-heart','AppCreateController_en@en_app97');
          Route::get('/en_app97_createimg','AppCreateController_en@en_app97_createimg');

          //app98
          Route::get('/Which-drink-is-a-match-for-you','AppCreateController_en@en_app98');
          Route::get('/en_app98_createimg','AppCreateController_en@en_app98_createimg');

          //app99
          Route::get('/How-old-does-your-face-look-like','AppCreateController_en@en_app99');
          Route::get('/en_app99_createimg','AppCreateController_en@en_app99_createimg');

          //app100
          Route::get('/Can-we-guess-what-you-want-in-2018','AppCreateController_en@en_app100');
          Route::get('/en_app100_createimg','AppCreateController_en@en_app100_createimg');

          //app101
          Route::get('/What-profession-matches-your-name-best','AppCreateController_en@en_app101');
          Route::get('/en_app101_createimg','AppCreateController_en@en_app101_createimg');

          //app102
          Route::get('/Click-here-to-find-out-why-you-have-gone-missing','AppCreateController_en@en_app102');
          Route::get('/en_app102_createimg','AppCreateController_en@en_app102_createimg');

          //app103
          Route::get('/Can-we-guess-who-you-really-are','AppCreateController_en@en_app103');
          Route::get('/en_app103_createimg','AppCreateController_en@en_app103_createimg');

          //app104
          Route::get('/What-is-the-origin-of-your-last-name','AppCreateController_en@en_app104');
          Route::get('/en_app104_createimg','AppCreateController_en@en_app104_createimg');

          //app105
          Route::get('/What-is-your-mission-for-this-year','AppCreateController_en@en_app105');
          Route::get('/en_app105_createimg','AppCreateController_en@en_app105_createimg');

          //app106
          Route::get('/How-has-God-written-about-the-rest-of-your-Life','AppCreateController_en@en_app106');
          Route::get('/en_app106_createimg','AppCreateController_en@en_app106_createimg');

          //app107
          Route::get('/How-dangerous-are-you','AppCreateController_en@en_app107');
          Route::get('/en_app107_createimg','AppCreateController_en@en_app107_createimg');

          //app108
          Route::get('/What-beautiful-traits-did-your-children-inherit-from-You','AppCreateController_en@en_app108');
          Route::get('/en_app108_createimg','AppCreateController_en@en_app108_createimg');

          //app109
          Route::get('/What-is-your-Motto','AppCreateController_en@en_app109');
          Route::get('/en_app109_createimg','AppCreateController_en@en_app109_createimg');

          //app110
          Route::get('/What-are-5-reasons-people-are-jealous-of-You','AppCreateController_en@en_app110');
          Route::get('/en_app110_createimg','AppCreateController_en@en_app110_createimg');

          //app111
          Route::get('/What-does-your-face-say-about-your-body-and-soul','AppCreateController_en@en_app111');
          Route::get('/en_app111_createimg','AppCreateController_en@en_app111_createimg');

          //app112
          Route::get('/Which-mixed-race-are-you-based-on-your-photo','AppCreateController_en@en_app112');
          Route::get('/en_app112_createimg','AppCreateController_en@en_app112_createimg');

          //app113
          Route::get('/What-does-2018-have-in-store-for-you ','AppCreateController_en@en_app113');
          Route::get('/en_app113_createimg','AppCreateController_en@en_app113_createimg');

          //app114
          Route::get('/What-is-your-best-asset','AppCreateController_en@en_app114');
          Route::get('/en_app114_createimg','AppCreateController_en@en_app114_createimg');

          //app115
          Route::get('/What-describes-you-best','AppCreateController_en@en_app115');
          Route::get('/en_app115_createimg','AppCreateController_en@en_app115_createimg');

          //app116
          Route::get('/What-are-5-reasons-people-are-jealous-of-You','AppCreateController_en@en_app116');
          Route::get('/en_app116_createimg','AppCreateController_en@en_app116_createimg');

          //app117
          Route::get('/What-are-5-reasons-people-are-jealous-of-You','AppCreateController_en@en_app117');
          Route::get('/en_app117_createimg','AppCreateController_en@en_app117_createimg');

          //app118
          Route::get('/What-are-5-reasons-people-are-jealous-of-You','AppCreateController_en@en_app118');
          Route::get('/en_app118_createimg','AppCreateController_en@en_app118_createimg');

          //app119
          Route::get('/What-are-5-reasons-people-are-jealous-of-You','AppCreateController_en@en_app119');
          Route::get('/en_app119_createimg','AppCreateController_en@en_app119_createimg');

          //app120
          Route::get('/What-are-5-reasons-people-are-jealous-of-You','AppCreateController_en@en_app120');
          Route::get('/en_app120_createimg','AppCreateController_en@en_app120_createimg');

          //test
          Route::get('/user_friends_test','AppCreateController_en@user_friends');
          Route::get('/user_photos_test','AppCreateController_en@user_photos');

});

Route::get('/redirect', 'ShareController@redirect')->name('redirect');
Route::get('/callback', 'ShareController@callback');

//Route::get('/app1','ShareController@app1');
//Route::get('/app2','ShareController@app2');
//Route::get('/app3','ShareController@app3');
//Route::get('/app4','ShareController@app4');
//Route::get('/app5','ShareController@app5');
//Route::get('/app1_createimg','ShareController@app1_createimg');
//Route::get('/app2_createimg','ShareController@app2_createimg');
//Route::get('/app3_createimg','ShareController@app3_createimg');
//Route::post('app3_createimg','ShareController@app3_createimg');




//Route::post('/app3_createimg', array('uses' => 'ShareController@app3_createimg'));
Route::get('/profile','ShareController@profile');


Route::get('/json', function () {

  $json = Response::json(['name' => "satish", 'size' => "100"], 200);

  return $json;

 });
 Route::get('/gphy', function () {

   return view('giphys');

  });

// Route::get('/app_get_data','HomeController@getallapps');
// Route::get('/app_get_data',[
//   'uses'=>'HomeController@getallapps'
// ]);
// Route::get('/defult',[
//   'uses'=>'HomeController@defult'
// ]);

//Route::post('/app_get_data','HomeController@getallapps');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('admin.login');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register')->name('admin.register');
    Route::group(['middleware' => 'admin.auth'], function () {

    Route::get('/open_new_application_form','application\ApplicationController@open_new_app_form')->name('admin.open-newapp-form');

    Route::post('addnewapp','application\ApplicationController@create_new_app')->name('admin.addnewapp');

    Route::get('home', 'HomeController@index')->name('admin.home');

    Route::get('/edit_application_stock/{task}','application\ApplicationController@edit_application_stock')->name('admin.updateapp');
    Route::post('/edit_application_stock/{task}','application\ApplicationController@update_application_stock')->name('admin.updateapp');

    Route::get('/delete-uploaded-image','application\ApplicationController@delete_uploaded_image_page')->name('admin.deleteimgfolder');
    Route::post('/delete-uploaded-image_true/{dir}','application\ApplicationController@delete_uploaded_image_action')->name('admin.deletefolder');
  });

});


Route::post('testUrl', 'ShareController@getAjax');

  // Testing Routes
Route::get('fb_like', 'ShareController@fb_like');
Route::get('create_folder', 'ShareController@CreateFolderDirectory');
//Route::get('/app4_createimg','ShareController@app4_createimg');
//Route::get('/app5_createimg','ShareController@app5_createimg');
Route::get('/multiline_txtimg','ShareController@multilinetext_img');
Route::get('/randum','ShareController@randum');

Route::get('/radius','ShareController@radius');
 //Route::get('/app4_createimg_en','AppCreateController_en@app4_createimg_en');

Route::get('/compress_multiple_img','ShareController@compress_and_resize');
