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
        <h1 class="h3 mb-4 text-gray-800">Free Shop Items</h1>
        <p><a href="{{ url('dashboard/shop/item/add') }}" class="btn btn-primary">Add Item</a></p>

    </div>
    <!-- /.container-fluid -->

    <div class="container-fluid">
        <div class="row">
            @foreach ($items as $item)
                <div class="col-lg-4 mb-4">
                    <div class="card">

                        <div class="card-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <img src="{{ $item->item_image }}" alt="">
                            </div>
                            <p>Name: {{ $item->item_name }}</p>
                            <p>Category: {{ $item->item_category }}</p>

                        </div>
                        <div class="card-footer">
                            <p>Status: {{ $item->item_status }}</p>
                            @if ($item->item_status == 'active')
                                <a href="{{ url('dashboard/shop/item/manage?status=pause&id=').$item->id }}" class="btn btn-danger">Pause</a>
                            @else
                                <a href="{{ url('dashboard/shop/item/manage?status=active&id=').$item->id }}" class="btn btn-success">Activate</a>
                            @endif
                           
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Modal -->





        </div>
        <div class="row">
            <p> {{ $items->links() }}</p>
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
@endsection
