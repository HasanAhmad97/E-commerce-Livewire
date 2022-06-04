<div class="main-footer">

    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">
        Add New Category
    </button>
    @if(\Illuminate\Support\Facades\Session::has('message'))
        <div class="alert alert-success" role="alert">{{\Illuminate\Support\Facades\Session::get('message')}}</div>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('deleteMessage'))
        <div class="alert alert-danger" role="alert">{{\Illuminate\Support\Facades\Session::get('deleteMessage')}}</div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Stock</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td><img src="{{asset('assets/images/products')}}/{{$product->image}}" width="100px" height="100px"/></td>
                <td>{{$product->name}}</td>
                <td>{{$product->stock_status}}</td>
                <td>{{$product->regular_price}}</td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->created_at}}</td>
                <td>
                    <a class="text-danger" data-target="#delete" data-toggle="modal" style="cursor:pointer;font-size: 26px;margin-left:10px "><i class="fa fa-trash"></i></a>
                    <a data-target="#edit" wire:click="edit({{ $product->id }})" data-toggle="modal" style="cursor:pointer;font-size: 26px;margin: 5px;"><i class="fa fa-edit"></i></a>
                </td>
            </tr>

{{--            <!-- Edit_modal_Category -->--}}

            <div class="modal fade" wire:ignore.self id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width: 150vh;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                        </div>
                        <div class="modal-body">

                            <form class="form-horizontal" style="padding: 0px 20px;">

                                <div class="form-group">
                                    <label for="name" class="col-md-3 control-label">Name:</label>
                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control input-md"  wire:model="name" wire:keyup="generateSlug" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-3  control-label">Slug:</label>
                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control input-md"  wire:model="slug"  >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-3 control-label">Short Description:</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" wire:model="short_description" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-3 control-label">Description:</label>
                                    <div class="col-md-8">
                                        <textarea rows="5" class="form-control" wire:model="description" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-3 control-label">Regular Price:</label>
                                    <div class="col-md-8">
                                        <input id="name" type="number" class="form-control input-md"  wire:model="regular_price" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-3 control-label">Sale Price:</label>
                                    <div class="col-md-8">
                                        <input id="name" type="number" class="form-control input-md"  wire:model="sale_price" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-3 control-label">Sku:</label>
                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control input-md"  wire:model="SKU" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-3 control-label">Stock:</label>
                                    <div class="col-md-8">
                                        <select class="form-control" wire:model="stock_status">
                                            <option >Select Stock</option>
                                            <option vlaue="inStock">inStock</option>
                                            <option value="outOfStock">outOfStock</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-3 control-label">Featured:</label>
                                    <div class="col-md-8">
                                        <select class="form-control" wire:model="featured">
                                            <option value="">select featured</option>
                                            <option vlaue="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-3 control-label">Quantity:</label>
                                    <div class="col-md-8">
                                        <input id="name" type="number" class="form-control input-md"  wire:model="quantity">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-3 control-label">Image:</label>
                                    <div class="col-md-8">
                                        <input id="name" type="file" class="form-control input-file"  wire:model="image">
                                        @if($image)
                                            <img src="{{$image->temporaryUrl()}}" width="100px" height="100px">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-3 control-label">Category:</label>
                                    <div class="col-md-8">
                                        <select class="form-control" wire:model="category_id">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)

                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" wire:click="storeProduct()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>





{{--            <!-- delete_modal_Grade -->--}}
{{--            <div class="modal fade" id="delete" tabindex="-1" role="dialog"--}}
{{--                 aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                <div class="modal-dialog" role="document">--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"--}}
{{--                                id="exampleModalLabel">--}}
{{--                                {{ trans('Grades_trans.delete_Grade') }}--}}
{{--                            </h5>--}}
{{--                            <button type="button" class="close" data-dismiss="modal"--}}
{{--                                    aria-label="Close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="modal-body">--}}
{{--                            <form>--}}
{{--                                @csrf--}}
{{--                                <div class="modal-footer">--}}
{{--                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>--}}
{{--                                    <button wire:click.prevent="delete({{$category->id}})" class="btn btn-danger">delete</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        @endforeach

        </tbody>
    </table>
    <div class="wrap-pagination-info">
        {{$products->links('customPagination')}}
    </div>


    <!-- add_modal_Product -->

    <div class="modal fade" wire:ignore.self id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 150vh;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" style="padding: 0px 20px;">

                            <div class="form-group">
                                <label for="name" class="col-md-3 control-label">Name:</label>
                                <div class="col-md-8">
                                <input id="name" type="text" class="form-control input-md"  wire:model="name" wire:keyup="generateSlug" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-3  control-label">Slug:</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control input-md"  wire:model="slug"  >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-3 control-label">Short Description:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" wire:model="short_description" ></textarea>
                                </div>
                            </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Description:</label>
                            <div class="col-md-8">
                                <textarea rows="5" class="form-control" wire:model="description" ></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Regular Price:</label>
                            <div class="col-md-8">
                                <input id="name" type="number" class="form-control input-md"  wire:model="regular_price" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Sale Price:</label>
                            <div class="col-md-8">
                                <input id="name" type="number" class="form-control input-md"  wire:model="sale_price" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Sku:</label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control input-md"  wire:model="SKU" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Stock:</label>
                            <div class="col-md-8">
                                 <select class="form-control" wire:model="stock_status">
                                     <option >Select Stock</option>
                                     <option vlaue="inStock">inStock</option>
                                     <option value="outOfStock">outOfStock</option>
                                 </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Featured:</label>
                            <div class="col-md-8">
                                <select class="form-control" wire:model="featured">
                                    <option value="">select featured</option>
                                    <option vlaue="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Quantity:</label>
                            <div class="col-md-8">
                                <input id="name" type="number" class="form-control input-md"  wire:model="quantity">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Image:</label>
                            <div class="col-md-8">
                                <input id="name" type="file" class="form-control input-file"  wire:model="image">
                                @if($image)
                                    <img src="{{$image->temporaryUrl()}}" width="100px" height="100px">
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Category:</label>
                            <div class="col-md-8">
                                <select class="form-control" wire:model="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)

                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="storeProduct()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>



