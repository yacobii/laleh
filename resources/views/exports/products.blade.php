<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Color</th>
        <th>Size</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Sku</th>
        <th>Image URL</th>
        <th>Description</th>
        <th>Features</th>
        <th>Link</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        @foreach($product->variations as $variation)
            @foreach($variation->children as $child)
                <tr>
                    <td>{{ $product->name }} - {{ $variation->title }} - {{ $child->title }}</td>
                    <td class="hover:text-red-500 w-fit">
                        @foreach($product->categories as $category)
                            <p>{{ $category->top->name }}</p>
                        @endforeach
                    </td>
                    <td class="">{{ $variation->title }}</td>
                    <td class="">{{ $child->title }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        {{ $child->stocks->sum('amount') }}
                    </td>
                    <td>
                        {{ $child->sku ?? '--' }}
                    </td>
                    <td>
                        {{ $variation->getFirstMediaUrl('colors') }}
                    </td>
                    <td>
                        {{ $product->description }}
                    </td>

                    <td>
                            @foreach($product->features as $feauture)
                            <span>{{ $feauture->title }} @if(!$loop->last)، @endif</span>
                            @endforeach
                    </td>
                    <td>
{{--                       <span>https://wearlarimo.com/product/{{$product->id}}</span>--}}
                    </td>
                </tr>
            @endforeach
        @endforeach
    @endforeach
    </tbody>
</table>
