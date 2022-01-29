@extends("ledger-foundation::config-skeleton")

@section('title', 'Asset Class')

@section('config-content')
    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <div class="intro-y box">
            <div class="box">
                <div class="flex items-center py-2 px-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Asset Class
                    </h2>

                    <div>
                        <a href="{{ route('dashboard.ledger-foundation.asset-class.create') }}"
                            class="btn btn-sm btn-primary shadow-md">Create New</a>
                    </div>
                </div>

                <div class="p-5">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Name</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Image</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Status</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asset_class_lists as $index => $asset_class_list)
                                    <tr>
                                        <td class="border-b dark:border-dark-5">{{ $index + 1 }}</td>
                                        <td class="border-b dark:border-dark-5">{{ $asset_class_list['name'] }}</td>
                                        <td class="border-b dark:border-dark-5"><img class="rounded-md proof-default"
                                                style="width:100px;" alt=""
                                                src="@isset($asset_class_list['image']){{ \Illuminate\Support\Facades\Storage::disk('azure')->url($asset_class_list['image']) }}@endisset">
                                            </td>
                                            <td class="border-b dark:border-dark-5"> {{ trans('ledger-foundation::configuration.'.$asset_class_list['status']); }}
                                            </td>
                                            <td class="border-b dark:border-dark-5">
                                                <div class="dropdown">
                                                    <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                        <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                                                    </button>

                                                    <div class="dropdown-menu w-48">
                                                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                            <a href="{{ route('dashboard.ledger-foundation.asset-class.edit', $asset_class_list['id']) }}"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> Edit
                                                            </a>
                                                            <form
                                                                action="{{ route('dashboard.ledger-foundation.asset-class.destroy', $asset_class_list['id']) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit"
                                                                    class="w-full flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-red-200 dark:hover:bg-dark-2 rounded-md">
                                                                    <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
