<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TopvisorSDK\V2 as TV;

include(app_path().'/Topvisor/topvisorSDK.php');

class TopvisorController extends Controller
{
    public function getRemoteDataById() {
        $project = request()->all();
        $projectId =  ( $project && $project['domainiId'] ) ? $project['domainiId'] : 1850424; // ID вашего проекта

        // создание сессии
        $Session = new TV\Session();

        // начало построения запроса
        $selectorKeywords = new TV\Pen($Session, 'get', 'positions_2', 'summary');

        // установка параметра project_id
        $selectorKeywords->setData([
            'project_id' => $projectId,
            'region_index' => 2,
            'dates' => ["2017-01-25","2018-02-04"],
            'show_dynamics' => 1,
            'show_avg' => 1,
            'show_tops' => 1
            ]);

// запрос на получение id и имени ключевой фразы
        $selectorKeywords->setFields(['id', 'name']);

// фильтр ключевых фраз с тегом 1, 2 или 3
        $selectorKeywords->setFilters([
            TV\Fields::genFilterData('tags', 'IN', [1,2,3])
        ]);

// сортировка ключевых фраз по алфавиту
        $selectorKeywords->serOrders([
            TV\Fields::genOrderData('name', 'ASC')
        ]);

// получать по 1000 ключевых фраз за одно обращение к API
        $selectorKeywords->setLimit(1000);

        do{
            // выполнение запроса (получить страницу с результатами)
            $page = $selectorKeywords->exec();

            // обработка ошибки
            if(is_null($page->getResult())) return var_dump($page->getErrors());

            // $page - array of keywords
//            foreach($page->getResult() as $resultItem){
//                foreach ($resultItem as $val) {
//                    echo $val .'<br>';
//                }
//            }

            // есть ли еще неполученные ключевые фразы
            // (если эта страница последняя, $nextOffset будет равен NULL)
            $nextOffset = $page->getNextOffset();
            if($nextOffset) $selectorKeywords->setOffset($nextOffset);

            // продолжать получать ключевые фразы, пока все страницы не будут получены
        }while($nextOffset);
        return response()->json($page->getResult());
        die();

        return true;
    }

    public function getRemoteData() {
        $projectUrl = request()->all();
        $projectId = '1920159'; // ID вашего проекта

        // создание сессии
        $Session = new TV\Session();

        // начало построения запроса
        $selectorKeywords = new TV\Pen($Session, 'get', 'projects_2', 'projects');

        // установка параметра project_id
        $selectorKeywords->setData([
            'region_index' => '1',
            'include_positions_summary_params' => ['show_dynamics' => 1, 'show_avg' => 1, 'show_tops' => 1],
            ]);

        // запрос на получение id и имени ключевой фразы
        $selectorKeywords->setFields(['id', 'name']);

        // фильтр ключевых фраз с тегом 1, 2 или 3
        $selectorKeywords->setFilters([
            TV\Fields::genFilterData('tags', 'IN', [1,2,3])
        ]);

        // сортировка ключевых фраз по алфавиту
        $selectorKeywords->serOrders([
            TV\Fields::genOrderData('name', 'ASC')
        ]);

        // получать по 1000 ключевых фраз за одно обращение к API
        $selectorKeywords->setLimit(1000);

        do{
            // выполнение запроса (получить страницу с результатами)
            $page = $selectorKeywords->exec();

            // обработка ошибки
            if(is_null($page->getResult())) return var_dump($page->getErrors());

            // $page - array of keywords
            foreach($page->getResult() as $resultItem){
                if($resultItem->name === $projectUrl['domain']) {
                    return response()->json($resultItem);
                }
            }
            die();

            // есть ли еще неполученные ключевые фразы
            // (если эта страница последняя, $nextOffset будет равен NULL)
            $nextOffset = $page->getNextOffset();
            if($nextOffset) $selectorKeywords->setOffset($nextOffset);

            // продолжать получать ключевые фразы, пока все страницы не будут получены
        }while($nextOffset);

        return true;
    }
}
