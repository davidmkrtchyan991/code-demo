<?php /**/
$user = auth()->user();
$is_update_client_keywords = $order->commitOperation == \App\Classes\enums\OrderOperationsEnum::UPDATE_CLIENT_KEYWORDS;
/**/ ?>
<br>

<ul class="nav nav-tabs">
    @if($user->isClient() && $is_update_client_keywords)
        <li class="active">
            <a data-toggle="tab" href="#new-keywords">
                @lang('custom.add.label')
            </a>
        </li>
    @endif
    <li class="{{!$is_update_client_keywords?'active':''}}">
        <a data-toggle="tab" href="#client-keywords">
            @lang('custom.added.label')
        </a>
    </li>
</ul>


<div class="tab-content">
    <br>
    @if($user->isClient()&& $is_update_client_keywords)
        <div class="tab-pane fade in active" id="new-keywords">
            <textarea name="client_keywords" id="client_keywords"
                      style="margin-top: 55px" rows="15"
                      placeholder="@lang("custom.keywords.placeholder")"
                      @if(!$is_update_client_keywords)
                      disabled="disabled"
                      @endif
                      class="form-control"></textarea>
        </div>
    @endif

    <div class="tab-pane fade {{!$is_update_client_keywords?' in active':''}}" id="client-keywords">

        @foreach($order->clientKeywords as $keywords)
            <div>
                <div class="col-sm-2">
                    <label class="control-label">
                        @lang('custom.count.label')
                        : {{\App\Utils\OrderUtils::getKeywordsCountInString($keywords->keywords)}}
                    </label>
                </div>
                <div class="col-sm-3">
                    @if($user->isTechManager() && $keywords->status!=\App\Classes\enums\KeywordsStatusEnum::CONFIRMED && $order->commitOperation==\App\Classes\enums\OrderOperationsEnum::CONFIRM_CLIENT_KEYWORDS)
                        <select name="added_client_keywords_status-{{$keywords->id}}"
                                id="added_client_keywords_status-{{$keywords->id}}"
                                class="form-control">
                            @foreach (\App\Classes\enums\KeywordsStatusEnum::ALL as $keywordStatus)
                                <option
                                        @if ($keywords->status == $keywordStatus)
                                        selected="selected"
                                        @endif
                                        value="{{$keywordStatus}}">@lang('order.keywords.status.'.$keywordStatus.'.label')</option>
                            @endforeach
                        </select>
                    @else
                        <input class="form-control col-sm-3" type="text" disabled="disabled"
                               value="@lang('order.keywords.status.'.$keywords->status.'.label')"/>
                    @endif
                </div>
                <textarea name="added_client_keywords-{{$keywords->id}}"
                          id="added_client_keywords-{{$keywords->id}}"
                          style="margin-top: 55px" rows="15"
                          placeholder="@lang("custom.keywords.placeholder")"
                          @if($order->commitOperation!=\App\Classes\enums\OrderOperationsEnum::UPDATE_CLIENT_KEYWORDS || $keywords->status==\App\Classes\enums\KeywordsStatusEnum::CONFIRMED)
                          disabled="disabled"
                          @endif
                          class="form-control">{{$keywords->keywords}}</textarea>
            </div>
            <hr>
            <hr>
        @endforeach
    </div>
</div>
