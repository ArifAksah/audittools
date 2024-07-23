
    <div class="container">
        <div class="card">
            <div class="card-header">
                Notification Detail
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $notification->message }}</h5>
                <p class="card-text">{{ $notification->created_at }}</p>
                <a href="{{ route('notifications.read', $notification->id) }}" class="btn btn-primary">Mark as Read</a>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>

