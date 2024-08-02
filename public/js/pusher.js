// <script>
        //  // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        // var pusher = new Pusher('274a7b774e7ee17cfcf3', {
        //     cluster: 'eu'
        // });

        var pusher = new Pusher('274a7b774e7ee17cfcf3', {
            cluster: 'eu',
            authEndpoint: '/broadcasting/auth',
            auth: {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            }
        });
        var myChannel = pusher.subscribe('CompaintCountChannel');
        myChannel.bind('my-event', function(data) {
            $('#complaint_count').html(data.count);
            playAudio();
        });

// </script>
