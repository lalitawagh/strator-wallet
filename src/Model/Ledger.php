<?php

namespace Kanexy\LedgerFoundation\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kanexy\LedgerFoundation\Enums\Permission;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Ledger extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'code',
        'ledger_type',
        'symbol',
        'exchange_type',
        'exchange_rate',
        'exchange_from',
        'asset_category',
        'asset_class',
        'asset_type',
        'commodity_category',
        'image',
        'payout_fee',
        'deposit_fee',
        'withdraw_fee',
        'status',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('Wallet-Ledger')->logOnly(['*'])->logOnlyDirty();
        // Chain fluent methods for configuration options
    }

    public static function setPagination()
    {
        return true;
    }

    public static function setBulkActions()
    {
        return false;
    }

    public static function setBuilder($type): Builder
    {
        return Ledger::query()->latest();
    }

    public static function columns()
    {

        return [
            Column::make("Id", "id")->hideIf(true),

            Column::make("Name", "name")
                ->sortable()
                ->searchable()
                ->secondaryHeaderFilter('name'),

            Column::make("Image", "image")->format(function ($value,$modal) {
                if(isset($modal->image)){
                    return '<img class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden rounded-md proof-default" src="'.\Illuminate\Support\Facades\Storage::disk('azure')->temporaryUrl($modal->image, now()->addMinutes(5)).'">';
                }
            })
                ->sortable()
                ->searchable()
                ->html(),


            Column::make("Ledger Type", "ledger_type")->format(function ($value) {
                return trans('ledger-foundation::configuration.' . $value);
            })
                ->searchable()
                ->secondaryHeaderFilter('ledger_type')
                ->sortable(),

            Column::make("Exchange Type", "exchange_type")->format(function ($value) {
                return trans('ledger-foundation::configuration.' . $value);
            })
                ->searchable()
                ->sortable()
                ->secondaryHeaderFilter('exchange_type'),

            Column::make("Asset Category", "asset_category")->format(function ($value) {
                return trans('ledger-foundation::configuration.' . $value);
            })
                ->searchable()
                ->sortable()
                ->secondaryHeaderFilter('asset_category'),

            Column::make("Asset Type", "asset_type")->format(function ($value, $model) {
                $assetType = collect(\Kanexy\Cms\Setting\Models\Setting::getValue('asset_types', []))->firstWhere('id', $model->asset_type);
                return @$assetType['name'];
            })
                    ->searchable()
                    ->sortable()
                    ->secondaryHeaderFilter('asset_type'),

            Column::make("Asset Class", "asset_class")->format(function ($value, $model) {
                $assetClass = collect(\Kanexy\Cms\Setting\Models\Setting::getValue('asset_classes', []))->firstWhere('id', $model->asset_class);
                return @$assetClass['name'];
            })
                ->sortable()
                ->searchable()
                ->secondaryHeaderFilter('asset_class'),

            Column::make("Status", "status")->format(function ($value) {
                return trans('ledger-foundation::configuration.' . $value);
            })
                ->searchable()
                ->secondaryHeaderFilter('status')
                ->sortable(),

            Column::make('Actions','id')->format(function($value, $model, $row) {
                $actions = [];
                if (\Illuminate\Support\Facades\Auth::user()->hasPermissionTo(Permission::LEDGER_EDIT) || \Illuminate\Support\Facades\Auth::user()->hasPermissionTo(Permission::LEDGER_DELETE)){
                    if (\Illuminate\Support\Facades\Auth::user()->hasPermissionTo(Permission::LEDGER_EDIT)){
                        $actions[] = ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="edit-2" data-lucide="edit-2" class="lucide lucide-edit-2 w-4 h-4 mr-2"><path d="M17 3a2.828 2.828 0 114 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>','isOverlay' => '0','route' => route('dashboard.wallet.ledger.edit', $value),'method' => 'GET','action' => 'Edit'];
                    }
                    if (\Illuminate\Support\Facades\Auth::user()->hasPermissionTo(Permission::LEDGER_DELETE)){
                        $actions[] = ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash" data-lucide="trash" class="lucide lucide-trash w-4 h-4 mr-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path></svg>','isOverlay' => 'true','method' => 'GET','action' => "Delete",'route' => "Livewire.emit('showModal','".route('dashboard.wallet.ledger.destroy',$model->id)."','DELETE','x-circle','Delete')"];
                    }
                }
                return view('cms::livewire.datatable-actions', ['actions' => $actions])->withUser($row);
            })

        ];
    }

    public static function setFilters()
    {
        return [
            SelectFilter::make('Status')
                ->options([
                    '' => 'All',
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                    'new' => 'New',
                ])
                ->filter(function (Builder $builder, string $value) {

                    $builder->where('status', $value);
                }),


        ];

    }
}
