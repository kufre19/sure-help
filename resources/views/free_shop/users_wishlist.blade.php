@extends('layouts.custom.app')

@section('page_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">WishLists From Free Store </h1>
        <div class="row">
            @foreach ($wishlists as $wishlist)
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ $wishlist->item->image_url }}" alt="Item Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $wishlist->item->name }}</h5>
                            <p class="card-text">{{ $wishlist->item->description }}</p>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#detailsModal" data-wishlist-id="{{ $wishlist->id }}">Details</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

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
  


@endsection


@section('extraJS')
<script>
    $(document).ready(function() {
        $('.btn-approve, .btn-reject').click(function() {
            var wishlistId = $(this).data('wishlist-id');
            var action = $(this).hasClass('btn-approve') ? 'approve' : 'reject';

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to " + action + " this wishlist item?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, ' + action + ' it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // AJAX request to backend route
                    $.ajax({
                        url: '/path-to-your-approve-reject-route', // Update this with your route
                        type: 'POST',
                        data: {
                            wishlistId: wishlistId,
                            action: action,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire(
                                'Updated!',
                                'The wishlist item has been ' + action + 'd.',
                                'success'
                            );
                            // Additional actions on success (e.g., updating the UI)
                        },
                        error: function() {
                            Swal.fire(
                                'Failed!',
                                'There was an error updating the wishlist item.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>


@endsection
