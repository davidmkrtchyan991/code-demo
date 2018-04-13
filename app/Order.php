<?php

namespace App;

use App\Classes\enums\OrderStatusEnum;
use App\Utils\ChecklistItemUtils;
use App\Utils\OrderUtils;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Order extends Model
{

    protected $dates = [
        'created_at',
        'updated_at',
        'startDate',
        'endDate'
    ];

    public $isEditable = false;
    public $isAssignChecklist = false;
    public $operations = [];
    public $commitOperation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'companyName',
        'email',
        'userName',
        'domain',
        'mobNumber',
        'additionalMobNumber',
        'offerNumber',
        'comment',
        'keywords',
        'startDate',
        'endDate',

        'ftpHost',
        'ftpPort',
        'ftpLogin',
        'ftpPassword',
        'ftpCmsUrl',
        'ftpCmsLogin',
        'ftpCmsPassword'
    ];


    /* relationships*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }

    public function optimizer()
    {
        return $this->belongsTo(User::class);
    }

    public function checklists()
    {
        return $this->hasMany(OrderChecklist::class);
    }

    public function exceptionalChecklistItems()
    {
        return $this->hasMany(OrderExceptionalChecklistsItem::class);
    }

    public function clientKeywords()
    {
        return $this->hasMany(ClientKeywords::class);
    }

    public function history()
    {
        return $this->hasMany(OrderHistoryRecord::class);
    }

    /*parent relations setters*/

    public function setOrderTariff($tariff)
    {
        $this->tariff()->associate($tariff);
    }

    public function setOrderUser($user)
    {
        $this->user()->associate($user);
    }

    public function setOrderOptimizer($user)
    {
        $this->optimizer()->associate($user);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->status = OrderStatusEnum::REGISTERED;
            $model->orderNumber = ($model->domain . "-" . Uuid::generate(4)->string);
            $model->keywords = (rtrim(trim($model->keywords), ','));
        });

        self::updating(function ($model) {
            $model->keywords = (rtrim(trim($model->keywords), ','));
        });

        self::retrieved(function ($model) {
            OrderUtils::initOperations($model);
        });
    }

    /* Scopes */
    public function scopeExisting($query)
    {
        return $query->whereNotNull('id');
    }

    public function scopeWithTariff($query, $tariff)
    {
        return $query->whereHas('tariff', function ($q) use ($tariff) {
            $q->where('name', $tariff);
        });
    }

    public function scopeWithTariffID($query, $tariffId)
    {
        return $query->whereHas('tariff', function ($q) use ($tariffId) {
            $q->where('id', $tariffId);
        });
    }

    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', '!=', 'COMPLETED');
    }

    public function scopeInDateRange($query, $from, $to)
    {
        return $query->whereBetween('created_at', array($from, $to));
    }

    public function scopeAfterDate($query, $from)
    {
        return $query->where('created_at', '>=', $from);
    }

    public function scopeBeforeDate($query, $to)
    {
        return $query->where('created_at', '<=', $to);
    }

    public function scopeOfClient($query, $email)
    {
        return $query->whereHas('user', function ($q) use ($email) {
            $q->where('email', $email);
        });
    }

    public function scopeWithDomain($query, $domain)
    {
        return $query->where('domain', $domain);
    }

    public function scopeWithOptimizer($query, $userId)
    {
        return $query->whereHas('optimizer', function ($q) use ($userId) {
            $q->where('id', $userId);
        });
    }

    public function scopeWithUser($query, $userId)
    {
        return $query->whereHas('user', function ($q) use ($userId) {
            $q->where('id', $userId);
        });
    }

    public function hasChecklists()
    {
        return $this->checklists->count();
    }


    public function getAllChecklistsItems()
    {
        ChecklistItemUtils::getAllItemsForOrder($this);
    }
}
