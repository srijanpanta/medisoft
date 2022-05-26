@extends('layouts.app')
@section('content')
<style>
    p{
        position: absolute;
        bottom: 0;
        right:10px;
    }
</style>
<div class="container mt-3">
    <div class="d-flex justify-content-between mb-3">
        <h1>Notifications</h1>
        <a href="{{route('readMsg')}}" class="btn-link">Mark all read</a>
    </div>
    
     @foreach ($notifications as $notification)
    
        @if (!$notification->read_at)
        <a href="{{route('readMsgSingle',['notificationId'=>$notification->id])}}" class="text-decoration-none">
            <div class="alert alert-secondary" role="alert">
        <i class="fa-solid fa-triangle-exclamation mr-3" style="font-size: 1rem"></i><b>{{$notification->data['line']}}
        <p>{{$notification->created_at->diffForHumans()}}</p>
        </b>
        </div>
        </a>
        
        @else
        <div class="alert alert-secondary" role="alert">
           {{$notification->data['line']}}
         <p class="text-muted">{{$notification->created_at->diffForHumans()}}</p>
        </div>
        @endif
         
           
    @endforeach
</div>
   
    
@endsection