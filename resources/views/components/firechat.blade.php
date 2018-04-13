<div id="firechat-wrapper-container" data-user-email="{{auth()->user()->email}}" data-user-name="{{ Auth::user()->name." ".Auth::user()->surname }}" data-user-role="{{auth()->user()->getCurrentRole()->name}}">
    <div id="firechat-header-minimize">
        <span class="newMessagesCount" data-count="0"></span>
        <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
    </div>
    <div id="firechat-wrapper"></div>
</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- Firebase -->
<script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>

<!-- Firechat -->
<link rel="stylesheet" href="https://cdn.firebase.com/libs/firechat/3.0.1/firechat.min.css" />
{{--<script src="https://cdn.firebase.com/libs/firechat/3.0.1/firechat.min.js"></script>--}}
<script src="{{ asset('js/firechat.js') }}"></script>


<script>
    // Initialize Firebase
    let config = {
        apiKey: "AIzaSyAUL3ZHr555uuW5R41ZFQ9uUooR9Myd9lM",
        authDomain: "pbchat-d9d94.firebaseapp.com",
        databaseURL: "https://pbchat-d9d94.firebaseio.com",
        projectId: "pbchat-d9d94",
        storageBucket: "pbchat-d9d94.appspot.com",
        messagingSenderId: "452205894854"
    };
    firebase.initializeApp(config);
</script>