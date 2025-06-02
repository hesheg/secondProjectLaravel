<div class="app">
    <div class="top">
        <div class="section-title">
            <h2>Ваша корзина</h2>
        </div>
        <div class="price">
            <p class="price-title">
                Итоговая стоимость: {{ $sum }}
            </p>
            <p class="price-amount">
            </p>
        </div>

    </div>
    <div class="cart-list">
        @foreach($products as $product)
        <div class="cart-item">
            <div class="item-image">
                <img src='{{ $product->image_url }}' alt="">
            </div>
            <div class="item-info">
                <h3 class="item-title">{{ $product->name }}</h3>
                <p class="price-amount">{{ $product->price }}P</p>
                    <?php //$res = $userProduct->getProduct(); ?><!----><!---->

                <form class="plus" onsubmit="return false" method="POST">
                    @csrf
                    <div class="container">
                        <input type="hidden" name="product_id" value="{{ $product->id }}" id="product_id" required>
                        <input type="hidden" name="amount" value="1" id="amount" required>
                        <button type="submit" class="registerbtn">+</button>
                    </div>
                    <div>

                    </div>
                </form>

                <p>{{ $product->pivot->amount }}шт</p>

                <form class="minus" onsubmit="return false" method="POST">
                    @csrf
                    <div class="container">
                        <input type="hidden" name="product_id" value="{{ $product->id }}" id="product_id" required>
                        <input type="hidden" name="amount" value="1" id="amount" required>
                        <button type="submit" class="registerbtn">-</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @if($sum > 0)
    <button class="button button-pay"><a href="/create-order">Оформить заказ</a></button>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('.plus').on('submit', function (event) {
            event.preventDefault(); // <-- важно
            $.ajax({
                type: "POST",
                url: "/add-product",
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    console.log('Добавлено:', response);
                    // $('.badge').text(response.count); // можно раскомментировать при наличии бейджа
                },
                error: function(xhr, status, error) {
                    console.error('Ошибка при добавлении товара:', error);
                }
            });
        });

        $('.minus').on('submit', function (event) {
            event.preventDefault(); // <-- важно
            $.ajax({
                type: "POST",
                url: "/decrease-product",
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    console.log('Удалено:', response);
                    // $('.badge').text(response.count);
                },
                error: function(xhr, status, error) {
                    console.error('Ошибка при удалении товара:', error);
                }
            });
        });
    });
</script>


<style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap");
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #3949AB;
        height: 100vh;
    }

    .app {
        font-family: "Open Sans", sans-serif;
        background: #fff;
        border: 2px solid rgba(#000, 0.2);
        border-radius: 20px;
        width: 350px;
        height: 700px;
        display: flex;
        flex-direction: column;
        -webkit-box-shadow: 6px 11px 23px 0px rgba(0, 0, 0, 0.3);
        -moz-box-shadow: 6px 11px 23px 0px rgba(0, 0, 0, 0.3);
        box-shadow: 6px 11px 23px 0px rgba(0, 0, 0, 0.3);
    }

    .top {
        background: #fff;
        display: flex;
        flex-direction: row;
        height: 5em;
        width: 100%;
        padding: 25px;
        justify-content: space-between;
        align-items: flex-start;
        border-radius: 20px 20px 0px 0px;
        .section-title {
        }
        .price {
            text-align: right;

            &-title {
                color: #ccc;
                font-weight: 600;
            }

            &-amount {
                margin-top: 5px;
                font-weight: 700;
            }
        }
    }
    .cart-list {
        font-family: "Open Sans";
        display: flex;
        flex-direction: column;
        padding: 25px;
        height: 100%;
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
            img {
                width: 100px;
                border-radius: 5px;
            }
            .item-info {
                text-align: right;
                .price-amount {
                    color: #424242;
                    margin-top: 20px;
                    font-weight: 600;
                }
            }
        }
    }

    .navigate {
        display: flex;
        padding: 25px;

        .button {
            font-family: "Open Sans", sans-serif;
            padding: 20px 10px;
            border: 0;
            border-radius: 20px;

            &-back {
                width: 50px;
                font-size: 24px;
                color: #dedede;
            }
            &-pay {
                margin-left: 10px;
                background: #ff9100;
                color: #fff;
                font-size:1.1em;
                font-weight: 600;
                flex: 1;
            }
        }
    }

</style>
