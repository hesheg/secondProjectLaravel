<div class="container">
    <h1>Edit Profile</h1>
    <hr>

    <form action="{{ route('edit-profile-post') }}" method="POST" class="form example">
        @csrf
        <div class="form-group">
            <label class="col-md-3 control-label">Username:</label>
            <div class="col-md-8">
                <label>
                    <input name="name" class="form-control" type="text" value="{{ $user->name }}">
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
                <label>
                    <input name="email" class="form-control" type="text" value="{{ $user->email }}">
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
                <input type="submit" class="btn btn-primary" value="Save Changes">
                <span></span>
                <input type="reset" class="btn btn-default" value="Cancel">
            </div>
        </div>
    </form>
</div>
<hr>

<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:300);



    .jumbotron-flat {
        background-color: solid #4DB8FFF;
        height: 100%;
        border: 1px solid #4DB8FF;
        background: white;
        width: 100%;
        text-align: center;
        overflow: auto;
        color: var(--dark-color);
    }

    .paymentAmt {
        color: var(--dark-color);
        font-size: 80px;
    }

    .centered {
        text-align: center;
    }

    .title {
        padding-top: 15px;
        color: var(--dark-color);
    }
</style>
