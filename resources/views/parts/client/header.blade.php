<header class="header">
    <div class="action-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="d-none d-lg-block col-lg-2">
                    <form>
                        <input type="text" placeholder="Bạn tìm gì" />
                        <button type="submit" class="btn btn-primary">Tìm</button>
                    </form>
                </div>
                <div class="d-none d-lg-block col-lg-7">
                    <div class="d-flex">
                        <p class="slogan">
                            <i class="fas fa-phone"></i>Tư vấn & hỗ trợ:
                            <a href="#">0989341634</a>
                        </p>
                        <p class="mail">
                            <i class="far fa-envelope"></i>
                            <a href="#">ngocnguyenchi1507@gmail.com</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="social">

                        @if (Auth('students')->check())
                            <ul class="d-flex gap-2">
                                <li class="text-uppercase">{{Auth('students')->user()->name}}</li>
                                <li>
                                    <a href="{{route('students.account.index')}}">Tài Khoản</a>
                                </li>
                                <li>
                                    <a href="" onclick="document['form-logout'].submit(); return false;">Đăng Xuất</a>
                                </li>
                                <form name="form-logout" action="{{route('clients.logout')}}" method="post">
                                    @csrf
                                </form>
                            </ul>
                        @else
                            <button class="btn btn-primary">
                                <i class="fas fa-user"></i> <a class="text-decoration-none text-white" href="{{route('clients.register')}}">Đăng ký</a>
                            </button>
                            <button class="btn btn-primary">
                                <i class="fas fa-key"></i><a class="text-decoration-none text-white" href="{{route('clients.login')}}">Đăng nhập</a>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{asset('clients/assets/logo.png')}}" alt="" />
            </a>
            <button
                class="navbar-toggler d-lg-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">
                            <i class="fas fa-home"></i>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('courses.index')}}">
                            <i class="fas fa-tv"></i>
                            Khóa học
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-route"></i>
                            Lộ trình
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-globe-europe"></i>
                            Kiến thức
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-star"></i>
                            Tuyển dụng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-broadcast-tower"></i>
                            CTV
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-user"></i>
                            DSCons
                        </a>
                    </li>
                </ul>
            </div>
            <a href="{{route('carts.index')}}">
                <p class="cart">
                    <i class="fas fa-shopping-cart"></i>
                </p>
            </a>

        </div>
    </nav>
</header>
