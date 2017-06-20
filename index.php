<?php
/*
Задание.
Создать массив, ключами в котором будут регионы России (или любой другой страны), значениями - массивы городов этого региона.
Найти все города, состоящие из двух слов. Составить из них массив.
Случайным образом перемешать между собой первые слова и вторые слова названий, и совместить их, так, чтобы на выходе получилось Йошкар Новгород, Нижний Петербург и т.п.
Вывести эти фантазийные названия на экран.
*/
$arRegions = array(
    'belgorod' => array(
        'Строитель', 'Старый Оскол', 'Губкин', 'Короча', 'Новый Уренгой'
    ),
    'moskva' => array(
        'Люберцы', 'Наро-Фоминск', 'Можайск', 'Волоколамск', 'Воскресенск', 'Истра'
    ),
    'yaroslavl' => array(
        'Большое Село', 'Борисоглебский', 'Брейтово', 'Гаврилов Ям', 'Павловский Посад', 'Любим'
    )
);
$fantasyCities = [];
$twoWCitiesKeys = [];
$i = 0;
foreach($arRegions as $region=>$arCities){    
    foreach($arCities as $city){        
        $cityWords = preg_split("/[\s]+/", $city);
        if(count($cityWords) == 2){
            list($twoWCities_1[$i], $twoWCities_2[$i]) = $cityWords;
            $twoWCitiesKeys[$i] = $i;
            $i++;
        }
    }
}
$unusedKeys = $twoWCitiesKeys;
if($i > 1){
    for($key = 0; $key < $i; $key++){
        $less_cities_keys = $unusedKeys;
        unset($less_cities_keys[$key]);
        $less_cities_keys = array_keys($less_cities_keys);
        // One step before loop end, avoid if last key is only value of $less_cities_keys
        $next_key = $key+1;
        if(($key == $i-2) && (($pos_last_key = array_search($next_key, $less_cities_keys)) !== false)){
            $rand_key = $pos_last_key;
        }else{
            $rand_max = count($less_cities_keys) - 1;
            $rand_key = rand(0, $rand_max);
        }
        $real_key = $less_cities_keys[$rand_key];
        unset($unusedKeys[$real_key]);
        $fantasyCities[] = $twoWCities_1[$key]." ".$twoWCities_2[$real_key];
    }
}
echo '<pre>';
print_r($fantasyCities);
echo '</pre>';
