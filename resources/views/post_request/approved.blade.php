@extends('layouts.custom.app')

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
                                    allow="autoplay; encrypted-media" allowfullscreen="allowfullscreen" frameborder="0"
                                    autoplay="0" controls></iframe>
                            </div>
                            <p>{{ $post->post_description }}</p>

                            <p>Admin Comment: {{ $post->admin_comment }}</p>
                            
                        </div>
                        {{-- <div class="card-footer">
                            <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal"
                                data-type="approved" data-post-id="{{$post->id}}">Approve</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"
                                data-type="rejected" data-post-id="{{$post->id}}">Reject</button>
                            <button class="btn btn-primary">Info</button>
                        </div> --}}
                    </div>
                </div>
            @endforeach

            <!-- Modal -->
           




        </div>
        <div class="row">
            <p> {{ $posts->links() }}</p>
        </div>




    </div>
@endsection


@section('extraJS')
   
@endsection
