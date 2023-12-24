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
            @foreach ($partners as $partner)
            <tr>
                <td>{{ $partner->fullname }}</td>
                <td>
                    <!-- Replace '#viewModal' with the ID of your modal for viewing partner details -->
                    <button class="btn btn-primary view-user" data-user-id="{{ $partner->id }}" data-toggle="modal" data-target="#viewModal">View</button>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>

    {{ $partners->links() }}

    <!-- Define the modal that will display user details -->
    <!-- User Details and Help Offered Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Partner Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Partner Details Column -->
                        <div class="col-md-6">
                            <img id="partnerImage" src="" alt="Profile Picture" class="img-fluid">
                            <h4 id="partnerName"></h4>
                            <!-- Other partner details here -->
                        </div>
                        <!-- Help Offered List Column -->
                        <div class="col-md-6">
                            <div class="help-list" style="max-height: 400px; overflow-y: auto;">
                                <!-- Dynamically loaded list of help titles -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                // Clear previous data
                $('#userModal .help-list').empty();

                $.ajax({
                    url: "{{ url('dashboard/partners/view/') }}" + "/" + userId,
                    method: 'GET',
                    success: function(response) {
                        // Populate the user details
                        $('#partnerName').text(response.name);
                        $('#partnerImage').attr('src', response.image);

                        // Assuming 'response.help_offered' contains an array of help objects
                        response.help_offered.forEach(function(help) {
                            var listItem = $('<div class="help-item"></div>');
                            listItem.text(help.help_title);
                            // Add other help details if necessary
                            $('#userModal .help-list').append(listItem);
                        });

                        // Display the modal
                        $('#userModal').modal('show');
                    }
                });
            });

        });
    </script>
@endsection
