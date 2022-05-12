<x-app-layout>

    <div class="container py-5 my-5">

        <div class="card">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!-- Update category card -->
            <div class="">
                <div class="card">
                    <div class="card-header">
                        Update Category
                        <a href="{{route('all.category')}}" class="btn btn-primary" style="float: right;"> Back </a>
                    </div>


                    <div class="card-body">
                        <form action="{{route('update.category', $category->id)}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Edit Category Name</label>
                                <input type="text" name="category_name" value="{{$category->category_name}}" class="form-control" id="category_name">
                                @error("category_name")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary" style="float:right;">Update</button>
                        </form>
                    </div>
                </div>
            </div>



</x-app-layout>