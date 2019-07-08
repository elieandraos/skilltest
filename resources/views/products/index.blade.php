@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    Add New Product
                </h1>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="{!! route('products.store') !!}" method="post" id="frm-product">
                            @csrf
                            <div class="form-group">
                                <label for="amount" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" name="name" id="name" value="" class="form-control"/>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="amount" class="col-md-4 control-label">Quantity in stock</label>

                                <div class="col-md-6">
                                    <input type="text" name="quantity" id="quantity" value="" class="form-control"/>
                                    @if ($errors->has('quantity'))
                                        <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="amount" class="col-md-4 control-label">Price per item</label>

                                <div class="col-md-6">
                                    <input type="text" name="price" id="price" value="" class="form-control"/>
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                            </div>

                            <input type="submit" value="Save" class="btn btn-primary" id="save-product">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
