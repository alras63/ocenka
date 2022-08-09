<div class="bg-white rounded shadow-sm mb-3">
    <div class="row g-0">
        <div class="col col-lg-2 p-4">
            @if($user->avatar != null)
                <span class="m-auto">
                        <img src="{{$image}}" class="b">
                </span>
            @else
                <span class="m-auto">
                        <img src="http://dummyimage.com/160x200" class="b">
                </span>

            @endif

        </div>
        <div class="col col-lg-10 mt-6 p-4 d-flex flex-column justify-content-between">
            <div>
                <h3 class="fw-light text-black">{{$user->name}}</h3>
                <div class="fw-light">Email: {{$user->email}}</div>
                <div class="fw-light">Телефон: {{$user->phone}}</div>
            </div>
            {{$modalToggle()}}
        </div>
    </div>

    <div class="row g-0 p-4">
        <h4 class="fw-light mb-4">Прошел конкурсы:</h4>
        <div class="col col-lg-12">
        @foreach($userEvents as $event)
                <div class="border rounded p-2 mb-2">
                    <h5><a class="fw-light" href="{{ route('platform.events.edit', $event->event)}}">{{\App\Models\Event::where('id', $event->event)->first()->name}}</a></h5>
                    <p class="fw-light">{{\App\Models\Event::where('id', $event->event)->first()->descriptions}}}</p>
                </div>
        @endforeach
        </div>
    </div>

</div>
