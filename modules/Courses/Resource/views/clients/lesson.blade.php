@php $i = 1 @endphp
@foreach(getModuleByPosition($course) as $key => $module)
    @if($module->parent_id == null)
        <div class="accordion-group">
            <h5 class="accordion-title {{$key == 0 ? 'active' : ''}}">{{$module->name}}</h5>
            @foreach(getLessonByPosition($course, $module->id) as $lesson)
                @if($lesson)
                <div class="accordion-detail" style="{{$key == 0 ? 'display: block;' : ''}}">
                <div class="card-accordion">
                    <div>
                          <a href="{{route('lesson.index', $lesson->slug)}}" style="color: black;">Bài {{$i++}}: {{ $lesson->name }}</a>
                        @if($lesson->is_trial)
                            <p class="btn-trial" data-id="{{$lesson->id}}">Học thử</p>
                        @endif
                            <span class="align-items-center">{{getTimeDuration($lesson->duration)}}</span>
                    </div>
                </div>
                </div>
                @endif
            @endforeach
        </div>
    @endif
@endforeach

