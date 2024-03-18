<div>
        
</div>

<section class="sideBar col-xs-2  col-md-3 col-lg-2">
        <ul>
                <li>
                        <a class="user-data text-center list-group-item">
                                @auth
                                <img class="logo img-responsive img-circle img-thumbnail" src="{{ asset('images/alraqiah_logo.jpeg') }}">
                                <h4><span>{{ Auth::user()->name }}</span></h4>
                                @endauth
                        </a>
                </li>
                @can('view_user')
                <li><a class="sidebare-button list-group-item" href="{{route('users.index')}}"><span class="fa fa-users"></span> <span>{{ __("lang.users") }}</span></a></li>
                @endcan
                @can('view_client')
                <li><a class="sidebare-button list-group-item" href="{{route('clients.index')}}"><span class="fa fa-user"></span> <span>{{ __("lang.clients") }}</span></a></li>
                @endcan
                @can('view_video')
                <li><a class="sidebare-button list-group-item" href="{{route('videos.index')}}"><span class="fa fa-film"></span> <span>{{ __("lang.videos") }}</span></a></li>
                @endcan
                @can('view_faq')
                <li><a class="list-group-item" href="{{route('faqs.index')}}"></span> <span class="fa fa-question"></span> <span>{{ __("lang.faqs") }}</a></li>
                @endcan
                @can('view_rate')
                <li><a class="list-group-item" href="{{route('rates.index')}}"></span> <span class="fa fa-star"></span> <span>{{ __("lang.rates") }}</a></li>
                @endcan
                @can('view_site')
                <li><a class="list-group-item" href="{{route('sites.index')}}"></span> <span class="fa fa-map"></span> <span>{{ __("lang.sites") }}</a></li>
                @endcan
                @can('view_complaint')
                <li><a class="list-group-item" href="{{route('complaints.index')}}"></span> <i class="fa fa-circle-xmark"></i> <span>{{ __("lang.complaints") }} <span class="badge bg-danger">{{app('activeComplaints')}}</span></a></li>
                @endcan
                @can('view_fcm_message')
                <li><a class="list-group-item" href="{{route('fcm-messages.index')}}"></span> <span class="fa fa-envelope"></span> <span>{{ __("lang.fcm_messages") }}</a></li>
                @endcan
                @can('view_schedule_fcm')        
                <li><a class="list-group-item" href="{{route('schedule-fcm.index')}}"></span> <span class="fa fa-envelope"></span> <span>{{ __("lang.schedule_fcm") }}</a></li>
                @endcan
        </ul>
</section>