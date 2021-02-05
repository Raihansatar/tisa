login page

<form action="{{ Route('login.process') }}" method="POST" enctype="multipart/form-data">
@csrf
    <label for="">Username</label>
    <input type="text" name="username" id="">
    <label for="">Password</label>
    <input type="password" name="password" id="">
    <button type="submit"> Login </button>
</form>