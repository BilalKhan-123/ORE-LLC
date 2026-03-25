@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            {{-- <h1>{{ __('messages.departments') ?? 'Departments' }}</h1> --}}
            <h1>Users Contact Messages</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.user-contacts.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Gender</th>
                        <th>Show on website</th>
                        <th width="300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($userContactMessages ?? [] as $userContactMessage)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $userContactMessage->name }}</td>
                            <td>{{ $userContactMessage->email }}</td>
                            <td>{{ Str::limit($userContactMessage->subject, 100) }}</td>
                            <td>{{ $userContactMessage->gender }}</td>
                            <td>
                                @if($userContactMessage->is_show)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                     <a href="{{ route('admin.user-contacts.show', $userContactMessage->id) }}" class="btn btn-sm btn-primary"> 
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#respondModal{{ $userContactMessage->id }}">
                                         
                                        <i class="fas fa-edit"></i> Respond
                                    </a>
                                    <form action="{{ route('admin.user-contacts.destroy', $userContactMessage->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <!-- Bootstrap Modal -->
                        <!-- Bootstrap Modal -->
                        <div class="modal fade" id="respondModal{{ $userContactMessage->id }}" tabindex="-1" aria-labelledby="respondModalLabel" aria-hidden="true">
                        <div class="modal-dialog model-lg">
                            <div class="modal-content">
                            
                            <div class="modal-header">
                                <h5 class="modal-title" id="respondModalLabel">Send Response {{ $userContactMessage->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <!-- Text Input -->
                                <div class="mb-3">
                                <label for="response_title" class="form-label"><strong>Subject</strong></label>
                                <input type="text" class="form-control" id="response_title" name="response_title" required>
                                </div>

                                <!-- Textarea -->
                                <div class="mb-3">
                                <label for="response_message" class="form-label"><strong>Response</strong></label>
                                <textarea class="form-control" id="response_message" name="response_message" rows="4" required></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success" id="sendResponseBtn">Send</button>
                            </div>

                            </div>
                        </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         @if($userContactMessages->hasPages())
            <div class="card-footer px-5">
                <div class="d-flex justify-content-center">
                    {{ $userContactMessages->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>
<script>
    <script>
    $(document).ready(function () {
        $('#sendResponseBtn').on('click', function () {
            let title = $('#response_title').val();
            let message = $('#response_message').val();

            $.ajax({
                url: "{{ route('admin.user-contacts.send-respond', $userContactMessage->id) }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    response_title: title,
                    response_message: message
                },
                success: function (response) {
                    // Show success message
                    alert("Response sent successfully!");
                    $('#respondModal').modal('hide');
                    // Optionally reload page or update UI dynamically
                    location.reload();
                },
                error: function (xhr) {
                    // Show error message
                    alert("Something went wrong. Please try again.");
                }
            });
        });
    });
</script>

</script>
@endsection
