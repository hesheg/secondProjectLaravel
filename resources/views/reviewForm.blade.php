<div class="container">
    <ul>
        <li><a href="/profile">Мой профиль</a></li>
        <li><a href="/catalog">Каталог</a></li>
        <li><a href="/cart">Корзина</a></li>
        <li><a href="/user-order">Мои заказы</a></li>
    </ul>
    <h3>О продукте</h3>
    <div class="card-deck">
        <div class="card text-center">
            <img class="card-img-top" src="{{ $product->image_url }}" alt="Card image">
            <div class="card-body">
                <p class="card-text text-muted">{{ $product->name }}</p>
                <a href="#"><h5 class="card-title">{{ $product->description }}</h5></a>
                <div class="card-footer">
                    {{ $product->price}}₽
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        font-style: sans-serif;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    h3 {
        line-height: 3em;
    }

    .card {
        max-width: 16rem;
    }

    .card:hover {
        box-shadow: 1px 2px 10px lightgray;
        transition: 0.2s;
    }

    .card-header {
        font-size: 13px;
        color: gray;
        background-color: white;
    }

    .text-muted {
        font-size: 11px;
    }

    .card-footer {
        font-weight: bold;
        font-size: 18px;
        background-color: white;
    }

</style>

@if($result === true)
<form action="{{ route('review-add') }}" method="POST">
    @csrf
    <div class="container">
        <label for="product_id"><b></b></label>
        <input type="hidden" placeholder="Enter product_id" name="product_id" id="product_id" value="{{ $product->id }}"
               required>

        <label for="rating"><b>Рейтинг</b></label>

        <label for="rating"></label>
        <select name="rating" id="rating" required>
            <option value="">Выберите оценку</option>
            <option value="1">1 - Плохо</option>
            <option value="2">2 - Удовлетворительно</option>
            <option value="3">3 - Нормально</option>
            <option value="4">4 - Хорошо</option>
            <option value="5">5 - Отлично</option>
        </select>

        <div style="margin-top: 10px;">
            <label for="comment"><b>Ваш комментарий</b></label>
            @error('comment')
            <div style="color:brown; margin-top: -15px; margin-bottom: 10px;">{{ $message }}</div>
            @enderror
            <input type="text" placeholder="Ваш комментарий" name="comment" id="comment" required>
        </div>

        <button type="submit" class="registerbtn">Оставить отзыв</button>
    </div>
</form>
@endif


<style>
    * {
        box-sizing: border-box
    }

    /* Add padding to containers */
    .container {
        padding: 16px;
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    /* Set a style for the submit/register button */
    .registerbtn {
        background-color: dodgerblue;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .registerbtn:hover {
        opacity: 1;
    }

    /* Add a blue text color to links */
    a {
        color: dodgerblue;
    }

    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
        background-color: #f1f1f1;
        text-align: center;
    }
</style>


<h1>Отзывы</h1>
<div class="card-deck">
    <div class="card text-center">
        @if(empty($reviews))
            <b>Отзывов еще нет</b>
        @else
            <h3>Отзывы аромата {{ $product->name }}</h3>
        @endif

        <h2 class="card-text text-muted"><?php echo 'Всего отзывов: ' . $count; ?></h2>
        <h2 class="card-text text-muted"><?php echo 'Средняя оценка товара: ' . $ratingTotal; ?></h2>

        @foreach($reviews as $review)
            <div class="card-body">
                <h2 class="card-text text-muted"><?php echo 'Отзыв №: ' . $review->id; ?></h2>
                <p class="card-text text-muted"><?php echo 'Имя: ' . $review->user->name; ?></p>
                <p class="card-text text-muted"><?php echo 'Оценка: ' . $review->rating; ?></p>
                <p class="card-text text-muted"><?php echo 'Текст отзыва: ' . $review->comment; ?></p>
                <p class="card-text text-muted"><?php echo 'Дата написания: ' . $review->created_at; ?></p>
                <p></p>
            </div>
        @endforeach
    </div>


    <style>
        body {
            font-style: sans-serif;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }

        h3 {
            line-height: 3em;
        }

        .card {
            max-width: 34rem;
        }

        .card:hover {
            box-shadow: 1px 2px 10px lightgray;
            transition: 0.2s;
        }

        .card-header {
            font-size: 13px;
            color: gray;
            background-color: white;
        }

        .text-muted {
            font-size: 11px;
        }

        .card-footer {
            font-weight: bold;
            font-size: 18px;
            background-color: white;
        }

    </style>
