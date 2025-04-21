@extends('core/base::layouts.master')

@section('content')

    <div class="card">
        <div class="card-header">
            <img src="https://media.istockphoto.com/id/1300845620/vector/user-icon-flat-isolated-on-white-background-user-symbol-vector-illustration.jpg?s=612x612&w=0&k=20&c=yBeyba0hUkh14_jgv1OKqIH0CCSWU_4ckRkAoy2p73o="
                alt="User Icon" width="100" height="100">

            <h4>{{ $customer->name }}</h4>
        </div>
        <div class="card-body">
            <p><strong>{{ __('Phone') }}:</strong> +{{ $customer->phone_code }} {{ $customer->phone }}</p>
            <p><strong>{{ __('Email') }}:</strong> {{ $customer->email }}</p>
        </div>
    </div>



    <div class="card mt-3">
        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="customerTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details"
                        type="button" role="tab" aria-controls="details" aria-selected="true">
                        Data </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tickets-tab" data-bs-toggle="tab" data-bs-target="#tickets" type="button"
                        role="tab" aria-controls="tickets" aria-selected="false">
                        Tickets
                    </button>
                </li>
            </ul>

            <div class="tab-content mt-3" id="customerTabContent">
                <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                    {{-- <p><strong>Email:</strong> {{ $customer->email ?? 'N/A' }}</p>
                        <p><strong>Phone:</strong> {{ $customer->phone ?? 'N/A' }}</p>
                        <p><strong>Created At:</strong> {{ $customer->created_at->format('Y-m-d') }}</p> --}}
                    <p>No details available for this customer.</p>

                </div>

                <div class="tab-pane fade" id="tickets" role="tabpanel" aria-labelledby="tickets-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Created Date</th>
                                    <th>Notes</th>
                                    <th>Follw Ups</th>
                                    <th>Last Follow-up</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customer->tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>{{ $ticket->type }}</td>
                                        <td>{{ ucfirst($ticket->level ?? 'Normal') }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $ticket->status == 'open' ? 'success' : ($ticket->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($ticket->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $ticket->user->username ?? 'Unknown' }}</td>
                                        <td>{{ $ticket->created_at->format('Y-m-d H:i') ?? '-' }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($ticket->description, 50) }}</td>
                                        <td>{{ $ticket->comments->count() ?? '-' }}</td>
                                        @php
                                            $lastFollowUp = $ticket->comments()->latest()->first();
                                        @endphp

                                        <td>
                                            {{ $lastFollowUp && $lastFollowUp->updated_at ? $lastFollowUp->updated_at->format('Y-m-d H:i') : '-' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('tickets.show', $ticket->id) }}"
                                                class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No tickets found for this customer</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
