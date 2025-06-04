<div class="container">
    <ul>
        <li><a href="/profile">Мой профиль</a></li>
        <li><a href="/cart">Корзина</a></li>
        <li><a href="/user-order">Мои заказы</a></li>
    </ul>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h2>Каталог</h2>
    <div class="card-deck" style="display: flex; flex-wrap: wrap; gap: 20px;">
        @foreach($products as $product)
            <div class="card text-center">
                <a href="#">
                    <img class="card-img-top" src="{{ $product->image_url }}" alt="Product image">
                    <div class="card-body">
                        <p class="card-text text-muted">{{ $product->name }}</p>
                        <div class="card-footer">{{ $product->price }}₽</div>

                        <div style="display: flex; gap: 10px; justify-content: center; margin-top: 10px;">
                            <form action="{{ route('get-product', ['product' => $product]) }}" method="GET">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="submit" value="О продукте" class="registerbtn">
                            </form>

                            <form class="plus" onsubmit="return false" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="amount" value="1">
                                <button type="submit" class="registerbtn">+</button>
                            </form>
                            <span class="product-quantity" data-product-id="{{ $product->id }}">
                                {{ $product->amount }}
                            </span>
                            <form class="minus" onsubmit="return false" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="amount" value="1">
                                <button type="submit" class="registerbtn">-</button>
                            </form>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            $("document").ready(function () {
                $('.plus').submit(function () {
                    $.ajax({
                        type: "POST",
                        url: "/add-product",
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function (response) {
                            $('.product-quantity[data-product-id="' + response.product_id + '"]').text(response.amount);
                        },
                        error: function(xhr, status, error) {
                            console.error('Ошибка при добавлении товара:', error);
                        }
                    });
                });
            });
        </script>

        <script>
            $("document").ready(function () {
                $('.minus').submit(function () {
                    $.ajax({
                        type: "POST",
                        url: "/decrease-product",
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function (response) {
                            $('.product-quantity[data-product-id="' + response.product_id + '"]').text(response.amount);
                        },
                        error: function(xhr, status, error) {
                            console.error('Ошибка при добавлении товара:', error);
                        }
                    });
                });
            });
        </script>


        <style>
            .card-deck {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                margin: 0 auto;
                padding: 0;
            }

            .card {
                flex: 1 1 calc(25% - 20px);
                box-sizing: border-box;
                max-width: calc(25% - 20px);
                min-width: 200px;
            }

            /*body {*/
            /*    font-style: sans-serif;*/
            /*}*/

            /*a {*/
            /*    text-decoration: none;*/
            /*}*/

            /*a:hover {*/
            /*    text-decoration: none;*/
            /*}*/

            /*h3 {*/
            /*    line-height: 3em;*/
            /*}*/

            /*.card {*/
            /*    max-width: 16rem;*/
            /*}*/

            /*.card:hover {*/
            /*    box-shadow: 1px 2px 10px lightgray;*/
            /*    transition: 0.2s;*/
            /*}*/

            /*.card-header {*/
            /*    font-size: 13px;*/
            /*    color: gray;*/
            /*    background-color: white;*/
            /*}*/

            /*.text-muted {*/
            /*    font-size: 11px;*/
            /*}*/

            /*.card-footer {*/
            /*    font-weight: bold;*/
            /*    font-size: 18px;*/
            /*    background-color: white;*/
            /*}*/

        </style>
