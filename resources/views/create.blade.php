<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <!-- resources/views/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">شعار الموقع</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="">الرئيسية</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">المقالات</a>
            </li>
            <!-- إضافة رابط للإشعارات -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    @if(auth()->user()->unreadNotifications->count())
                        <span class="badge badge-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                    @endif
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a href="{{route('notifications.markasread')}}">mark as read</a>
                    <a href="{{route('notifications.deleted')}}">deleted notifications</a>

                    @foreach(auth()->user()->unreadNotifications as $notification)
                        <div class="dropdown-item">
                        <strong>{{ $notification->data['user_name'] }}</strong>
       <div>
       
        
        
       <a href="{{route('posts.show' ,$notification->data['post_id'])}}">

    {{ $notification->data['title'] }}
      
       </a>
       </div>
       <small>{{ $notification->created_at->diffForHumans() }}</small>
    </div>
                    @endforeach


       
                </div>
            </li>
        </ul>
    </div>
</nav>


<div class="container">
        
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">title</label>
                <input type="text" id="name" name="title" required>
            </div>
            <div class="form-group">
                <label for="">body</label>
                <input type="text" id="email" name="body" required>
            </div>
           
            <button type="submit">send</button>
        </form>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

