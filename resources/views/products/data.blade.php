@if(count($products))
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Quantity in stock</th>
            <th>Price per item</th>
            <th>Datetime submitted</th>
            <th>Total Value</th>
        </tr>
    @foreach ($products as $product)
        <tr>
            <td>{!! $product['name'] !!}</td>
            <td>{!! $product['quantity'] !!}</td>
            <td>{!! $product['price'] !!}</td>
            <td>{!! $product['created_at'] !!}</td>
            <td>{!! $product['total_value'] !!}</td>
        </tr>
    @endforeach
        <tr>
            <td colspan="5" class="text-right">Total Value: {!! $totalAllProducts !!}</td>
        </tr>
    </table>
@endif
