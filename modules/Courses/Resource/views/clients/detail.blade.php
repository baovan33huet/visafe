@extends('layouts.client')
@section('content')
    @include('parts.client.page_title')
    <section class="course-detal">
        <div class="container">
            <div class="row relative">
                <div class="col-12 col-lg-9">
                    <div class="submenu">
                        <ul>
                            <li>
                                <a href="#information">
                                    <i class="fa-solid fa-file"></i> Thông tin chung
                                </a>
                            </li>
                            <li>
                                <a href="#curriculum">
                                    <i class="fa-solid fa-book"></i>
                                    Giáo trình
                                </a>
                            </li>
                            <li>
                                <a href="#author">
                                    <i class="fa-solid fa-user"></i>
                                    Giảng viên
                                </a>
                            </li>
                            <li>
                                <a href="#evaluate">
                                    <i class="fa-solid fa-comment"></i>
                                    Đánh giá
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="course-descreption" id="information">
                        <div class="course-content">
                            <h4>nội dung khóa học</h4>
                            <p class="course-content-infor">
                               {!! $course->detail !!}
                            </p>
                        </div>

                    </div>
                    <div class="accordion mb-5" id="curriculum">
                        <div class="accordion-top">
                            <p>
                                <i class="fa-solid fa-book me-1"></i>
                                Gồm: {{getLessonCount($course)->module}} phần - {{getLessonCount($course)->lesson}} bài giảng
                            </p>
                            <p>
                                <i class="fa-solid fa-clock me-1"></i>
                                Thời lượng: {{getTimeClientDetail($course->durations)}} giờ
                            </p>
                        </div>
                        @include('courses::clients.lesson')
                    </div>
                    @if ($course->teacher)
                    <div class="course-video mb-4" id="author">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="{{$course->teacher->image}}" alt="{{$course->teacher->name}}" class="rounded-circle" style="width: 80px;">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 style="margin-bottom: 3px">Giảng viên</h5>
                                <h4 class="mt-2" style="margin-bottom: 4px; color:#f60;"><a
                                        href="/giang-vien/{{$course->teacher->slug}}">{{$course->teacher->name}}</a></h4>
                                <ul>
                                    <li>
                                        <p class="clock">
                                            <i class="fa-solid fa-chart-simple"></i>
                                            Kinh nghiệm: {{$course->teacher->exp}} năm
                                        </p>
                                    </li>
                                    <li>
                                        <p class="clock">
                                            <i class="fa-solid fa-book"></i>
                                            Số khoá học: {{$allCourses->where('teacher_id', $course->teacher->id)->count()}}
                                        </p>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <p class="course-content-infor mt-3">
                            {!!$course->teacher->description!!}
                        </p>

                    </div>
                    @endif
                    <div class="course-video mb-4" id="evaluate">
                        <h2 class="fs-4">Học viên đánh giá</h2>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="course-profile mb-4">
                        <div class="img">
                            <img src="{{$course->thumbnail}}" alt="" />
                        </div>
                        <div class="group-text">
                            <p class="price">
                                <i class="fa-solid fa-tag"></i>
                                @if ($course->sale_price)
                                    <span class="sale">{{money($course->price)}}</span>
                                    <span>{{money($course->sale_price)}}</span>
                                @else
                                    <span class="">{{money($course->price)}}</span>
                                @endif
                            </p>
                            <p class="bookmark">
                                <i class="fa-solid fa-bookmark"></i>
                                Mã Khóa Học: {{$course->code}}
                            </p>

                            <p class="techer">
                                <i class="fa-solid fa-user"></i>
                                Giảng viên: {{$course->teacher->name}}
                            </p>

                            <p class="chart">
                                <i class="fa-solid fa-chart-simple"></i>
                                Kinh nghiệm: {{$course->teacher->exp}} năm
                            </p>
                            <p class="clock">
                                <i class="fa-solid fa-clock"></i>
                                Thời lượng: {{getTimeClientDetail($course->durations)}} giờ học
                            </p>

                            <p class="clock">
                                <i class="fa-solid fa-phone"></i>
                                Hỗ trợ: {{$course->supports}}
                            </p>

                            <p class="clock">
                                <i class="fa-solid fa-file"></i>
                                Tài liệu đính kèm: {{$course->is_document == 1 ? 'Có' : 'Không'}}
                            </p>
                            <button class="payment">đặt mua khóa học</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>

        window.addEventListener("DOMContentLoaded", () => {

            const modalElm = document.querySelector('#modal');
            const btnTrialList = document.querySelectorAll('.btn-trial');
            if (btnTrialList.length) {
                btnTrialList.forEach((btnTrial) => {
                    btnTrial.addEventListener('click', (e) => {
                        const initialBtn = e.target.innerText;
                        const id = e.target.dataset.id;

                        if (!id) {
                            alert('khong co video hoc thu');
                            return;
                        }

                        const modal = new bootstrap.Modal(modalElm);


                        const url = "{{route('courses.data.trial')}}" + '/' + id;

                        e.target.innerText = "Đang mở...";
                        fetch(url).then((response) => {
                            return response.json()
                        }).then(({success, data}) => {

                            if (success == false) {
                                alert('khong co bgiang')
                                return;
                            }
                            if (data.is_trial !== 1) {
                                alert('loi')
                                return;
                            } else {
                                const name = data.name;
                                const videoUrl = data.video.url;

                                modal.show();
                                modalElm.querySelector('.modal-title').innerText = name;
                                modalElm.querySelector('.modal-body').innerHTML =
                        `<video id="my-video"
                                class="video-js"
                                preload="auto"
                                controls
                                data-setup="{}" >
                                    <source src="/data/stream-video?video=${videoUrl}" type="video/mp4" />
                                    <p class="vjs-no-js">
                                    To view this video please enable JavaScript
                                </p>
                            </video>`;
                            }
                        }).finally( () => {
                            e.target.innerText = initialBtn;
                            const myVideoEl = modalElm
                                .querySelector(".modal-body")
                                .querySelector("#my-video");
                            videojs(myVideoEl);
                        });

                    })
                });
            }

            modalElm.addEventListener("hidden.bs.modal", (e) => {
                modalElm.querySelector('.modal-title').innerText = '';
                modalElm.querySelector('.modal-body').innerText = '';
            });
        })
    </script>
@endsection
