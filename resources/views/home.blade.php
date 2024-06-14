<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
    <h2>Abusados registrados com Sucesso</h2>
    <form action="logout" method="POST">
        @csrf
        <button type="submit">LogOut</button>
    </form>
    <form action="create-post" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Type your title">
        <textarea type="text" name="body" placeholder="type your content"></textarea>
        <button type="submit">Post</button>
    </form>
    <br>
    <br>
    <div style="border: 2px black dashed; padding: 1%">
        <h1>All posts</h1>
    @foreach ($posts as $post)  
        <div style="background-color: gray; padding: 1%;">
            <h2>{{$post['title']}}</h2>
            <h3>{{$post['body']}}</h3>
            <p><a href="/edit/{{$post->id}}">Edit</a></p>
            <form action="/delete/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
    @endforeach
    </div>
    @else
    <h1>Testando né, nega</h1>
    <h2>Registrando os abusado</h2>
        <div>
            <form action="/register" method="POST">
                @csrf
                <p>Nome <input type="text"  name="name" ></p>
                <p>Email <input type="text" name="email" ></p>
                <p>Senha <input type="password"  name="password"></p>
                <input type="submit">
            </form>
        </div><br>
        <div style="border: 2px black dashed; padding-left: 1%">
            <h1>Login dos abusados</h1>
            <form action="/login" method="POST">
                @csrf
                <p>Nome <input type="text"  name="loginname" ></p>
                <p>Email <input type="text" name="loginemail" ></p>
                <p>Senha <input type="password"  name="loginpassword"></p>
                <input type="submit" value="Login">
            </form><br>
        </div>
        
    @endauth
</body>
</html>