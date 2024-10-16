<div class="accordion active title">
    @php $i = 1 @endphp
    @foreach(getModuleByPosition($course) as $key => $module)
        @if($module->parent_id == null)
            <div class="accordion-group">
                <h5 style="font-size: 17px;" class="accordion-title {{$lesson->parent_id == $module->id ? 'active' : ''}}">{{$module->name}}</h5>
                @foreach(getLessonByPosition($course, $module->id) as $lesson_item)
                    @if($lesson_item)
                        <div class="accordion-detail" style="{{$lesson->parent_id == $module->id ? 'display: block;' : ''}}">
                            <div class="card-accordion {{$lesson->id == $lesson_item->id ? 'activeLesson' : ''}}">
                                <div>
                                    <a class="" href="{{route('lesson.index', $lesson_item->slug)}}" style="color: black; font-size: 12px">Bài {{$i++}}: {{ $lesson_item->name }}</a>
                                    <span class="align-items-center" style="font-size: 12px;">{{getTimeDuration($lesson_item->duration)}}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    @endforeach
</div>
