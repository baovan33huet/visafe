@extends('layouts.client')
@section('content')
    @include('parts.client.page_title')
    <section class="all-course">
        <div class="container">
            <div class="row mt-3">
                <div class="col-3">
                    @include('students::clients.menu')
                </div>
                <div class="col-9">
                    <h2>Tổng quan</h2>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sit qui recusandae, soluta, minima eveniet eligendi natus eius iste cum dicta aut ut sint officiis error quasi dolores corrupti. Quia, similique?
                    </p>
                </div>
            </div>

        </div>

    </section>
@endsection
