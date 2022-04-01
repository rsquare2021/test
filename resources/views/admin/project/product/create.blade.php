@extends('layouts.app')

@section('content')

            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <a class="btn btn-primary course_duplicate mt-2 mb-4">コース追加</a>
                                <div id="course">
                                    <div class="course_wrap mb-4">
                                        <h6>コース名</h6>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <input type="text" class="form-control pro_name" name="pro_name" placeholder="キャンペーン名">
                                            </div>
                                        </div>
                                        <h6>交換ルール</h6>
                                        <div class="row mb-4">
                                            <div class="col company_wrap">
                                                <select class="form-control theme_id">
                                                    <option>選択してください</option>
                                                    <option>ルール1</option>
                                                    <option>ルール2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <h6>必要ポイント</h6>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <input type="text" class="form-control pro_point_per" name="pro_point_per" placeholder="半角数字">
                                            </div>
                                        </div>

                                        <div class="parent ex-2">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div id="left-events" class="dragula     ">
                                                        
                                                        <div class="media   d-block d-sm-flex  ex-moved">
                                                            <img alt="avatar" src="assets/img/120x120.jpg" class="img-fluid ">
                                                            <div class="media-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="">Shaun Park</h6>
                                                                        <p class="">New project meeting.</p>
                                                                    </div>
                                                                    <div class="">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star f-icon-line" style="display:block"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                                        <i class="f-icon-fill flaticon-star-fill-1" style="display: none"></i>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart f-icon-fill" style="display: none"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><div class="media   d-block d-sm-flex    ex-moved">
                                                            <img alt="avatar" src="assets/img/90x90.jpg" class="img-fluid ">
                                                            <div class="media-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="">Andy King</h6>
                                                                        <p class="">Get new project details from Shaun</p>
                                                                    </div>
                                                                    <div class="">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star f-icon-line" style="display:block"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                                        <i class="f-icon-fill flaticon-star-fill-1" style="display: none"></i>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart f-icon-fill" style="display: none"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><div class="media   d-block d-sm-flex">
                                                            <img alt="avatar" src="assets/img/90x90.jpg" class="img-fluid ">
                                                            <div class="media-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="">Judy Holmes</h6>
                                                                        <p class="">A post is edited by Mary.</p>
                                                                    </div>
                                                                    <div class="">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star f-icon-line" style="display:block"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                                        <i class="f-icon-fill flaticon-star-fill-1" style="display: none"></i>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart f-icon-fill" style="display: none"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="media   d-block d-sm-flex">
                                                            <img alt="avatar" src="assets/img/120x120.jpg" class="img-fluid ">
                                                            <div class="media-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="">Alma Clarke</h6>
                                                                        <p class="">Pick up Lisa Doe from the airport.</p>
                                                                    </div>
                                                                    <div class="">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star f-icon-line" style="display:block"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                                        <i class="f-icon-fill flaticon-star-fill-1" style="display: none"></i>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart f-icon-fill" style="display: none"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div id="right-events" class="dragula    ">
                                                        <div class="media   d-block d-sm-flex">
                                                            <img alt="avatar" src="assets/img/90x90.jpg" class="img-fluid ">
                                                            <div class="media-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="">John Doe</h6>
                                                                        <p class="">New post is written by Andy.</p>
                                                                    </div>
                                                                    <div class="">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star f-icon-line" style="display:none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                                        <i class="f-icon-fill flaticon-star-fill-1" style="display: block"></i>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart f-icon-fill" style="display: none"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="media   d-block d-sm-flex  ex-moved">
                                                            <img alt="avatar" src="assets/img/90x90.jpg" class="img-fluid ">
                                                            <div class="media-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="">Lisa Doe</h6>
                                                                        <p class="">New post is written by Andy.</p>
                                                                    </div>
                                                                    <div class="">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star f-icon-line" style="display:block"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                                        <i class="f-icon-fill flaticon-star-fill-1" style="display: none"></i>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart f-icon-fill"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><div class="media   d-block d-sm-flex">
                                                            <img alt="avatar" src="assets/img/120x120.jpg" class="img-fluid ">
                                                            <div class="media-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="">Linda Nelson</h6>
                                                                        <p class="">New project meeting.</p>
                                                                    </div>
                                                                    <div class="">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star f-icon-line" style="display:none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                                        <i class="f-icon-fill flaticon-star-fill-1" style="display: block"></i>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart f-icon-fill" style="display: none"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="media   d-block d-sm-flex">
                                                            <img alt="avatar" src="assets/img/90x90.jpg" class="img-fluid ">
                                                            <div class="media-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="">Angie Young</h6>
                                                                        <p class="">Get new project details from Shaun</p>
                                                                    </div>
                                                                    <div class="">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star f-icon-line" style="display:none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                                        <i class="f-icon-fill flaticon-star-fill-1" style="display: block"></i>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart f-icon-fill" style="display: none"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="media   d-block d-sm-flex">
                                                            <img alt="avatar" src="assets/img/90x90.jpg" class="img-fluid ">
                                                            <div class="media-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="">Amy Diaz</h6>
                                                                        <p class="">A post is edited by Mary.</p>
                                                                    </div>
                                                                    <div class="">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star f-icon-line" style="display:none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                                        <i class="f-icon-fill flaticon-star-fill-1" style="display: block"></i>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart f-icon-fill" style="display: none"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="media   d-block d-sm-flex">
                                                            <img alt="avatar" src="assets/img/90x90.jpg" class="img-fluid ">
                                                            <div class="media-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="">
                                                                        <h6 class="">Lila Perry</h6>
                                                                        <p class="">Pick up Lisa Doe from the airport.</p>
                                                                    </div>
                                                                    <div class="">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star f-icon-line" style="display:none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                                        <i class="f-icon-fill flaticon-star-fill-1" style="display: block"></i>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart f-icon-fill" style="display: none"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="product_create_btn" class="btn btn-primary product_create_btn">
                        </div>
                    </div>

                </div>

            </div>

@endsection