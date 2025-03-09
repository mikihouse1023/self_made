@extends('layouts.app_login')
@section('content')
<body class="login-body">
<div class="register-container">
    <h1>ニュース追加</h1>
    <div class="l-form">
        <form action="{{route('admin.news.add')}}" method="post">
         
        </form>
       
   
    </div>

</div>
</body>

@endsection