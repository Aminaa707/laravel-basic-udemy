<x-app-layout>

    <div class="container py-5 my-5">
        <div class="row g-5">
            <div class="col-sm-6 col-md-8">
                <div class="card">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card-header">
                        All Category
                    </div>


                    <table class="table table-bordered table-striped table-hover mb-0">

                        <thead class="table-light">
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">User Id</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $key=>$row)
                            <tr>

                                <!-- [   $categories->firstItem()+$loop->index ] this is for ordering items number in pagination. -->

                                <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                                <td>{{$row->category_name}}</td>
                                <td>{{$row->user_id}}</td>
                                <td>
                                    @if($row->created_at == NULL)
                                    <span class="text-danger">No Date Set</span>
                                    @else
                                    {{$row->created_at->diffForHumans()}}

                                    <!-- when use query for getting data then have to use this Carbon -->
                                    <!-- {{Carbon\Carbon::parse($row->created_at)->diffForHumans()}} -->
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Connecting pagination by using default method -->
                    {{$categories -> links()}}
                </div>
            </div>
            <!-- add category card -->
            <div class="col-6 col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add Category
                    </div>
                    <div class="card-body">
                        <form action="{{route('add.category')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" name="category_name" value="{{old('category_name')}}" class="form-control" id="category_name">
                                @error("category_name")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary" style="float:right;">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>