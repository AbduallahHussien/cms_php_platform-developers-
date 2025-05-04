<x-core::datagrid>
    <x-core::datagrid.item>
        <x-slot:title>{{ trans('plugins/gift::gift.tables.full_name') }}</x-slot:title>
        {{ $gift->name }}
    </x-core::datagrid.item>

    <x-core::datagrid.item>
        <x-slot:title>{{ trans('plugins/gift::gift.tables.email') }}</x-slot:title>
        {{ Html::mailto($gift->email) }}
    </x-core::datagrid.item>

    @if ($gift->phone)
        <x-core::datagrid.item>
            <x-slot:title>{{ trans('plugins/gift::gift.tables.phone') }}</x-slot:title>
            <a href="tel:{{ $gift->phone }}">{{ $gift->phone }}</a>
        </x-core::datagrid.item>
    @endif

    <x-core::datagrid.item>
        <x-slot:title>{{ trans('plugins/gift::gift.tables.time') }}</x-slot:title>
        {{ $gift->created_at->translatedFormat('d M Y H:i:s') }}
    </x-core::datagrid.item>

    <x-core::datagrid.item>
        <x-slot:title>{{ trans('plugins/gift::gift.tables.address') }}</x-slot:title>
        {{ $gift->address ?: 'N/A' }}
    </x-core::datagrid.item>

    @if ($gift->subject)
        <x-core::datagrid.item>
            <x-slot:title>{{ trans('plugins/gift::gift.tables.subject') }}</x-slot:title>
            {{ $gift->subject }}
        </x-core::datagrid.item>
    @endif
</x-core::datagrid>

<x-core::datagrid.item class="mt-3">
    <x-slot:title>{{ trans('plugins/gift::gift.tables.content') }}</x-slot:title>
    {{ $gift->content ?: '...' }}
</x-core::datagrid.item>
