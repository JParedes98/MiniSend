@extends('layouts.website')

@section('navbar')
    @include('partials.website_navbar')
@endsection

@section('content')
{{-- HERO --}}
<div class="jumbotron hero-section">
    <div class="overlay"></div>
    <div class="overlay-img"></div>

    <div class="container hero-content">
        <h2>Welcome to <span>MiniSend</span></h2>
        <p>
            A powerful infrastructure to scale quickly. An intuitive interface so the entire team can contribute. A
            smarter way to work.
        </p>
        <b-button href="{{ route('login') }}" size="lg" pill variant="primary">GET STARTED</b-button>
    </div>
</div>

<div class="container" style="min-height: 50vh;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12 mt-5">
            <h2 class="text-center text-primary font-weight-bold">OUR SERVICES</h2>
            <hr class="divider">
            <p class="text-center text-muted">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, dignissimos!
                Lorem ipsum dolor sit amet, consectetur.
            </p>
        </div>
    </div>

    <div class="row align-items-center mt-5">
        <div class="col">
            <div class="d-block m-auto text-center">
                <div class="icon">
                    <i class="fas fa-code"></i>
                </div>
            </div>
            <h4 class="text-center text-muted font-weight-bold">Content Writing</h4>
            <p class="text-center text-muted">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.
            </p>
        </div>

        <div class="col">
            <div class="d-block m-auto text-center">
                <div class="icon">
                    <i class="fas fa-crop-alt"></i>
                </div>
            </div>
            <h4 class="text-center text-muted font-weight-bold">Content Writing</h4>
            <p class="text-center text-muted">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.
            </p>
        </div>

        <div class="col">
            <div class="d-block m-auto text-center">
                <div class="icon">
                    <i class="fas fa-paper-plane"></i>
                </div>
            </div>
            <h4 class="text-center text-muted font-weight-bold">Content Writing</h4>
            <p class="text-center text-muted">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.
            </p>
        </div>
    </div>
</div>

<section class="jumbotron section-info" id="about">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8 col-md-12 col-xs-12">
                <h2 class="font-weight-bold text-primary">Some Features</h2>
                <p class="text-white">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, dignissimos!
                    <br>
                    Lorem ipsum dolor sit amet, consectetur.
                </p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12 col-xs-12">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-xs-12 text-center">
                            <span class="icon">
                                <i class="fas fa-rocket"></i>
                            </span>
                            <div class="text">
                                <h4 class="text-primary" class="">Bootstrap 4 Based</h4>
                                <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-12 text-center">
                            <div class="d-block m-auto">
                                <span class="icon">
                                    <i class="far fa-edit"></i>
                                </span>
                            </div>
                            <div class="text">
                                <h4 class="text-primary">Fully Responsive</h4>
                                <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-12 text-center">
                            <div class="d-block m-auto">
                                <span class="icon">
                                    <i class="fas fa-envelope-open-text"></i>
                                </span>
                            </div>
                            <div class="text">
                                <h4 class="text-primary">Parallax Background</h4>
                                <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-12 text-center">
                            <div class="d-block m-auto">
                                <span class="icon">
                                    <i class="fas fa-cog"></i>
                                </span>
                            </div>
                            <div class="text">
                                <h4 class="text-primary">Easy to Customize</h4>
                                <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container my-5" style="min-height: 50vh;" id="features">
    <div class="row my-5">
        <div class="col-md-12">
            <h2 class="text-center text-primary font-weight-bold">OUR SERVICES</h2>
            <hr class="divider">
            <p class="text-center text-muted">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, dignissimos!
                Lorem ipsum dolor sit amet, consectetur.
            </p>
        </div>
    </div>

    <div class="row justify-content-between align-items-center my-5">
        <div class="col-md-4 col-sm-12">
            <h2 class="text-center text-primary font-weight-bold">ADITIONAL INFO</h2>
            <hr class="divider">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos minus sint soluta corporis aperiam
                illo recusandae laborum temporibus repudiandae ad esse quasi delectus, deleniti fugit, ratione debitis
                exercitationem similique. Veniam.</p>
            <b-button size="lg" pill variant="outline-primary">Read More</b-button>
        </div>
        <div class="col-md-6 col-sm-12">
            <img src="{{ asset('/images/website/img-2.svg') }}" class="img-fluid" alt="">
        </div>
    </div>

    <div class="row justify-content-between align-items-center my-5">
        <div class="col-md-6 col-sm-12">
            <img src="{{ asset('/images/website/img-2.svg') }}" class="img-fluid" alt="">
        </div>
        <div class="col-md-4 col-sm-12">
            <h2 class="text-center text-primary font-weight-bold">ADITIONAL INFO 2</h2>
            <hr class="divider">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos minus sint soluta corporis aperiam
                illo recusandae laborum temporibus repudiandae ad esse quasi delectus, deleniti fugit, ratione debitis
                exercitationem similique. Veniam.</p>
            <b-button size="lg" pill variant="outline-primary">Read More</b-button>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('partials.website_footer')
@endsection