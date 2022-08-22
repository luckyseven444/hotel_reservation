@extends('layouts.customer')

@section('content')
 <form action="{{route('reserve', $room)}}" method="post">
    @csrf
    <input type="hidden" name="room_id" value={{$room_id}}>
    <input type="hidden" name="customer_id" value={{$customer_id}}>
    <input type="date" name="check_in" placeholder="Check In">
    <input type="date" name="check_out" placeholder="Check Out">
    <input type="number" name="adults" placeholder="Adults">
    <input type="number" name="children" placeholder="Children">

    <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()">Make Reservation</button>
 </form>

 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection

@push('script')
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script>
  
    var firebaseConfig = {
        apiKey: "AIzaSyDoi5l_Dhu9EISg1BP6cxSJApqsNg381_Y",
        authDomain: "hotel-b3d95.firebaseapp.com",
        projectId: "hotel-b3d95",
        storageBucket: "hotel-b3d95.appspot.com",
        messagingSenderId: "48532540696",
        appId: "1:48532540696:web:072f0543b289ace934a26d",
        measurementId: "G-Y72LR3V60E"
    };
      
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
  
    function initFirebaseMessagingRegistration() {
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);
   
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
  
                $.ajax({
                    url: '{{ route("save-token") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });
  
            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
     }  
      
    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });
   
</script>
@endpush