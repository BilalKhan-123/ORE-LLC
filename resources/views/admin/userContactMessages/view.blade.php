@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            {{-- <h1>{{ __('messages.edit_department') ?? 'Edit Department' }}</h1> --}}
            <h1>View Message</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.user-contacts.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th width="200"><strong>Name</strong></th>
                        <td>{{ $userContactMessage->name }}</td>
                    </tr>
                    <tr>
                        <th><strong>Gender</strong></th>
                        <td>{{ $userContactMessage->gender }}</td>
                    </tr>
                    <tr>
                        <th><strong>Email</strong></th>
                        <td>{{ $userContactMessage->email }}</td>
                    </tr>
                    <tr>
                        <th><strong>Subject</strong></th>
                        <td>{{ $userContactMessage->subject }}</td>
                    </tr>
                    <tr>
                        <th><strong>Message</strong></th>
                        <td>{{ $userContactMessage->message }}</td>
                    </tr>
                    <tr>
                        <th><strong>Is Responded</strong></th>
                        <td>{{ $userContactMessage->is_responded ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <th><strong>Responded At</strong></th>
                        <td>{{ $userContactMessage->responded_at ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th><strong>Responded By</strong></th>
                        <td>{{ $userContactMessage->responded_by ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th><strong>Show on Website</strong></th>
                        <td>{{ $userContactMessage->is_show ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <th><strong>IP Address</strong></th>
                        <td>{{ $userContactMessage->ip_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th><strong>Created At</strong></th>
                        <td>{{ $userContactMessage->created_at ? $userContactMessage->created_at->format('M d, Y h:i A') : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th><strong>Updated At</strong></th>
                        <td>{{ $userContactMessage->updated_at ? $userContactMessage->updated_at->format('M d, Y h:i A') : 'N/A' }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
