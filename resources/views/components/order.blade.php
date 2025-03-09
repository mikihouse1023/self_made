@if ($orders->isEmpty())
    <p>まだ注文がありません。</p>
@else
    @foreach ($orders as $orderCode => $orderItems)
        
            <h3>注文コード: {{ $orderCode }}</h3>
            <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="table-name">商品名</th>
                        <th class="table-price">値段</th>
                        <th class="table-quantity">数量</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}円</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
               
            </table>
            <button onclick="location.href='{{ route('order.qr', ['orderCode' => $orderCode]) }}'" class="QR-button">QRコードを発行</button>
      
        </div>
       
    @endforeach
@endif
