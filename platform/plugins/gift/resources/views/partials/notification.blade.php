<div class="nav-item dropdown d-none d-md-flex me-2">
    <button
        class="nav-link px-0"
        data-bs-toggle="dropdown"
        type="button"
        aria-label="{{ trans('plugins/gift::gift.dropdown_show_label') }}"
        tabindex="-1"
    >
        <x-core::icon name="ti ti-mail" />
        <span class="badge bg-red text-red-fg badge-pill">{{ number_format($gifts->count()) }}</span>
    </button>
    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
        <x-core::card>
            <x-core::card.header>
                <x-core::card.title>{!! BaseHelper::clean(trans('plugins/gift::gift.new_msg_notice', ['count' => $gifts->count()])) !!}</x-core::card.title>
                <x-core::card.actions>
                    <a href="{{ route('gifts.index') }}">{{ trans('plugins/gift::gift.view_all') }}</a>
                </x-core::card.actions>
            </x-core::card.header>
            <div
                class="list-group list-group-flush list-group-hoverable overflow-auto"
                style="max-height: 35rem"
            >
                @foreach ($gifts as $gift)
                    <a href="{{ route('gifts.edit', $gift->id) }}" class="text-decoration-none">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-auto">
                                    <img
                                        class="avatar"
                                        src="{{ $gift->avatar_url }}"
                                        alt="{{ $gift->email }}"
                                    >
                                </div>
                                <div class="col align-items-center">
                                    <p class="text-truncate mb-2">
                                        {{ $gift->email }}
                                        <time
                                            class="small text-muted"
                                            title="{{ $createdAt = BaseHelper::formatDateTime($gift->created_at) }}"
                                            datetime="{{ $createdAt }}"
                                        >
                                            {{ $createdAt }}
                                        </time>
                                    </p>
                                    <p class="text-secondary text-truncate mt-n1 mb-0">
                                        {{ implode(' - ', [$gift->email, $gift->email]) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @if ($gifts->count() > 10)
                <x-core::card.footer class="text-center border-top">
                    <a href="{{ route('gifts.index') }}">{{ trans('plugins/gift::gift.view_all') }}</a>
                </x-core::card.footer>
            @endif
        </x-core::card>
    </div>
</div>
