@extends('layouts.app')


        @section('content')
        <div class="content col-md-9 col-lg-10 offset-md-3 offset-lg-2">
            <form method="POST" action="{{ route('fcm.liveFcmMessage') }}">
            <div class="mb-3">
                <div class="card">
                    <div class="card-header">{{ __('lang.create_live_fcm_message') }}</div>

                    <div class="card-body">
                        {{-- start create form --}}
                            @csrf
                            <div class="row mb-3 g-3">
                                <div class="col-md-4">
                                    <label>{{ __('lang.notification_via') }} *</label>
                                    <select name="notification_via" class="form-control">
                                        <option selected disabled>{{ __("lang.choose") }}</option>
                                        @foreach ($fcm_channels as $key=>$value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    <select>
                                    @error('notification_via')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>{{ __('lang.title') }} *</label>
                                    <input type="text" name="title" class="form-control">
                                    @error('title')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label>{{ __('lang.content') }} *</label>
                                    <textarea name="content" class="form-control"></textarea>
                                    @error('content')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label>{{ __('lang.flags') }} *</label>
                                    <div class="row  bg-light-dark">
                                        @foreach($flags as $key=>$flag)
                                            <div class="col-md-4 col-lg-4" style="cursor: pointer;padding: 10px;color: black" onclick="copyToClipboard('{{$flag}}')">{{$flag}}</div>
                                        @endforeach
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                        
                        {{-- end create form --}}
                    </div>
                </div>
                
            </div>
            {{-- start users --}}
            <div class="mb-3">
                <div class="card">
                    <div class="card-header">{{ __('lang.users') }}</div>

                    <div class="card-body">
                        <div class="row mb-3 g-3">
                            <div class="col-md-12">
                                <div class="form-check checkbox checkbox-primary mb-0">
                                    <input class="form-check-input" id="checkbox-primary-check-all" type="checkbox" data-bs-original-title="" title="{{ __('lang.check_all') }}">
                                    <label class="form-check-label" for="checkbox-primary-check-all">{{ __('lang.check_all') }}</label>
                                </div>
                            </div>
                        @foreach($users as $user)
                            <div class="col-md-4">
                                <div class="form-check checkbox checkbox-primary mb-0">
                                    <input class="form-check-input" name="users[]" value="{{$user->id}}" id="checkbox-primary-{{$user->id}}" type="checkbox" data-bs-original-title="" title="{{ $user->name }}">
                                    <label class="form-check-label" for="checkbox-primary-{{$user->id}}">{{ $user->name }}</label>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        @error('users')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <div class="row mb-3 g-3">
                            <div class="">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> {{__('lang.create')}}</button>
                                <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{__('lang.go_back')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end users --}}
            </form>
        </div>
        @endsection
        @section('script')
        <script>
            $(document).ready(function(){
                $('#checkbox-primary-check-all').on('change', function(){
                    $('input:checkbox').not(this).prop('checked', this.checked);
                })
            });
        </script>
        <script>
            function copyToClipboard(text) {
                var sampleTextarea = document.createElement("textarea");
                document.body.appendChild(sampleTextarea);
                sampleTextarea.value = text; //save main text in it
                sampleTextarea.select(); //select textarea contenrs
                document.execCommand("copy");
                document.body.removeChild(sampleTextarea);
                toastr.info('Copy to Clipboard')
            }
        </script>
        @endsection
