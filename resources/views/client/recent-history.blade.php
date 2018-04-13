<?php
$user = auth()->user();
$recents = \App\OrderHistoryRecord::recentsForUser($user)->get();
?>

    <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    @lang("order.history.recents.label")
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">

                        @foreach($recents as $recentOrderRecord)
                            <li>
                                <div class="block">
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a>@lang("order.history.recents.record.main.message",
                                            ['operation'=>\Lang::get("order.operation.{$recentOrderRecord->operation}.label")])</a>
                                        </h2>
                                        <div class="byline">
                                            @lang("order.history.recents.record.userInfo.message",
                                            [
                                            'dateTime'=>$recentOrderRecord->created_at->timezone('Europe/Moscow')->format('d/m/Y H:i:s'),
                                            'name'=>$recentOrderRecord->user->name,
                                            'role'=>\Lang::get("roles.{$recentOrderRecord->user->getCurrentRole()->name}.label")
                                            ])
                                        </div>
                                        @if($recentOrderRecord->checklistHistory->count()>0)
                                            <br>
                                            <div style="margin-left: 15px">
                                                @foreach($recentOrderRecord->checklistHistory as $checklistHistoryRecord)
                                                    <p>
                                                        @lang("checklist.item.history.record.message",
                                                        ['name'=>$checklistHistoryRecord->itemName,
                                                        'status'=>\Lang::get("checklist.item.status.{$checklistHistoryRecord->newStatus}.label")
                                                        ])
                                                    </p>
                                                @endforeach
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

