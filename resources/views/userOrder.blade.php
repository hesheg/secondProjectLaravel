<ul>
    <li><a href="/profile">Мой профиль</a></li>
    <li><a href="/catalog">Каталог</a></li>
    <li><a href="/cart">Корзина</a></li>
</ul>
<header>
    <h3>Ваши заказы - <?php echo count($userOrders); ?> шт</h3>
</header>

<main>

    <section class="checkout-form">
        <form action="/catalog" method="get">
            @if(empty($userOrders))
                <p>У вас еще нет заказов</p>
            @endif
            @foreach($userOrders as $userOrder)
                <div class="form-control">
                        <?php echo 'Заказ №' . $userOrder->id; ?>
                    <label for="checkout-email">Contact Name</label>
                    <div>
                        <span class="fa fa-envelope"></span>
                        <label for="checkout-name"></label><input type="text" id="checkout-name" name="checkout-name"
                                                                  value="{{ $userOrder->contact_name }}"
                                                                  placeholder="Enter your name...">
                    </div>
                </div>
                <div class="form-control">
                    <label for="checkout-phone">Contact Phone</label>
                    <div>
                        <span class="fa fa-phone"></span>
                        <input type="tel" name="checkout-phone" id="checkout-phone"
                               value="{{ $userOrder->contact_phone }}" placeholder="Enter you phone...">
                    </div>
                </div>
                <div class="form-control">
                    <label for="checkout-address">Address</label>
                    <div>
                        <span class="fa fa-home"></span>
                        <input type="text" name="checkout-address" id="checkout-address"
                               value="{{ $userOrder->address }}" placeholder="Your address...">
                    </div>
                </div>
                <div class="form-control">
                    <label for="checkout-comment">Comment</label>
                    <div>
                        <span class="fa fa-building"></span>
                        <input type="text" name="checkout-comment" value="{{ $userOrder->comment }}"
                               id="checkout-comment" placeholder="Your comment...">
                    </div>
                </div>
                <section class="checkout-details">
                    @foreach($userOrder->orderProducts as $orderProduct)
                        <div class="checkout-details-inner">
                            <div class="checkout-lists">
                                <div class="card">
                                    <div class="card-image"><img src="{{ $orderProduct->product->image_url }}"
                                                                 alt=""></div>
                                    <div class="card-details">
                                        <div class="card-name">{{ $orderProduct->product->name }}</div>
                                        <div class="card-price">{{ $orderProduct->product->price }}₽ за единицу товара</div>
                                        <div class="card-wheel">
                                            <span><p>Количество</p>{{ $orderProduct->amount }}шт </span>
                                        </div>
                                                                        <div class="card-price">{{ $orderProduct->amount * $orderProduct->product->price }}₽</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="checkout-total">
                        <h6>Общая стоимость заказа</h6>
                        {{ $orderSums[$userOrder->id] }}₽
                    </div>
                </section>
                <br>
            @endforeach
        </form>
    </section>

</main>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: "Poppins", sans-serif;
        height: 100vh;
        width: 70%;
        margin: 0px auto;
        padding: 50px 0px 0px;
        color: #4E5150;


        header {

            height: 5%;
            margin-bottom: 30px;

            > h3 {
                font-size: 25px;
                color: #4E5150;
                font-weight: 500;
            }

        }

        main {
            height: 85%;
            display: flex;
            column-gap: 100px;

            .checkout-form {
                width: 50%;

                form {

                    h6 {
                        font-size: 12px;
                        font-weight: 500;
                    }

                    .form-control {
                        margin: 10px 0px;
                        position: relative;

                        label:not([for="checkout-checkbox"]) {
                            display: block;
                            font-size: 10px;
                            font-weight: 500;
                            margin-bottom: 2px;
                        }

                        input:not([type="checkbox"]) {
                            width: 100%;
                            padding: 10px 10px 10px 40px;
                            border-radius: 10px;
                            outline: none;
                            border: .2px solid #4e515085;
                            font-size: 12px;
                            font-weight: 700;

                            &::placeholder {
                                font-size: 10px;
                                font-weight: 500;
                            }
                        }

                        label[for="checkout-checkbox"] {
                            font-size: 9px;
                            font-weight: 500;
                            line-height: 10px;
                        }

                        > div {
                            position: relative;

                            span.fa {
                                position: absolute;
                                top: 50%;
                                left: 0%;
                                transform: translate(15px, -50%);
                            }
                        }
                    }

                    .form-group {
                        display: flex;
                        column-gap: 25px;
                    }

                    .checkbox-control {
                        display: flex;
                        align-items: center;
                        column-gap: 10px;
                    }

                    .form-control-btn {
                        display: flex;
                        align-items: center;
                        justify-content: flex-end;

                        button {
                            padding: 10px 25px;
                            font-size: 10px;
                            color: #fff;
                            background: #F2994A;
                            border: 0;
                            border-radius: 7px;
                            letter-spacing: .5px;
                            font-weight: 200;
                            cursor: pointer;
                        }
                    }
                }
            }

            .checkout-details {
                width: 40%;

                .checkout-details-inner {
                    background: #F2F2F2;
                    border-radius: 10px;
                    padding: 20px;


                    .checkout-lists {
                        display: flex;
                        flex-direction: column;
                        row-gap: 15px;
                        margin-bottom: 40px;

                        .card {
                            width: 100%;
                            display: flex;
                            column-gap: 15px;

                            .card-image {
                                width: 35%;

                                img {
                                    width: 100%;
                                    object-fit: fill;
                                    border-radius: 10px;
                                }
                            }

                            .card-details {
                                display: flex;
                                flex-direction: column;

                                .card-name {
                                    font-size: 12px;
                                    font-weight: 500;
                                }

                                .card-price {
                                    font-size: 10px;
                                    font-weight: 500;
                                    color: #F2994A;
                                    margin-top: 5px;

                                    span {
                                        color: #4E5150;
                                        text-decoration: line-through;
                                        margin-left: 10px;
                                    }
                                }

                                .card-wheel {
                                    margin-top: 17px;
                                    border: .2px solid #4e515085;
                                    width: 90px;
                                    padding: 8px 8px;
                                    border-radius: 10px;
                                    font-size: 12px;
                                    display: flex;
                                    justify-content: space-between;

                                    button {
                                        background: #E0E0E0;
                                        color: #828282;
                                        width: 15px;
                                        height: 15px;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        border: 0;
                                        cursor: pointer;
                                        border-radius: 3px;
                                        font-weight: 500;
                                    }
                                }
                            }
                        }
                    }

                    .checkout-shipping, .checkout-total {
                        display: flex;
                        font-size: 16px;
                        padding: 5px 0px;
                        border-top: 1px solid #BDBDBD;
                        justify-content: space-between;

                        p {
                            font-size: 10px;
                            font-weight: 500;
                        }
                    }
                }
            }
        }

        footer {

            height: 5%;
            color: #BDBDBD;
            display: -ms-grid;
            display: grid;
            place-items: center;
            font-size: 12px;

            a {
                text-decoration: none;
                color: inherit;
            }

        }

    }

    @media screen and (max-width: 1024px) {
        body {
            width: 80%;

            main {
                column-gap: 70px;
            }
        }
    }

    @media screen and (max-width: 768px) {
        body {
            width: 92%;

            main {
                flex-direction: column-reverse;
                height: auto;
                margin-bottom: 50px;

                .checkout-form {
                    width: 100%;
                    margin-top: 35px;
                }

                .checkout-details {
                    width: 100%;
                }
            }

            footer {
                height: 10%;
            }
        }
    }
</style>
