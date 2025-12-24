<x-admin::layouts>
    <!-- Page Title -->
    <x-slot:title>
        @lang('admin::app.sales.orders.trash.title')
    </x-slot>

    <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
        <p class="py-3 text-xl font-bold text-gray-800 dark:text-white">
            @lang('admin::app.sales.orders.trash.title')
        </p>

        <div class="flex items-center gap-x-2.5">
            <a href="{{ route('admin.sales.orders.index') }}" class="secondary-button">
                @lang('admin::app.sales.orders.trash.back-to-orders')
            </a>
        </div>
    </div>

    <x-admin::datagrid :src="route('admin.sales.orders.trash')" :isMultiRow="true">
        <template #header="{
            isLoading,
            available,
            applied,
            selectAll,
            sort,
            performAction
        }">
            <template v-if="isLoading">
                <x-admin::shimmer.datagrid.table.head :isMultiRow="true" />
            </template>

            <template v-else>
                <div class="row grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 items-center border-b px-2 sm:px-4 py-2.5 dark:border-gray-800">
                    <div
                        class="flex select-none items-center gap-2.5"
                        v-for="(columnGroup, index) in [['increment_id', 'created_at', 'deleted_at', 'status'], ['base_grand_total', 'method', 'channel_id'], ['full_name', 'customer_email', 'location'], ['items']]"
                    >
                        <p class="text-gray-600 dark:text-gray-300 text-sm sm:text-base">
                            <span class="[&>*]:after:content-['_/_']">
                                <template v-for="column in columnGroup">
                                    <span
                                        class="after:content-['/'] last:after:content-['']"
                                        :class="{
                                            'font-medium text-gray-800 dark:text-white': applied.sort.column == column,
                                            'cursor-pointer hover:text-gray-800 dark:hover:text-white': available.columns.find(columnTemp => columnTemp.index === column)?.sortable,
                                        }"
                                        @click="
                                            available.columns.find(columnTemp => columnTemp.index === column)?.sortable ? sort(available.columns.find(columnTemp => columnTemp.index === column)) : {}
                                        "
                                    >
                                        @{{ available.columns.find(columnTemp => columnTemp.index === column)?.label }}
                                    </span>
                                </template>
                            </span>

                            <i
                                class="align-text-bottom text-base text-gray-800 dark:text-white ltr:ml-1.5 rtl:mr-1.5"
                                :class="[applied.sort.order === 'asc' ? 'icon-down-stat': 'icon-up-stat']"
                                v-if="columnGroup.includes(applied.sort.column)"
                            >
                            </i>
                        </p>
                    </div>
                </div>
            </template>
        </template>

        <template #body="{
            isLoading,
            available,
            applied,
            selectAll,
            sort,
            performAction
        }">
            <template v-if="isLoading">
                <x-admin::shimmer.datagrid.table.body :isMultiRow="true" />
            </template>

            <template v-else>
                <div
                    class="row grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-y-4 border-b px-2 sm:px-4 py-2.5 transition-all hover:bg-gray-50 dark:border-gray-800 dark:hover:bg-gray-950"
                    v-for="record in available.records"
                >
                    <div class="flex flex-col gap-1.5">
                        <p class="text-sm sm:text-base font-semibold text-gray-800 dark:text-white">
                            @{{ "@lang('admin::app.sales.orders.index.datagrid.id')".replace(':id', record.increment_id) }}
                        </p>

                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">
                            @{{ record.created_at }}
                        </p>

                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">
                            @lang('admin::app.sales.orders.trash.datagrid.deleted-at') @{{ record.deleted_at }}
                        </p>
                        
                        <p v-html="record.status"></p>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <p class="text-sm sm:text-base font-semibold text-gray-800 dark:text-white">
                            @{{ $admin.formatPrice(record.base_grand_total) }}
                        </p>

                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">
                            @lang('admin::app.sales.orders.index.datagrid.pay-by', ['method' => ''])@{{ record.method }}
                        </p>

                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">
                            @{{ record.channel_name }}
                        </p>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <p class="text-sm sm:text-base text-gray-800 dark:text-white">
                            @{{ record.full_name }}
                        </p>

                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">
                            @{{ record.customer_email }}
                        </p>

                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">
                            @{{ record.location }}
                        </p>
                    </div>

                    <div class="flex items-center justify-between gap-x-2">
                        <div
                            class="flex flex-col gap-1.5 text-xs sm:text-sm"
                            v-html="record.items"
                        >
                        </div>

                        <a :href=`{{ route('admin.sales.orders.view', '') }}/${record.id}`>
                            <span class="icon-sort-right rtl:icon-sort-left cursor-pointer p-1.5 text-xl sm:text-2xl hover:rounded-md hover:bg-gray-200 dark:hover:bg-gray-800 ltr:ml-1 rtl:mr-1"></span>
                        </a>
                    </div>
                </div>
            </template>
        </template>
    </x-admin::datagrid>
</x-admin::layouts>
