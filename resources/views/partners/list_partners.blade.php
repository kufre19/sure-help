@extends('layouts.custom.app')

@section('page_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Parner Lists</h1>

    </div>
    <!-- /.container-fluid -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($partners as $user)
                <tr>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <button class="view-user" data-user-id="{{ $user->id }}">View</button>
                        <a href="{{ url('dashboard/account/edit/' . $user->id) }}" class="btn btn-primary">View</a>
                        <form action="{{ url('dashboard/account/delete/'.$user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach --}}
            <tr>

                <td>Partner name</td>
        
                <td>
                    <button class="view-user btn btn-primary" data-user-id="1">View</button>
                    {{-- <a href="{{ url('dashboard/account/edit/' . $user->id) }}" class="btn btn-primary">View</a> --}}
                    {{-- <form action="{{ url('dashboard/account/delete/'.$user->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form> --}}
                </td>
            </tr>
        </tbody>
    </table>

    {{-- {{ $users->links() }} --}}

    <!-- Define the modal that will display user details -->
    <div class="modal fade" id="user-modal" tabindex="-1" aria-labelledby="user-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="user-modal-label">User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <div class="modal-body">
                    <div id="user-details">
                        <h4 id="partner-name"></h4>
                        <p id="partner-order-details"></p>
                        <img id="partner-image" alt="Profile Picture">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('extraJS')
    <script>
        $(document).ready(function() {
            // When a "View" button is clicked, fetch the user details and display them in a modal
            $('.view-user').click(function() {
                var userId = $(this).data('user-id');
                $.ajax({
                    url: "{{url('dashboard/partners/view/')}}" +"/"+ userId,
                    method: 'GET',
                    success: function(response) {
                        // / <td>{ $user->role }}</td>/ Populate the user details in the modal
                        // $('#user-details').html(response.html);
                        $('#partner-name').html(response.name);
                        $('#partner-order-details').html(response.other_details);
                        $('#partner-image').attr('src',response.image);
                        


                        // Display the modal
                        $('#user-modal').modal('show');
                    }
                });
            });
        });
    </script>
@endsection
