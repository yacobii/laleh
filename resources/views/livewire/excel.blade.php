<div class="p-5 text-sm">

    <table class="table-auto w-full">
        <thead>
        <tr class=" border-y text-center">
            <th class="p-3 text-right">#</th>
            <th class="p-3 text-right">Name</th>
            <th class="p-3 text-right">Category</th>
            <th class="p-3 text-center">Color</th>
            <th class="p-3 text-center">Size</th>
            <th class="p-3">Price</th>
            <th class="p-3 text-center">Stock</th>
            <th class="p-3 text-center">Sku</th>
            <th class="p-3">Image URL</th>
        </tr>
        </thead>
        <tbody>
        @php $i = 1; @endphp
        @foreach($this->products as $product)
            @foreach($product->variations as $variation)
                @foreach($variation->children as $child)
                    <tr class="border-y hover:bg-gray-200">
                        <td class="p-3">{{$i++}}</td>
                        <td class="hover:text-red-500 w-fit"><a target="_blank" href="{{ route('product', $product) }}">{{ $product->name }}</a> - {{ $variation->title }} - {{ $child->title }}</td>
                        <td class="hover:text-red-500 w-fit">
                        @foreach($product->categories as $category)
                            <li>{{ $category->top->name }}</li>
                        @endforeach
                        </td>
                        <td class="text-center">{{ $variation->title }}</td>
                        <td class="text-center">{{ $child->title }}</td>
                        <td class="text-center">{{ $product->price }}</td>
                        <td class="text-center">
                            {{ $child->stocks->sum('amount') }}
                        </td>
                        <td class="font-sans text-center">{{ $child->sku ?? '-' }}</td>

                        <td class="hidden md:table-cell font-sans">
                            <a target="_blank" href="{{ $variation->getFirstMediaUrl('colors') }}">{{ $variation->getFirstMediaUrl('colors') }}</a>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        @endforeach
        </tbody>
    </table>


<div class="my-10 text-left">
    <a  href="{{ route('export') }}" class="py-2  px-4 bg-black text-white rounded-lg">خروجی اکسل</a>

</div>
</div>
