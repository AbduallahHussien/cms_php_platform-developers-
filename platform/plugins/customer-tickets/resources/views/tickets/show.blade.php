@extends($layout ?? BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="card">


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Customer Name</th>
                            <th>Type</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Created Date</th>
                            <th>Last Follow-up</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $ticket->customer->name ?? '-' }}</td>
                            <td>{{ $ticket->type ?? '-' }}</td>
                            <td>{{ ucfirst($ticket->level ?? 'Normal') }}</td>
                            <td>
                                <span class="badge bg-{{ $ticket->status == 'open' ? 'success' : ($ticket->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>
                            <td>{{ $ticket->user->username ?? '-' }}</td>
                            <td>{{ $ticket->created_at->format('Y-m-d') ?? '-' }}</td>
                            <td>{{ optional($ticket->comments()->latest()->first())->updated_at->format('Y-m-d H:i') ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr>

            <h5>Description:</h5>
            <div class="border p-3 mb-4">
                {{ $ticket->description ?? 'No description available.' }}
            </div>

            <h5>Follow Ups ({{ $ticket->comments->count() }}):</h5>
            <div class="list-group">
                @forelse($ticket->comments as $comment)
                    <div class="list-group-item">
                        <p>{{ $comment->text }}</p>
                        <small class="text-muted">{{ $comment->created_at->format('Y-m-d H:i') }}</small>
                    </div>
                @empty
                    <p class="text-muted">No Follow ups yet.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
