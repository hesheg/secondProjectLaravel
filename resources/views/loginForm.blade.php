<div class="container">
    <form action="/login" method="POST">
        @csrf

        @if ($errors->has('email'))
            <div class="error-message" style="color: brown;">
                {{ $errors->first('email') }}
            </div>
        @endif

        <h2>Login-form</h2>
        <div class="input-field">
            <input type="text" name="email" value="{{ old('email') }}" required />
            <label>Enter email</label>
        </div>
        <div class="input-field">
            <input type="password" name="password" required />
            <label>Enter password</label>
        </div>
        <div class="forget">
            <label for="Save-login">
                <input type="checkbox" id="Save-login" />
                <p>Save login information</p>
            </label>
            <a href="#">Forgot password?</a>
        </div>
        <button type="submit">Log In</button>
        <div class="Create-account">
            <p>Don't have an account? <a href="#">Create account</a></p>
        </div>
    </form>
</div>



<style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@200;300;400;500;600;700&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Open Sans", sans-serif;
    }

    /* width */
    ::-webkit-scrollbar {
        width: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555555;
    }

    body {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        width: 100%;
        padding: 0 10px;
    }

    body::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: url("https://cdn.pixabay.com/photo/2024/12/25/05/54/sea-9289597_1280.png"), #000;
        background-position: center;
        background-size: cover;
    }

    .container {
        width: 400px;
        border-radius: 8px;
        padding: 30px;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(7px);
        -webkit-backdrop-filter: blur(7px);
    }

    form {
        display: flex;
        flex-direction: column;
    }

    h2 {
        font-size: 2rem;
        margin-bottom: 20px;
        color: #fff;
    }

    .input-field {
        position: relative;
        border-bottom: 2px solid #ccc;
        margin: 15px 0;
    }

    .input-field label {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        color: #fff;
        font-size: 16px;
        pointer-events: none;
        transition: 0.15s ease;
    }

    .input-field input {
        width: 100%;
        height: 40px;
        background: transparent;
        border: none;
        outline: none;
        font-size: 16px;
        color: #fff;
    }

    .input-field input:focus~label,
    .input-field input:valid~label {
        font-size: 0.8rem;
        top: 10px;
        transform: translateY(-120%);
    }

    .forget {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 25px 0 35px 0;
        color: #fff;
    }

    #Save-login {
        accent-color: #fff;
    }

    .forget label {
        display: flex;
        align-items: center;
    }

    .forget label p {
        margin-left: 8px;
    }

    .container a {
        color: #efefef;
        text-decoration: none;
    }

    .container a:hover {
        text-decoration: underline;
    }

    button {
        background: #fff;
        color: #000;
        font-weight: 600;
        border: none;
        padding: 12px 20px;
        cursor: pointer;
        border-radius: 3px;
        font-size: 16px;
        border: 2px solid transparent;
        transition: 0.3s ease;
    }

    button:hover {
        color: #fff;
        border-color: #fff;
        background: rgba(255, 255, 255, 0.15);
    }

    .Create-account {
        text-align: center;
        margin-top: 30px;
        color: #fff;
    }


    /* Support me */
    #support {
        position: fixed;
        bottom: 1em;
        right: 1em;
    }
</style>
