<input name="statisticsType" style="display: none"
       value="{{$request->isOrder()?\App\Classes\enums\StatisticsTypeEnum::ORDERS: \App\Classes\enums\StatisticsTypeEnum::CLIENTS}}">