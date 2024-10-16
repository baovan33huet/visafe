@extends('layouts.client')
@section('content')
@include('parts.client.page_title')
<section class="video">
    <div class="container shadow p-3 mb-5 bg-body rounded">
        <h3>{{$lesson->name}}</h3>
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="video-detail">
                    `<video id="my-video"
                            class="video-js"
                            preload="auto"
                            controls
                            data-setup="{}" >
                        <source src="/data/stream-video?video={{$lesson->video->url}}" type="video/mp4" />
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript
                        </p>
                    </video>`;

                </div>
                <div class="d-flex justify-content-between mt-3">
                    <div>
                        @if ($prevLesson)
                            <a class="prev text-dark" href="{{route('lesson.index', $prevLesson->slug)}}" >Quay lại</a>
                        @endif
                    </div>

                    <div>
                        @if ($nextLesson)
                            <a class="next text-dark" href="{{route('lesson.index', $nextLesson->slug)}}">Tiếp theo</a>
                        @endif
                    </div>


                </div>
            </div>
            <div class="col-12 col-lg-4" style="margin-top: 24px;">
                <div class="nav flex">
                    <p class="lesson active">Bài học</p>
                    <p class="document">Tài liệu</p>
                </div>
                <div class="group">
                    @include('lessons::clients.lessons')
                    @include('lessons::clients.document')

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
    <script>
        const myVideoEl = querySelector("#my-video");
        videojs(myVideoEl);
    </script>
@endsection
