<?php

namespace App\Services;

use App\Classes\enums\StatisticsTypeEnum;
use App\Http\Requests\StatisticsRequest;
use App\Order;
use App\Utils\AppUtils;

class StatisticsService
{

    public function filter(StatisticsRequest $request)
    {
        if (!$request->get('statisticsType') || $request->get('statisticsType') == StatisticsTypeEnum::ORDERS) {
            return $this->filterByOrders($request);
        } else if ($request->get('statisticsType') == StatisticsTypeEnum::CLIENTS) {
            return $this->filterByClients($request);
        } else {
            return [];
        }
    }


    private function filterByOrders(StatisticsRequest $request)
    {
        $queryBuilder = $this->buildQueryForOrders($request);
        $result = $queryBuilder == null ? Order::all() : $queryBuilder->get();
        return $result;
    }

    private function filterByClients(StatisticsRequest $request)
    {
        return Order::all();
    }

    private function buildQueryForOrders(StatisticsRequest $request)
    {
        $queryBuilder = Order::existing();
        if ($request->get('order-tariff')) {
            $queryBuilder = $queryBuilder->withTariffID($request->get('order-tariff'));
        }
        if ($request->get('order-status')) {
            $queryBuilder = $queryBuilder->withStatus($request->get('order-status'));
        }
        if ($request->get('order-fromDate')) {
            $queryBuilder = $queryBuilder->afterDate(AppUtils::convertStringToDate($request->get('order-fromDate')));
        }
        if ($request->get('order-toDate')) {
            $queryBuilder = $queryBuilder->beforeDate(AppUtils::convertStringToDate($request->get('order-toDate')));
        }
        if ($request->get('emailToFind')) {
            $queryBuilder = $queryBuilder->ofClient($request->get('emailToFind'));
        }
        if ($request->get('order-domain')) {
            $queryBuilder = $queryBuilder->withDomain($request->get('order-domain'));
        }
        return $queryBuilder;
    }
}