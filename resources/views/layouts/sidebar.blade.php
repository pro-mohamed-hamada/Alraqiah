<div>
        
</div>

<section class="sideBar col-xs-2  col-md-3 col-lg-2 text-left">
        <ul>
                <li>
                        <a class="user-data text-center list-group-item">
                                <img class="user-img img-responsive img-circle img-thumbnail" src="{{asset('uploads/default.jpg')}}">
                                <h4><span>{{ Auth::user()->name }}</span></h4>
                                <a class="text-center list-group-item active" href="{{url("/settings")}}"><span>{{ __("lang.profile") }}</span></a>
                        </a>
                </li>
                <li><a class="sidebare-button list-group-item" href="{{route('users.index')}}"><span class="fa fa-product-hunt"></span> <span>{{ __("lang.users") }}</span></a></li>
                <li><a class="sidebare-button list-group-item" href="{{route('clients.index')}}"><span class="fa fa-product-hunt"></span> <span>{{ __("lang.clients") }}</span></a></li>
                <li><a class="sidebare-button list-group-item" href="{{route('videos.index')}}"><span class="fa fa-product-hunt"></span> <span>{{ __("lang.videos") }}</span></a></li>
                {{-- <li><a class="list-group-item" href="{{route('activity-lox')}}"><span class="fa fa-product-hunt"></span> <span>{{ __("lang.relatives") }}</span></a></li> --}}
                <li><a class="list-group-item" href="{{route('faqs.index')}}"></span> <span class="fa fa-users"></span> <span>{{ __("lang.faqs") }}</a></li>
                <li><a class="list-group-item" href="{{route('fcm-messages.index')}}"></span> <span class="fa fa-users"></span> <span>{{ __("lang.fcm_messages") }}</a></li>
                <li><a class="list-group-item" href="{{route('schedule-fcm.index')}}"></span> <span class="fa fa-users"></span> <span>{{ __("lang.schedule_fcm") }}</a></li>
        </ul>
</section>