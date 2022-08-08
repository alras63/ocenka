<div class="bg-white rounded-top shadow-sm mb-3 pb-3">
    <div class="row g-0">
        <div class="col col-lg-7 mt-6 p-4">

            <h3 class="mt-2 text-dark fw-light">Активные мероприятия</h3>
        </div>
    </div>
    @foreach($events as $event)
    <div class="border m-4 mt-0 mb-2">
        <div class="row g-0 p-3">
            <div class="col col-lg-8">
                <h5 class="text-dark fw-normal mb-3">{{$event->name}}</h5>
                <p>{{$event->descriptions}} </p>
            </div>
            <div class="col col-lg-4">
                <div>Дата начала: {{$event->start_date}}</div>
                <div class="mb-4">Дата проведения оценки: {{$event->estimate_date}}</div>
                <div>Количество участников:
                    @php
                        $arr = [];
                    @endphp
                @foreach($users as $user)
                    @php

                        if($user->event === $event->id){
                            $arr[] = $user;
                        }
                    @endphp

                @endforeach
                    {{count($arr)}}
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
