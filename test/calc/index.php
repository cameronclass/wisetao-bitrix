<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Калькулятор");

if (!empty($_POST['query_id']))
{

/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/

$file='';
if ($_POST['type_t']=='xiaobaihuo')
{

if ($_POST['type_id']==1)
{
$file=$_SERVER["DOCUMENT_ROOT"].'/test/calc/1.xlsx';
}
else
{
$file=$_SERVER["DOCUMENT_ROOT"].'/test/calc/2.xlsx';
}

}
else
{
if ($_POST['type_id']==1)
{
$file=$_SERVER["DOCUMENT_ROOT"].'/test/calc/3.xlsx';
}
else
{
$file=$_SERVER["DOCUMENT_ROOT"].'/test/calc/4.xlsx';
}

}

echo $file;



if ($_POST['sos']==1)
{
$ves=$_POST['weight1'];
$ob=$_POST['volume1'];
$kol=$_POST['places1'];
}
elseif ($_POST['sos']==2)
{
$ves=$_POST['weight2'];
$ob=$_POST['volume2'];
$kol=$_POST['places2'];
}
elseif ($_POST['sos']==3)
{
$ves=$_POST['weight3'];
$ob=$_POST['volume3'];
$kol=$_POST['places3'];
}


echo $ves;
echo $ob;
echo $kol;
echo '--';
echo $sumkom=$_POST['cen']+($_POST['cen']*0.05);
echo '--';

echo $sumkomst= $sumkom+($sumkom*$_POST['ins']);
echo '--';

echo $plo=$ves/$ob;


$stoimdos=$tarif*$ob;

$stoimdosst=$stoimdos+($stoimdos*$_POST['ins']);


}
?>


 <link rel="stylesheet" href="/frontend_production.min.css?v=5.1" type="text/css"/>

<div class="right-module">
                                    <div class="">
    <form method="POST" class="calculator-form" >
        <input type="hidden" name="_token" value="aJNse6EyDVR9ZlS1i7vSIaStMOkQg7CSMjD1XA9R">
        <input type="hidden" name="query_id" value="583f62e026e6a4eb763e6ffb23017fb8">

        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <label class="gray-icon" for="from_id"><span class="glyphicon glyphicon-map-marker"></span> Откуда
                </label>

                <div>
                    <select required="required" class="form-control col-xs-offset-right-0  col-md-offset-right-6" id="from_id" name="from_id">
                        <option value="mkad">МКАД</option>
                                                    
                                                                                                </select>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <label class="gray-icon" for="to_id"><span class="glyphicon glyphicon-map-marker"></span> Куда
                </label>

                <div>
                    <select class="form-control" required="required" id="to_id" name="to_id">
                        <option value="">-- Куда --</option>
                                                    <option value="6">Абакан</option>
                                                    <option value="310">Аган</option>
                                                    <option value="385">Азово</option>
                                                    <option value="450">Айкино</option>
                                                    <option value="289">Айхал</option>
                                                    <option value="403">Аксай</option>
                                                    <option value="207">Алапаевск</option>
                                                    <option value="474">Алатырь</option>
                                                    <option value="108">Алдан</option>
                                                    <option value="601">Александров</option>
                                                    <option value="600">Алматы</option>
                                                    <option value="428">Алушта</option>
                                                    <option value="368">Алыкель</option>
                                                    <option value="109">Альметьевск</option>
                                                    <option value="524">Анадырь</option>
                                                    <option value="7">Анапа</option>
                                                    <option value="224">Ангарск</option>
                                                    <option value="258">Анжеро-Суджинск</option>
                                                    <option value="8">Апатиты</option>
                                                    <option value="208">Арамиль</option>
                                                    <option value="509">Аргаяш</option>
                                                    <option value="314">Арзамас</option>
                                                    <option value="110">Армавир</option>
                                                    <option value="197">Артем</option>
                                                    <option value="195">Артем, Уссурийск, Врангель, Находка</option>
                                                    <option value="9">Архангельск</option>
                                                    <option value="89">Астана</option>
                                                    <option value="10">Астрахань</option>
                                                    <option value="3">Атырау</option>
                                                    <option value="536">Ахтубинск</option>
                                                    <option value="112">Ачинск</option>
                                                    <option value="494">Аша</option>
                                                    <option value="252">Багратионовск</option>
                                                    <option value="226">Байкальск</option>
                                                    <option value="90">Байконур</option>
                                                    <option value="602">Баку</option>
                                                    <option value="426">Балаково</option>
                                                    <option value="315">Балахна</option>
                                                    <option value="424">Балашов</option>
                                                    <option value="250">Балтийск</option>
                                                    <option value="91">Балхаш</option>
                                                    <option value="11">Барнаул</option>
                                                    <option value="404">Батайск</option>
                                                    <option value="475">Батырево</option>
                                                    <option value="12">Белгород</option>
                                                    <option value="465">Белебей</option>
                                                    <option value="260">Белово</option>
                                                    <option value="113">Белогорск</option>
                                                    <option value="461">Белорецк</option>
                                                    <option value="13">Белоярский</option>
                                                    <option value="401">Березники</option>
                                                    <option value="205">Беслан</option>
                                                    <option value="111">Бийск</option>
                                                    <option value="114">Биробиджан</option>
                                                    <option value="14">Благовещенск</option>
                                                    <option value="455">Богашево</option>
                                                    <option value="316">Богородск</option>
                                                    <option value="378">Большеречье</option>
                                                    <option value="317">Бор</option>
                                                    <option value="538">Борисоглебск</option>
                                                    <option value="15">Братск</option>
                                                    <option value="115">Брянск</option>
                                                    <option value="16">Бугульма</option>
                                                    <option value="539">Бугуруслан</option>
                                                    <option value="445">Буденновск</option>
                                                    <option value="387">Бузулук</option>
                                                    <option value="283">Буйнакск</option>
                                                    <option value="333">В. Тура</option>
                                                    <option value="329">В.Салда</option>
                                                    <option value="469">Ванино, Советская Гавань</option>
                                                    <option value="311">Варьеган</option>
                                                    <option value="487">Вахрушево</option>
                                                    <option value="107">Великий Новгород</option>
                                                    <option value="400">Верещагино</option>
                                                    <option value="495">Верх. Уфалей</option>
                                                    <option value="540">Верхнезейск</option>
                                                    <option value="183">Верхнеказымский</option>
                                                    <option value="209">Верхняя Пышма</option>
                                                    <option value="210">Верхняя Салда</option>
                                                    <option value="415">Виллози</option>
                                                    <option value="395">Вилючинск</option>
                                                    <option value="17">Владивосток</option>
                                                    <option value="18">Владикавказ</option>
                                                    <option value="116">Владимир</option>
                                                    <option value="19">Волгоград</option>
                                                    <option value="406">Волгодонск</option>
                                                    <option value="525">Волжский</option>
                                                    <option value="117">Вологда</option>
                                                    <option value="423">Вольск</option>
                                                    <option value="118">Воркута</option>
                                                    <option value="119">Воронеж</option>
                                                    <option value="541">Воскресенск</option>
                                                    <option value="217">Воткинск</option>
                                                    <option value="397">Вулканный</option>
                                                    <option value="318">Выкса</option>
                                                    <option value="370">Вынгапур</option>
                                                    <option value="306">Высокий</option>
                                                    <option value="542">Вышний Волочек</option>
                                                    <option value="543">Вязьма</option>
                                                    <option value="388">Гай</option>
                                                    <option value="420">Гатчина</option>
                                                    <option value="171">Геленджик</option>
                                                    <option value="218">Глазов</option>
                                                    <option value="179">Горно-Алтайск</option>
                                                    <option value="459">Горноправдинск</option>
                                                    <option value="319">Городец</option>
                                                    <option value="20">Грозный</option>
                                                    <option value="128">Губкинский</option>
                                                    <option value="247">Гурьевск</option>
                                                    <option value="282">Дагестанские Огни</option>
                                                    <option value="279">Дербент</option>
                                                    <option value="526">Джанкой</option>
                                                    <option value="320">Дзержинск</option>
                                                    <option value="270">Дивногорск</option>
                                                    <option value="120">Димитровград</option>
                                                    <option value="476">Долгодеревенское</option>
                                                    <option value="519">Долинск</option>
                                                    <option value="544">Донецк</option>
                                                    <option value="369">Дудинка</option>
                                                    <option value="435">Евпатория</option>
                                                    <option value="21">Екатеринбург</option>
                                                    <option value="312">Елабуга</option>
                                                    <option value="545">Елец</option>
                                                    <option value="399">Елизово</option>
                                                    <option value="491">Еманжелинск</option>
                                                    <option value="274">Енисейск</option>
                                                    <option value="443">Ессентуки</option>
                                                    <option value="493">Еткуль</option>
                                                    <option value="92">Жанаозен</option>
                                                    <option value="93">Жанатас</option>
                                                    <option value="94">Жаркент</option>
                                                    <option value="95">Жезказган</option>
                                                    <option value="444">Железноводск</option>
                                                    <option value="269">Железногорск</option>
                                                    <option value="411">Жигулевск</option>
                                                    <option value="121">Забайкальск</option>
                                                    <option value="321">Заволжье</option>
                                                    <option value="219">Завьялово</option>
                                                    <option value="294">Заполярный</option>
                                                    <option value="211">Заречный</option>
                                                    <option value="268">Зеленогорск</option>
                                                    <option value="546">Зеленодольск</option>
                                                    <option value="191">Зея</option>
                                                    <option value="496">Златоуст</option>
                                                    <option value="122">Иваново</option>
                                                    <option value="22">Ижевск</option>
                                                    <option value="281">Избербаш</option>
                                                    <option value="308">Излучинск</option>
                                                    <option value="123">Инта</option>
                                                    <option value="23">Иркутск</option>
                                                    <option value="379">Исилькуль</option>
                                                    <option value="510">Ишалино</option>
                                                    <option value="458">Ишим</option>
                                                    <option value="462">Ишимбай</option>
                                                    <option value="124">Йошкар-Ола</option>
                                                    <option value="477">Казанцево</option>
                                                    <option value="24">Казань</option>
                                                    <option value="187">Казым</option>
                                                    <option value="367">Кайеркан,Талнах</option>
                                                    <option value="377">Калачинск</option>
                                                    <option value="25">Калининград</option>
                                                    <option value="347">Калтан</option>
                                                    <option value="129">Калуга</option>
                                                    <option value="223">Каменное</option>
                                                    <option value="212">Каменск-Уральский</option>
                                                    <option value="405">Каменск-Шахтинский</option>
                                                    <option value="299">Кандалакша</option>
                                                    <option value="267">Канск</option>
                                                    <option value="547">Канск-Енисейский</option>
                                                    <option value="502">Карабаш</option>
                                                    <option value="548">Карабула</option>
                                                    <option value="549">Карасук</option>
                                                    <option value="337">Карпинск</option>
                                                    <option value="503">Касли</option>
                                                    <option value="285">Каспийск</option>
                                                    <option value="497">Катав-Ивановск</option>
                                                    <option value="335">Качканар</option>
                                                    <option value="26">Кемерово</option>
                                                    <option value="436">Керчь</option>
                                                    <option value="286">Кизилюрт</option>
                                                    <option value="284">Кизляр</option>
                                                    <option value="412">Кинель</option>
                                                    <option value="550">Кинешма</option>
                                                    <option value="227">Киренск</option>
                                                    <option value="130">Киров</option>
                                                    <option value="342">Киселевск</option>
                                                    <option value="551">Кисилевск</option>
                                                    <option value="441">Кисловодск</option>
                                                    <option value="552">Клин</option>
                                                    <option value="553">Клинцы</option>
                                                    <option value="27">Когалым</option>
                                                    <option value="273">Кодинск</option>
                                                    <option value="298">Кола</option>
                                                    <option value="554">Коломна</option>
                                                    <option value="354">Кольцово</option>
                                                    <option value="125">Комсомольск-на-Амуре</option>
                                                    <option value="555">Коноша</option>
                                                    <option value="478">Копейск</option>
                                                    <option value="263">Кореновск</option>
                                                    <option value="489">Коркино</option>
                                                    <option value="375">Коротчаево</option>
                                                    <option value="516">Корсаков</option>
                                                    <option value="556">Коршуниха-Ангар.</option>
                                                    <option value="126">Кострома</option>
                                                    <option value="178">Котлас</option>
                                                    <option value="413">Красная Глинка</option>
                                                    <option value="417">Красная Заря</option>
                                                    <option value="437">Красная Поляна</option>
                                                    <option value="557">Красновишенск</option>
                                                    <option value="492">Красногорский</option>
                                                    <option value="28">Краснодар</option>
                                                    <option value="421">Красное Село</option>
                                                    <option value="351">Краснообск</option>
                                                    <option value="338">Краснотурьинск</option>
                                                    <option value="332">Красноуральск</option>
                                                    <option value="29">Красноярск</option>
                                                    <option value="479">Кременкуль</option>
                                                    <option value="357">Криводановка</option>
                                                    <option value="264">Кропоткин</option>
                                                    <option value="381">Крутинка</option>
                                                    <option value="173">Крымск</option>
                                                    <option value="322">Кстово</option>
                                                    <option value="389">Кувандык</option>
                                                    <option value="527">Кузнецк</option>
                                                    <option value="456">Кузовлевский тракт</option>
                                                    <option value="358">Куйбышев</option>
                                                    <option value="323">Кулебаки</option>
                                                    <option value="463">Кумертау</option>
                                                    <option value="30">Курган</option>
                                                    <option value="31">Курск</option>
                                                    <option value="277">Курская область</option>
                                                    <option value="331">Кушва</option>
                                                    <option value="168">Кызыл</option>
                                                    <option value="504">Кыштым</option>
                                                    <option value="558">Лабинск</option>
                                                    <option value="131">Лабытнанги</option>
                                                    <option value="439">Лазаревский р-он</option>
                                                    <option value="305">Лангепас</option>
                                                    <option value="528">Лена</option>
                                                    <option value="313">Лениногорск</option>
                                                    <option value="259">Ленинск-Кузнецкий</option>
                                                    <option value="288">Ленск</option>
                                                    <option value="442">Лермонтов</option>
                                                    <option value="215">Лесной</option>
                                                    <option value="271">Лесосибирск</option>
                                                    <option value="132">Липецк</option>
                                                    <option value="309">Локосово</option>
                                                    <option value="324">Лысково</option>
                                                    <option value="184">Лыхма</option>
                                                    <option value="559">Людиново</option>
                                                    <option value="32">Магадан</option>
                                                    <option value="203">Магас</option>
                                                    <option value="192">Магдачи</option>
                                                    <option value="33">Магнитогорск</option>
                                                    <option value="265">Майкоп</option>
                                                    <option value="182">Майма</option>
                                                    <option value="348">Малиновка</option>
                                                    <option value="255">Мариинск</option>
                                                    <option value="355">Марусино</option>
                                                    <option value="34">Махачкала</option>
                                                    <option value="307">Мегион</option>
                                                    <option value="390">Медногорск</option>
                                                    <option value="345">Междуреченск</option>
                                                    <option value="133">Миасс</option>
                                                    <option value="490">Миасское</option>
                                                    <option value="560">Микунь</option>
                                                    <option value="35">Минеральные Воды</option>
                                                    <option value="4">Минск</option>
                                                    <option value="166">Минусинск</option>
                                                    <option value="36">Мирный</option>
                                                    <option value="561">Мичуринск</option>
                                                    <option value="562">Могоча</option>
                                                    <option value="221">Можга</option>
                                                    <option value="204">Моздок</option>
                                                    <option value="296">Молочный</option>
                                                    <option value="293">Мончегорск</option>
                                                    <option value="244">Моргауши</option>
                                                    <option value="1">Москва</option>
                                                    <option value="353">Мочище</option>
                                                    <option value="359">Мошково</option>
                                                    <option value="371">Муравленко</option>
                                                    <option value="37">Мурманск</option>
                                                    <option value="297">Мурмаши</option>
                                                    <option value="563">Муром</option>
                                                    <option value="383">Муромцево</option>
                                                    <option value="344">Мыски</option>
                                                    <option value="330">Н.Салда</option>
                                                    <option value="334">Н.Тура</option>
                                                    <option value="134">Набережные Челны</option>
                                                    <option value="325">Навашино</option>
                                                    <option value="366">Надежда,Медвежка, Валек</option>
                                                    <option value="38">Надым</option>
                                                    <option value="39">Назрань</option>
                                                    <option value="380">Называевск</option>
                                                    <option value="40">Нальчик</option>
                                                    <option value="41">Нарьян-Мар</option>
                                                    <option value="135">Находка</option>
                                                    <option value="518">Невельск</option>
                                                    <option value="136">Невинномысск</option>
                                                    <option value="42">Нерюнгри</option>
                                                    <option value="127">Нефтекамск</option>
                                                    <option value="137">Нефтеюганск</option>
                                                    <option value="43">Нижневартовск</option>
                                                    <option value="44">Нижнекамск</option>
                                                    <option value="564">Нижнеудинск</option>
                                                    <option value="45">Нижний Новгород</option>
                                                    <option value="138">Нижний Тагил</option>
                                                    <option value="396">Николаевка</option>
                                                    <option value="470">Николаевск-на-Амуре</option>
                                                    <option value="530">Новая Чара</option>
                                                    <option value="304">Новоаганск</option>
                                                    <option value="386">Нововаршавка</option>
                                                    <option value="511">Новогорный</option>
                                                    <option value="175">Новодвинск</option>
                                                    <option value="46">Новокузнецк</option>
                                                    <option value="409">Новокуйбышевск</option>
                                                    <option value="139">Новороссийск</option>
                                                    <option value="47">Новосибирск</option>
                                                    <option value="480">Новосинеглазово</option>
                                                    <option value="391">Новотроицк</option>
                                                    <option value="473">Новочебоксарск</option>
                                                    <option value="407">Новочеркасск</option>
                                                    <option value="565">Новый Уоян</option>
                                                    <option value="48">Новый Уренгой</option>
                                                    <option value="521">Ноглики</option>
                                                    <option value="49">Норильск</option>
                                                    <option value="50">Ноябрьск</option>
                                                    <option value="51">Нягань</option>
                                                    <option value="512">Нязепетровск</option>
                                                    <option value="177">Няндома</option>
                                                    <option value="350">Обь</option>
                                                    <option value="365">Оганер</option>
                                                    <option value="505">Озерск</option>
                                                    <option value="464">Октябрьский</option>
                                                    <option value="206">Октябрьское</option>
                                                    <option value="52">Омск</option>
                                                    <option value="140">Орел</option>
                                                    <option value="53">Оренбург</option>
                                                    <option value="54">Орск</option>
                                                    <option value="343">Осинники</option>
                                                    <option value="414">Отрадный</option>
                                                    <option value="520">Оха</option>
                                                    <option value="143">П-Камчатский</option>
                                                    <option value="326">Павлово</option>
                                                    <option value="566">Падунские Пороги</option>
                                                    <option value="376">Пангоды</option>
                                                    <option value="201">Партизанск</option>
                                                    <option value="141">Пенза</option>
                                                    <option value="352">Первомайский</option>
                                                    <option value="213">Первоуральск</option>
                                                    <option value="56">Пермь</option>
                                                    <option value="416">Петергоф</option>
                                                    <option value="567">Петровский Завод</option>
                                                    <option value="57">Петрозаводск</option>
                                                    <option value="142">Печора</option>
                                                    <option value="253">Пионерский</option>
                                                    <option value="501">Пласт</option>
                                                    <option value="176">Плесецк</option>
                                                    <option value="568">Плесецкая</option>
                                                    <option value="302">Покачи</option>
                                                    <option value="481">Полетаево</option>
                                                    <option value="188">Полноват</option>
                                                    <option value="292">Полярные Зори</option>
                                                    <option value="488">Потанино</option>
                                                    <option value="249">Прибрежный</option>
                                                    <option value="569">Приобье</option>
                                                    <option value="341">Прокопьевск</option>
                                                    <option value="58">Псков</option>
                                                    <option value="570">Пуровск</option>
                                                    <option value="373">Пуровский</option>
                                                    <option value="363">Пурпе</option>
                                                    <option value="571">Пыть Ях</option>
                                                    <option value="144">Пятигорск</option>
                                                    <option value="301">Радужный</option>
                                                    <option value="356">Раздольное</option>
                                                    <option value="214">Ревда</option>
                                                    <option value="572">Россошь</option>
                                                    <option value="59">Ростов-на-Дону</option>
                                                    <option value="482">Рощино</option>
                                                    <option value="425">Ртищево</option>
                                                    <option value="145">Рубцовск</option>
                                                    <option value="573">Ружино</option>
                                                    <option value="574">Рыбинск</option>
                                                    <option value="146">Рязань</option>
                                                    <option value="429">Саки</option>
                                                    <option value="147">Салават</option>
                                                    <option value="60">Салехард</option>
                                                    <option value="447">Салым</option>
                                                    <option value="61">Самара</option>
                                                    <option value="2">Санкт-Петербург</option>
                                                    <option value="148">Саранск</option>
                                                    <option value="222">Сарапул</option>
                                                    <option value="63">Саратов</option>
                                                    <option value="327">Саров</option>
                                                    <option value="498">Сатка</option>
                                                    <option value="165">Саяногорск</option>
                                                    <option value="248">Светлогорск</option>
                                                    <option value="398">Светлый</option>
                                                    <option value="190">Свободный</option>
                                                    <option value="431">Севастополь</option>
                                                    <option value="575">Северобайкальск</option>
                                                    <option value="149">Северодвинск</option>
                                                    <option value="295">Североморск</option>
                                                    <option value="339">Североуральск</option>
                                                    <option value="453">Северск</option>
                                                    <option value="336">Серов</option>
                                                    <option value="466">Сибай</option>
                                                    <option value="576">Сивая маска</option>
                                                    <option value="64">Симферополь</option>
                                                    <option value="181">Славгород</option>
                                                    <option value="172">Славянск-на-Кубани</option>
                                                    <option value="150">Смоленск</option>
                                                    <option value="484">Смолино</option>
                                                    <option value="506">Снежинск</option>
                                                    <option value="291">Снежногорск</option>
                                                    <option value="246">Советск</option>
                                                    <option value="577">Советская Гавань</option>
                                                    <option value="65">Советский</option>
                                                    <option value="578">Соликамск</option>
                                                    <option value="392">Сорочинск</option>
                                                    <option value="186">Сорум</option>
                                                    <option value="185">Сосновка</option>
                                                    <option value="418">Сосновый Бор</option>
                                                    <option value="452">Сосногорск ч/з Ухту</option>
                                                    <option value="66">Сочи</option>
                                                    <option value="579">Спасск-Дальний</option>
                                                    <option value="67">Ставрополь</option>
                                                    <option value="483">Старокамышинск</option>
                                                    <option value="151">Старый Оскол</option>
                                                    <option value="152">Стерлитамак</option>
                                                    <option value="153">Стрежевой</option>
                                                    <option value="432">Судак</option>
                                                    <option value="68">Сургут</option>
                                                    <option value="154">Сызрань</option>
                                                    <option value="69">Сыктывкар</option>
                                                    <option value="70">Таганрог</option>
                                                    <option value="580">Тайшет</option>
                                                    <option value="531">Таксимо</option>
                                                    <option value="174">Тамань</option>
                                                    <option value="71">Тамбов</option>
                                                    <option value="384">Тара</option>
                                                    <option value="374">Тарко-Сале</option>
                                                    <option value="346">Таштагол</option>
                                                    <option value="155">Тверь</option>
                                                    <option value="170">Темрюк</option>
                                                    <option value="454">Тимирязево</option>
                                                    <option value="508">Тимирязевский</option>
                                                    <option value="581">Тихорецк</option>
                                                    <option value="457">Тобольск</option>
                                                    <option value="156">Тольятти</option>
                                                    <option value="532">Томмот</option>
                                                    <option value="72">Томск</option>
                                                    <option value="451">Троицк</option>
                                                    <option value="507">Трёхгорный</option>
                                                    <option value="438">Туапсе</option>
                                                    <option value="157">Тула</option>
                                                    <option value="158">Тында</option>
                                                    <option value="73">Тюмень</option>
                                                    <option value="340">Тяльжино</option>
                                                    <option value="513">Увелка</option>
                                                    <option value="193">Углегорск</option>
                                                    <option value="290">Удачный</option>
                                                    <option value="272">Ужур</option>
                                                    <option value="533">Улан-Удэ</option>
                                                    <option value="75">Ульяновск</option>
                                                    <option value="472">Урай</option>
                                                    <option value="76">Усинск</option>
                                                    <option value="161">Уссурийск</option>
                                                    <option value="198">Уссурийск, Бол. Камень</option>
                                                    <option value="419">Усть-Ижора</option>
                                                    <option value="160">Усть-Илимск</option>
                                                    <option value="500">Усть-Катав</option>
                                                    <option value="228">Усть-Кут</option>
                                                    <option value="266">Усть-Лабинск</option>
                                                    <option value="583">Устье-Аха</option>
                                                    <option value="77">Уфа</option>
                                                    <option value="78">Ухта</option>
                                                    <option value="584">Февральск</option>
                                                    <option value="485">Федоровка</option>
                                                    <option value="433">Феодосия</option>
                                                    <option value="200">Фокино</option>
                                                    <option value="79">Хабаровск</option>
                                                    <option value="585">Хани</option>
                                                    <option value="80">Ханты-Мансийск</option>
                                                    <option value="372">Ханымей</option>
                                                    <option value="280">Хасавюрт</option>
                                                    <option value="586">Хилок</option>
                                                    <option value="517">Холмск</option>
                                                    <option value="162">Чайковский</option>
                                                    <option value="410">Чапаевск</option>
                                                    <option value="216">Чебаркуль</option>
                                                    <option value="81">Чебоксары</option>
                                                    <option value="587">Чегдомын</option>
                                                    <option value="82">Челябинск</option>
                                                    <option value="225">Черемхово</option>
                                                    <option value="83">Череповец</option>
                                                    <option value="440">Черкесск</option>
                                                    <option value="382">Черлак</option>
                                                    <option value="167">Черногорск</option>
                                                    <option value="430">Черноморское</option>
                                                    <option value="588">Чернышевск-Заб.</option>
                                                    <option value="254">Черняховск</option>
                                                    <option value="243">Чистополь</option>
                                                    <option value="84">Чита</option>
                                                    <option value="589">Чуна</option>
                                                    <option value="590">Чунояр</option>
                                                    <option value="591">Чусовой</option>
                                                    <option value="486">Шагол</option>
                                                    <option value="592">Шарья</option>
                                                    <option value="163">Шахты</option>
                                                    <option value="593">Шилка</option>
                                                    <option value="85">Элиста</option>
                                                    <option value="422">Энгельс</option>
                                                    <option value="449">Югорск</option>
                                                    <option value="256">Югра</option>
                                                    <option value="86">Южно-Сахалинск</option>
                                                    <option value="499">Южноуральск</option>
                                                    <option value="594">Юктали</option>
                                                    <option value="514">Юрюзань</option>
                                                    <option value="393">Явас</option>
                                                    <option value="87">Якутск</option>
                                                    <option value="434">Ялта</option>
                                                    <option value="180">Яровое</option>
                                                    <option value="164">Ярославль</option>
                                                    <option value="257">Яшкино</option>
                                                    <option value="229">г.Волжск</option>
                                                    <option value="230">г.Звенигово</option>
                                                    <option value="231">г.Козьмодемьянск</option>
                                                    <option value="202">о. Русский</option>
                                                    <option value="232">п.Килемары</option>
                                                    <option value="242">п.Куженер</option>
                                                    <option value="234">п.Мари-Турек</option>
                                                    <option value="239">п.Медведево</option>
                                                    <option value="240">п.Морки</option>
                                                    <option value="237">п.Новый-Торьял</option>
                                                    <option value="238">п.Оршанка</option>
                                                    <option value="235">п.Параньга</option>
                                                    <option value="233">п.Сернур</option>
                                                    <option value="241">п.Юрино</option>
                                            </select>
                </div>






  <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label class="gray-icon" for="cen"><span class="glyphicon glyphicon-scale"></span>Стоимость груза ($)</label>

                <div>
                    <input placeholder="Стоимость груза" class="form-control" style="" value="" type="number" min="1" step="1" max="99999" name="cen" required="required" id="cen">
                </div>
            </div>
        </div>










 <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label class="gray-icon" for="weight"><span class="glyphicon glyphicon-scale"></span> Адрес</label>

                <div>
                    <input placeholder="Адрес" class="form-control" style="" value="" type="text" name="ad"  id="ad">
                </div>
            </div>
        </div>

               
            </div>
        </div>
        <div class="col-xs-12">

            <div class="form-group">
                <label class="gray-icon" for="type_id"><span class="glyphicon glyphicon-road"></span> Метод доставки</label>

                <div>
                    <select class="form-control" required="required" id="type_id" name="type_id">
                        <option value="">-- Метод доставки --</option>
                                                   
                                                    <option value="1">АВТО обычное</option>
                                                    <option value="2">АВТО быстрое</option>
                                            </select>
                </div>
            </div>
        </div>


 <div class="col-xs-12">

            <div class="form-group">
                <label class="gray-icon" for="type_t"><span class="glyphicon glyphicon-road"></span> Тип товаров</label>

                <div>
                    <select class="form-control" required="required" id="type_t" name="type_t">
                        <option value="">-- Тип товаров --</option>
                                                   
                                                    <option value="xiaobaihuo">Товары повседневного спроса</option>
                                                    <option value="dabaihuo">Товары не повседневного спроса, одежда, обувь, электроник</option>
                                            </select>
                </div>
            </div>
        </div>






 <div class="col-xs-12">

            <div class="form-group">
                <label class="gray-icon" for="type_t"><span class="glyphicon glyphicon-road"></span> Состав груза</label>

                <div>
                    <select onchange="var tt=$('#sos option:selected').val();$('.sosa').hide();$('#ra'+tt).show();" class="form-control" required="required" id="sos" name="sos">
                        <option value="">-- Состав груза --</option>                     
                         <option value="1">1 место</option>
                         <option value="2">Несколько мест</option>
                         <option value="3">Письмо</option>
                                            </select>
                </div>
            </div>
        </div>










<div class="sosa" id="ra1">

        <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label class="gray-icon" for="weight"><span class="glyphicon glyphicon-scale"></span> Вес</label>

                <div>
                    <input placeholder="Вес" class="form-control" style="" value="" type="number" min="0.1" step="0.1" max="99999" name="weight1" required="required" id="weigth">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label class="gray-icon" for="volume"><span class="glyphicon glyphicon-compressed"></span> Объем</label>

                <div>
                    <input placeholder="Объем" class="form-control" style="" value="0.001" type="number" min="0.001" step="0.001" max="9999" name="volume1" required="required">
                </div>
            </div>
        </div>





        <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label class="gray-icon" for="places"><span class="glyphicon glyphicon-shopping-cart"></span> Кол-во мест
                </label>

                <div>
                    <input placeholder="Кол-во мест" class="form-control" style="" value="1" min="1" max="1" type="number" name="places1" readonly id="places">
                </div>
            </div>
        </div>

</div>





<div style="display:none" class="sosa" id="ra2">

        <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label class="gray-icon" for="weight"><span class="glyphicon glyphicon-scale"></span>Общий Вес</label>

                <div>
                    <input placeholder="Вес" class="form-control" style="" value="" type="number" min="0.1" step="0.1" max="99999" name="weight2" required="required" id="weigth">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label class="gray-icon" for="volume"><span class="glyphicon glyphicon-compressed"></span> Общий Объем</label>

                <div>
                    <input placeholder="Объем" class="form-control" style="" value="0.001" type="number" min="0.001" step="0.001" max="9999" name="volume2" required="required">
                </div>
            </div>
        </div>





        <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label class="gray-icon" for="places"><span class="glyphicon glyphicon-shopping-cart"></span> Кол-во мест
                </label>

                <div>
                    <input placeholder="Кол-во мест" class="form-control" style="" value="" min="1" max="1000" type="number" name="places2" required="required" id="places">
                </div>
            </div>
        </div>

</div>







<div style="display:none" class="sosa" id="ra3">

        <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label class="gray-icon" for="weight"><span class="glyphicon glyphicon-scale"></span> Вес</label>

                <div>
                    <input placeholder="Вес" class="form-control" style="" value="0.5" type="number" min="0.1" step="0.1" max="99999" name="weight3" readonly id="weigth">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label class="gray-icon" for="volume"><span class="glyphicon glyphicon-compressed"></span> Объем</label>

                <div>
                    <input placeholder="Объем" class="form-control" style="" value="0.0006" type="number" min="0.001" step="0.001" max="9999"  readonly  name="volume3" required="required">
                </div>
            </div>
        </div>





        <div class="col-xs-12 col-sm-4">
            <div class="form-group">
                <label class="gray-icon" for="places"><span class="glyphicon glyphicon-shopping-cart"></span> Кол-во мест
                </label>

                <div>
                    <input placeholder="Кол-во мест" class="form-control" style="" value="1" min="1" max="100" type="number" readonly name="places3" required="required" id="places">
                </div>
            </div>
        </div>

</div>



















        <div class="col-xs-12">
            <div style="margin-bottom:20px;display: table;width:100%; border-bottom: 1px solid #cecece;"><p></p></div>
        </div>
        <div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class="gray-icon" for="pack_type"><span class="glyphicon glyphicon-gift"></span> Упаковка
                    </label>

                    <div>
                        <select style="" class="form-control" required="required" id="pack_type" name="pack_type">
                            <option value="0">Без упаковки</option>
                                                            <option value="3">Паллета</option>
                                                            <option value="6">Уголки прочности</option>
                                                            <option value="8">Дерево обрешетка</option>
                                                            <option value="9">Коробка</option>
                                                    </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div style="margin-bottom:20px;display: table;width:100%; border-bottom: 1px solid #cecece;"><p></p></div>
        </div>
            
            
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <label class="gray-icon" for="ins"><span class="glyphicon glyphicon-ok-sign"></span> Страхование груза</label>

                <div>
                    <select style="" onchange="toggleCargoPrice();" class="form-control" required="required" id="ins" name="ins">
                        <option selected="selected" value="0">Нет</option>
                         <option value="0.02">2%</option>
                        <option value="0.05">5%</option>
                    </select>
                </div>
            </div>

            <div class="form-group price-section" style="display: none;">
                <label class="gray-icon" for="price"><span class="glyphicon glyphicon-ruble"></span> Стоимость</label>

                <div>
                    <input class="form-control money_val" style="" type="text" value="" name="price" step="0.01" id="price">
                </div>
            </div>

        </div>
        <div class="col-xs-12">
            <p><br></p>
        </div>
        <div class="text-center col-xs-12">
            <button type="submit" style="font-style: italic;"  class="btn btn-primary">Рассчитать стоимость</button>
        </div>
        <div class="col-xs-12">
            <p><br></p>
        </div>

    </form>

    
</div>
                                </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>