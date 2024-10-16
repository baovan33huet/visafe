<div class="document-title title mt-3">
    <ul class="list-group">
        @foreach(getLessonByPosition($course, null, true) as $lesson)
            <li class="list-group-item"><a target="_blank" href="{{$lesson->document->url}}">{{$lesson->name}} ({{getSize($lesson->document->size)}})</a>  </li>
        @endforeach
    </ul>
</div>
