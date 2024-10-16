@extends('layouts.client')
@section('content')
@include('parts.client.page_title')
    <section class="all-course">
        <div class="container">
            <div class="row mb-4">
                @if ($courses)
                    @foreach($courses as $course)
                        <div class="col-12 col-lg-6">
                    <div class="d-flex course">
                        <div class="banner-course d-flex align-items-center" style="width: 50%;">
                            <img src="{{$course->thumbnail}}" alt="{{$course->name}}" style="width: 100%" />
                        </div>
                        <div class="descreption-course">
                            <div class="descreption-top">
                                <p><i class="fa-solid fa-clock"></i> {{getTimeClient($course->durations)}} học</p>
                                <p><i class="fa-solid fa-video"></i> {{getLessonCount($course)->module}} phần/{{getLessonCount($course)->lesson}} bài</p>
                                <p><i class="fa-solid fa-eye"></i> {{$course->view == 0 ? 0 : number_format($course->view)}}</p>
                            </div>
                            <h5 class="descreption-title">
                                <a href="/khoa-hoc/{{$course->slug}}">
                                   {{$course->name}}
                                </a>
                            </h5>
                            <div class="descreption-teacher">
                                <img src="{{$course->teacher?->image}}" alt="{{$course->teacher?->name}}" />
                                <span>{{$course->teacher?->name}}</span>
                            </div>
                            <p class="descreption-price">
                                @if ($course->sale_price)
                                    <span class="sale">{{money($course->price)}}</span>
                                    <span>{{money($course->sale_price)}}</span>
                                @else
                                    <span class="">{{money($course->price)}}</span>
                                @endif

                            </p>
                        </div>
                    </div>
                </div>
                    @endforeach

               @endif
            </div>
            <div class="text-right">
                {{$courses->links()}}

            </div>

        </div>

    </section>
@endsection
