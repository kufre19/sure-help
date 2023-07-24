@extends('layouts.custom.app')
@section('extraCss')
    <style>
        .user-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #ddd;
            background-size: cover;
            background-position: center;
        }
    </style>
@endsection

@section('page_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Approved Requests</h1>

    </div>
    <!-- /.container-fluid -->

    <div class="container-fluid">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            {{ $post->post_title }}
                        </div>
                        <div class="card-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{ $post->post_video }}"
                                    allowfullscreen="allowfullscreen" frameborder="0"
                                    autoplay="0" controls></iframe>
                            </div>
                            <p>{{ $post->post_description }}</p>

                            <p>Admin Comment: {{ $post->admin_comment }}</p>

                        </div>
                        <div class="card-footer">
                            {{-- <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal"
                                data-type="approved" data-post-id="{{$post->id}}">Approve</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"
                                data-type="rejected" data-post-id="{{$post->id}}">Reject</button> --}}
                            <button class="btn btn-primary fetch-user" data-user-id="{{ $post->uuid }}">Posted By</button>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Modal -->





        </div>
        <div class="row">
            <p> {{ $posts->links() }}</p>
        </div>
        <div class="modal userModal " id="userModalid" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">User Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="user-image"></div>
                            <div class="user-details"></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button id="closeUserModal" type="button" class="btn btn-secondary">Close</button>

                    </div>


                </div>
            </div>
        </div>



    </div>
@endsection


@section('extraJS')
    <script>
        $(document).ready(function() {
            // Event listener for fetch user button
            $('.fetch-user').click(function() {
                var userId = $(this).data('user-id');

                // AJAX request to fetch user data
                $.ajax({
                    type: 'GET',
                    url: "{{ url('dashboard/request/view/user') }}" + "/" + userId,
                    success: function(user) {
                        // Show user data in modal popup
                        $('.user-image').css('background-image', 'url(' + user.imageSrc + ')');
                        var details_loaded = "Name:" + user.name + '<br>' + "Email:" + user.email+'<br>' + 
                        "Phone"+user.phone+'<br>'+ "Address:" + user.address +'<br>'+ "Country:" + user.country
                        $('.user-details').html(details_loaded);
                        $('.userModal').css('display', 'block');
                    },
                    error: function() {
                        alert('Error fetching user data');
                    }
                });
            });


        });
        $('#closeUserModal').click(function() {

            $('#userModalid').css('display', 'none');
        });
    </script>
@endsection
