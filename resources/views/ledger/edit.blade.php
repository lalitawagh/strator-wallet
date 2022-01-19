@extends("ledger-foundation::config-skeleton")

@section("title", "Edit Ledger")

@section("config-content")
    <div class="configuration-container">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: Daily Sales -->
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">

                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                        <a href="">Wallet</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        <a href="" class="">Configuration</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        <a href="" class="breadcrumb--active"> Edit Ledger</a>
                    </div>
                </div>
                <div class="p-5">
                    <form action="{{ route('dashboard.ledger-foundation.ledger.update',$ledger->getKey()) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="name" class="form-label sm:w-28">Ledger Name <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') border-theme-6 @enderror"
                                        value="{{ old('name',$ledger->name) }}" required>

                                    @error('name')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="code" class="form-label sm:w-28">Code <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="code" name="code" type="text"
                                        class="form-control @error('code') border-theme-6 @enderror"
                                        value="{{ old('code',$ledger->code) }}" required>

                                    @error('code')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="ledger_type" class="form-label sm:w-28">Ledger Type <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    @php $ledger_types = \Kanexy\LedgerFoundation\Http\Enums\LedgerTypeEnum::toArray(); @endphp
                                    <select name="ledger_type" id="ledger_type" data-search="true" class="tail-select w-full @error('ledger_type') border-theme-6 @enderror">
                                        @foreach($ledger_types as $key => $ledger_type)
                                            <option value="{{$key}}" @if(old("ledger_type",$ledger->ledger_type) ) selected @endif>{{ ucfirst(strtolower($ledger_type)) }}</option>
                                        @endforeach
                                    </select>
                                    @error('ledger_type')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="symbol" class="form-label sm:w-28">Symbol</label>
                                <div class="sm:w-5/6">
                                    <input id="symbol" name="symbol" type="symbol"
                                        class="form-control @error('symbol') border-theme-6 @enderror"
                                        value="{{ old('symbol',$ledger->symbol) }}">

                                    @error('symbol')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="exchange_type" class="form-label sm:w-28">Exchange Type <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    @php $exchange_types = \Kanexy\LedgerFoundation\Http\Enums\ExchangeTypeEnum::toArray(); @endphp
                                    <select name="exchange_type" id="exchange_type"  data-search="true" class="tail-select w-full @error('exchange_type') border-theme-6 @enderror">
                                        @foreach($exchange_types as $key => $exchange_type)
                                            <option value="{{$key}}" @if(old("exchange_type",$ledger->exchange_type) ) selected @endif>{{ ucwords(str_replace('_', ' ', $exchange_type)) }}</option>
                                        @endforeach
                                    </select>
                                    @error('exchange_type')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="exchange_rate" class="form-label sm:w-28">Exchange Rate <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="exchange_rate" name="exchange_rate" type="text"
                                        class="form-control @error('exchange_rate') border-theme-6 @enderror"
                                        value="{{ old('exchange_rate',$ledger->exchange_rate) }}"  onKeyPress="if(this.value.length==11) return false;" required>

                                    @error('exchange_rate')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="asset_category" class="form-label sm:w-28">Asset Category <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    @php $asset_categories = \Kanexy\LedgerFoundation\Http\Enums\AssetCategoryEnum::toArray(); @endphp
                                    <select name="asset_category" onchange="getAssetCategory(this)" id="asset_category" data-search="true" class="tail-select w-full @error('asset_category') border-theme-6 @enderror">
                                        @foreach($asset_categories as $key => $asset_category)
                                            <option value="{{$key}}" @if(old('asset_category',$ledger->asset_category) == $key) selected @endif>{{ ucwords(str_replace('_', ' ', $asset_category)) }}</option>
                                        @endforeach
                                    </select>
                                    @error('asset_category')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="exchange_from" class="form-label sm:w-28">Exchange From  <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select name="exchange_from" id="exchange_from" data-search="true" class="tail-select w-full @error('exchange_from') border-theme-6 @enderror">
                                        <option value="Railsbank" @if(old("exchange_from",$ledger->exchange_from) ) selected @endif>Railsbank</option>
                                        <option value="local" @if(old("exchange_from",$ledger->exchange_from) ) selected @endif>Local</option>
                                    </select>

                                    @error('exchange_from')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="asset_type" class="form-label sm:w-28"> Asset Type <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select name="asset_type" id="asset_type" data-search="true" class="tail-select w-full @error('asset_type') border-theme-6 @enderror">
                                        @foreach ($asset_types as $asset_type)
                                            <option value="{{$asset_type->id}}" @if(old('asset_type',$ledger->asset_type) == $asset_type->id) selected @endif>{{ ucfirst($asset_type->name) }}</option>
                                        @endforeach
                                    </select>

                                    @error('asset_type')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="logo" class="form-label sm:w-28"> Logo <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input type="file" class="form-control" name="image">
                                    <img class="rounded-md proof-default" style="width:100px;" alt="" src="{{ \Illuminate\Support\Facades\Storage::disk('s3')->temporaryUrl($ledger->image, now()->addMinutes(5)) }}">
                                    @error('image')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="asset_class" class="form-label sm:w-28"> Asset Class <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select name="asset_class" id="asset_class" data-search="true" class="tail-select w-full @error('asset_class') border-theme-6 @enderror">
                                        @foreach ($asset_classes as $asset_class)
                                            <option value="{{$asset_class->id}}" @if(old('asset_class',$ledger->asset_class) == $asset_class->id) selected @endif>{{ ucfirst($asset_class->name) }}</option>
                                        @endforeach
                                    </select>

                                    @error('asset_class')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="commodity_category" class="form-label sm:w-28"> Commodity Category <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select name="commodity_category" id="commodity_category" data-search="true" class="tail-select w-full @error('commodity_category') border-theme-6 @enderror">
                                        @foreach ($commodity_types as $commodity_type)
                                            <option value="{{$commodity_type->id}}" @if(old('commodity_category',$ledger->commodity_category) == $commodity_type->id) selected @endif>{{ ucfirst($commodity_type->name) }}</option>
                                        @endforeach
                                    </select>

                                    @error('commodity_category')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="status" class="form-label sm:w-28"> Active<span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select name="status" id="status" data-search="true" class="tail-select w-full">
                                        <option value="new" @if(old("status",$ledger->status)  === 'new') selected @endif>New</option>
                                        <option value="active" @if(old("status",$ledger->status)  === 'active') selected @endif>Active</option>
                                        <option value="hold" @if(old("status",$ledger->status)  === 'hold') selected @endif>Hold</option>
                                        <option value="suspended" @if(old("status",$ledger->status)  === 'suspended') selected @endif>Suspended</option>
                                    </select>

                                    @error('status')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-5">
                            <button type="submit" class="btn btn-primary w-24">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Daily Sales -->

        </div>
    </div>
@endsection
