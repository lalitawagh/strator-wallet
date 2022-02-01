@extends("ledger-foundation::config-skeleton")

@section("title", "Exchange Rate")

@section("config-content")
    <div class="configuration-container">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: Daily Sales -->
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">

                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                        <a href="">Wallet</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        <a href="" class="">Configuration</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        <a href="" class="breadcrumb--active">Edit Exchange rate</a>
                    </div>
                </div>
                <div class="p-5">
                    @if (Session::has('error'))
                    <span class="block text-theme-6">{{ Session::get('error') }}</span>
                    @endif
                    <form action="{{ route('dashboard.ledger-foundation.exchange-rate.update',$exchange_rate->getKey()) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="base_currency" class="form-label sm:w-28">Ledger <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">

                                        <select name="base_currency" id="base_currency" class="tail-select">
                                            @foreach ($ledgers as $ledger)
                                                <option value="{{ $ledger->getKey() }}" @if($exchange_rate->base_currency == $ledger->getKey()) selected @endif>{{ $ledger->name }}</option>
                                            @endforeach
                                        </select>

                                    @error('base_currency')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="exchange_currency" class="form-label sm:w-28">Exchange Currency <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select name="exchange_currency" id="exchange_currency" class="tail-select">
                                        @foreach ($asset_types as $asset_type)
                                            <option value="{{ $asset_type['id'] }}" @if($exchange_rate->exchange_currency == $asset_type['id']) selected @endif>{{ $asset_type['name'] }}</option>
                                        @endforeach
                                    </select>

                                    @error('exchange_currency')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="frequency" class="form-label sm:w-28">Frequency <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">

                                    <select name="frequency" id="frequency" data-search="true" class="tail-select w-full @error('frequency') border-theme-6 @enderror">
                                       <option value="daily" @if($exchange_rate->frequency == 'daily') selected @endif>Daily</option>
                                       <option value="weekly" @if($exchange_rate->frequency == 'weekly') selected @endif>Weekly</option>
                                       <option value="monthly" @if($exchange_rate->frequency == 'monthly') selected @endif>Monthly</option>
                                       <option value="quarterly" @if($exchange_rate->frequency == 'quarterly') selected @endif>Quarterly</option>
                                       <option value="yearly" @if($exchange_rate->frequency == 'yearly') selected @endif>Yearly</option>
                                    </select>

                                    @error('frequency')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="valid_date" class="form-label sm:w-28">Valid Date</label>
                                <div class="sm:w-5/6">
                                    <input id="valid_date" name="valid_date" type="date"
                                        class="form-control @error('valid_date') border-theme-6 @enderror"
                                        value="{{ old('valid_date',$exchange_rate->valid_date) }}">

                                    @error('valid_date')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="exchange_fee" class="form-label sm:w-28">Exchange Fee  <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="exchange_fee" name="exchange_fee" type="text"
                                        class="form-control @error('exchange_fee') border-theme-6 @enderror"
                                        value="{{ old('exchange_fee',$exchange_rate->exchange_fee) }}"   required>

                                    @error('exchange_fee')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="exchange_rate" class="form-label sm:w-28">Exchange Rate <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="exchange_rate" name="exchange_rate" type="text"
                                        class="form-control @error('exchange_rate') border-theme-6 @enderror"
                                        value="{{ old('exchange_rate',$exchange_rate->exchange_rate) }}"   required>

                                    @error('exchange_rate')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="note" class="form-label sm:w-28"> Note </label>
                                <div class="sm:w-5/6">
                                    <input type="text" class="form-control" name="note" value="{{ old('note',$exchange_rate->note)}}">

                                    @error('note')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="is_hard_stop" class="form-label sm:w-28">Hard Stop</label>
                                <div class="sm:w-5/6">
                                    <input id="is_hard_stop" name="is_hard_stop" type="checkbox" class="form-check-switch" @if(old("is_hard_stop",$exchange_rate->is_hard_stop)  === 1) checked @endif>

                                    @error('is_hard_stop')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="text-right mt-5">
                            <a href="#" class="btn btn-secondary w-24 inline-block mr-1">Cancel</a>
                            <button type="submit" class="btn btn-primary w-24">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

