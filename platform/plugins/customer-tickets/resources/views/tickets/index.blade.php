@extends($layout ?? BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="mb-4">
        <div class="row">
            @php
                $colors = ['primary', 'info', 'success', 'warning', 'secondary', 'danger'];
                $labels = ['Total Tickets', 'Open', 'Answered', 'In Progress', 'Pending', 'Closed'];

                $statsOption = $table->getOptions('stats') ?? [];

                $values = [
                    $statsOption['total'] ,
                    $statsOption['open'] ,
                    $statsOption['answered'] ,
                    $statsOption['inProgress'],
                    $statsOption['pending'],
                    $statsOption['closed'],
                ];
            @endphp

            @foreach ($labels as $index => $label)
                <div class="col-md-2">
                    <div class="card text-white bg-{{ $colors[$index] }} mb-3 mr-5">
                        <div class="card-body">
                            <h5 class="card-title">{{ $label }}</h5>
                            <p class="card-text">{{ $values[$index] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('core/table::base-table')
@endsection

