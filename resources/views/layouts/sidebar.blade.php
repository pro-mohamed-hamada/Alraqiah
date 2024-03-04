<div>
        
</div>

<section class="sideBar col-xs-2  col-md-3 col-lg-2 text-left">
        <ul>
                <li>
                        <a class="user-data text-center list-group-item">
                                @auth
                                <img class="user-img img-responsive img-circle img-thumbnail" src="{{ empty(Auth::user()->getFirstMediaUrl('users')) ? asset('images/default-image.jpg'):Auth::user()->getFirstMediaUrl('users')}}">
                                <h4><span>{{ Auth::user()->name }}</span></h4>
                                @endauth
                                <a class="text-center list-group-item active" href="{{url("/settings")}}"><span>{{ __("lang.profile") }}</span></a>
                        </a>
                </li>
                @can('view_user')
                <li><a class="sidebare-button list-group-item" href="{{route('users.index')}}"><span class="fa fa-product-hunt"></span> <span>{{ __("lang.users") }}</span></a></li>
                @endcan
                @can('view_client')
                <li><a class="sidebare-button list-group-item" href="{{route('clients.index')}}"><span class="fa fa-product-hunt"></span> <span>{{ __("lang.clients") }}</span></a></li>
                @endcan
                @can('view_video')
                <li><a class="sidebare-button list-group-item" href="{{route('videos.index')}}"><span class="fa fa-product-hunt"></span> <span>{{ __("lang.videos") }}</span></a></li>
                @endcan
                @can('view_faq')
                <li><a class="list-group-item" href="{{route('faqs.index')}}"></span> <span class="fa fa-users"></span> <span>{{ __("lang.faqs") }}</a></li>
                @endcan
                @can('view_site')
                <li><a class="list-group-item" href="{{route('sites.index')}}"></span> <span class="fa fa-users"></span> <span>{{ __("lang.sites") }}</a></li>
                @endcan
                @can('view_complaint')
                <li><a class="list-group-item" href="{{route('complaints.index')}}"></span> <span class="fa fa-users"></span> <span>{{ __("lang.complaints") }}</a></li>
                @endcan
                @can('view_fcm_message')
                <li><a class="list-group-item" href="{{route('fcm-messages.index')}}"></span> <span class="fa fa-users"></span> <span>{{ __("lang.fcm_messages") }}</a></li>
                @endcan
                @can('view_schedule_fcm')        
                <li><a class="list-group-item" href="{{route('schedule-fcm.index')}}"></span> <span class="fa fa-users"></span> <span>{{ __("lang.schedule_fcm") }}</a></li>
                @endcan
        </ul>
</section>