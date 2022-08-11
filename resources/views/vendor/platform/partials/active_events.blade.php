<div class="bg-white rounded shadow-sm mb-3 pb-3">
    <div class="row g-0">
        <div class="col col-lg-7 mt-6 p-4">
            <div class="d-flex">
                <button id="btn-active" onclick="showActive()" class="btn btn-outline-info bg-info">Активные</button>
                <button id="btn-archive" onclick="showArchive()" class="btn btn-outline-info mx-2">Архив</button>
            </div>
        </div>
    </div>
    <div id="active">
    @foreach($activeEvents as $event)
    <div class="border m-4 mt-0 mb-2">
        <div class="row g-0 p-3">
            <div class="col col-lg-8">
                <h5 class="text-dark fw-normal mb-3"><a href="{{route('platform.events.edit', $event->id)}}">{{$event->name}}</a></h5>
                <p>{{$event->descriptions}}</p>
                <div class="d-flex">
                    <a href="{{route('platform.events.estimate', $event->id)}}" class="btn btn-outline-info text-info">Оценить</a>
                    <button class="btn btn-outline-info mx-2">Отчет</button>
                </div>
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
    <div id="archive" class="d-none">
        @foreach($archiveEvents as $event)
            <div class="border m-4 mt-0 mb-2">
                <div class="row g-0 p-3">
                    <div class="col col-lg-8">
                        <h5 class="text-dark fw-normal mb-3">{{$event->name}}</h5>
                        <p>{{$event->descriptions}}</p>
                        <button class="btn btn-outline-info">Отчет</button>
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
</div>

<script>
    let showActive = () => {
        document.querySelector('#active').className = 'd-block'
        document.querySelector('#archive').className = 'd-none'
        document.querySelector('#btn-active').className = 'btn btn-outline-info bg-info'
        document.querySelector('#btn-archive').className = 'btn btn-outline-info mx-2'
    }

    let showArchive = () => {
        document.querySelector('#archive').className = 'd-block'
        document.querySelector('#active').className = 'd-none'
        document.querySelector('#btn-archive').className = 'btn btn-outline-info mx-2 bg-info'
        document.querySelector('#btn-active').className = 'btn btn-outline-info'
    }
</script>
