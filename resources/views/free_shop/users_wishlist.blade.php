@extends('layouts.custom.app')

@section('page_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">WishLists From Free Store</h1>
        <div class="row">
            @foreach ($wishlists as $wishlist)
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ $wishlist->item->item_image }}" alt="Item Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $wishlist->item->name }}</h5>
                            <p class="card-text">{{ $wishlist->item->item_category }}</p>
                            <button class="btn btn-primary details-btn" data-toggle="modal" data-target="#detailsModal"
                                data-wishlist-id="{{ $wishlist->id }}">Details</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Wishlist Item Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Wishlist details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <textarea id="adminComment" class="form-control mb-3" placeholder="Admin comment"></textarea>
                    <button type="button" class="btn btn-success btn-approve" data-wishlist-id="">Approve</button>
                    <button type="button" class="btn btn-danger btn-reject" data-wishlist-id="">Reject</button>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('extraJS')
    <script>
        $(document).ready(function() {
            // Load wishlist details in the modal
            $('.details-btn').click(function() {
                var wishlistId = $(this).data('wishlist-id');
                $.ajax({
                    url: '/dashboard/wishlist/details/' +
                        wishlistId, // Update this with your actual URL
                    type: 'GET',
                    success: function(response) {
                        // Assuming 'response' contains the details of the wishlist item, user, and item
                        // Example structure of 'response': { user: {...}, item: {...} }

                        var userDetails = response.user; // Details of the user
                        var itemDetails = response.item; // Details of the item

                        // Populate modal with user and item details
                        var modalContent = '<h5>User Details:</h5>' +
                            '<p>Name: ' + userDetails.name + '</p>' +
                            '<p>Email: ' + userDetails.email + '</p>' +
                            // ... other user details
                            '<h5>Item Details:</h5>' +
                            '<p>Name: ' + itemDetails.name + '</p>' +
                            '<p>Description: ' + itemDetails.description + '</p>';
                        // ... other item details

                        $('#detailsModal .modal-body').html(modalContent);

                        // Update the wishlist ID on the approve/reject buttons
                        $('#detailsModal .btn-approve').data('wishlist-id', wishlistId);
                        $('#detailsModal .btn-reject').data('wishlist-id', wishlistId);

                        // Show the modal
                        $('#detailsModal').modal('show');
                    },
                    // $('#detailsModal .btn-approve').data('wishlist-id', wishlistId);
                    // $('#detailsModal .btn-reject').data('wishlist-id', wishlistId);
                });

                // Handle approve/reject actions
                $('.btn-approve, .btn-reject').click(function() {
                    var wishlistId = $(this).data('wishlist-id');
                    var action = $(this).hasClass('btn-approve') ? 'approve' : 'reject';
                    var adminComment = $('#adminComment').val();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Do you want to ' + action + ' this wishlist item?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, ' + action + ' it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // AJAX request to approve/reject
                            $.ajax({
                                url: '/dashboard/wishlist/' + action,
                                type: 'POST',
                                data: {
                                    wishlistId: wishlistId,
                                    adminComment: adminComment,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    Swal.fire('Updated!',
                                        'The wishlist item has been ' +
                                        action + 'd.', 'success');
                                    // Update UI or reload
                                },
                                error: function() {
                                    Swal.fire('Error!',
                                        'There was an issue updating the wishlist item.',
                                        'error');
                                }
                            });
                        }
                    });
                });
            });
        })
    </script>
@endsection
