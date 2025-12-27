<div class="p-5">
    <div>
        <h1>{{ $this->prod['title'] ?? 'بدون عنوان' }}</h1>

        @if($this->prod['thumbnail'])
            <img class="w-16" src="{{ $this->prod['thumbnail'] }}" alt="{{ $this->prod['title'] }}">
        @else
            <img class="w-16" src="{{ asset('assets/og-image.jpg') }}" alt="No Image">
        @endif

        <div>قیمت: {{ number_format($this->prod['price'] ?? 0) }} تومان</div>

        @if (!empty($this->prod['variation_attributes']))
            <ul>
                @foreach ($this->prod['variation_attributes'] as $index => $attributeData)
                    @php
                        $attribute = $attributeData['attribute'] ?? null;
                        $value = $attributeData['value'] ?? null;
                    @endphp

                    @if ($attribute && $value)
                        <li>
                            {{ $attribute['title'] ?? 'Attribute' }}:
                            {{ $value['title'] ?? 'Value' }}
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif

    </div>

</div>
