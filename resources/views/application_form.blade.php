<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> تطبيق احمد محمو … اتصل بنا </title>
    <link href="{{ asset('board_assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('board_assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/rtl/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        a , h1 , h2 , h3 , ul , li , li > a , h4 , h5 , h6 , span , input , table , thead , tbody , th , td , tr  , button , div {
            font-family: 'Cairo', sans-serif !important;
            font-weight:bold !important;
        }
    </style>
    <script src="{{ asset('board_assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</head>

<body>
    <div class="page-content">
        <div class="content-wrapper">
            <div class="content-inner">
                <div class="content d-flex justify-content-center align-items-center">
                    <form action="{{ route('application_form.store') }}" class="flex-fill">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="text-center mb-3">
                                            <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                                                <img width="200" src="{{ asset('board_assets/am_academy_logo.jpeg') }}"  alt="am academy">
                                            </div>
                                            <h5 class="mb-0"> طلبات الانضمام </h5>
                                            <span class="d-block text-muted"> برجاء ملىئ البيانات ادناه </span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"> الاسم </label>
                                            <div class="form-control-feedback form-control-feedback-start">
                                                <input type="text" class="form-control" placeholder="الاسم">
                                                <div class="form-control-feedback-icon">
                                                    <i class="ph-user-circle text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"> رقم الموبيل </label>
                                            <div class="form-control-feedback form-control-feedback-start">
                                                <input type="text" class="form-control" placeholder="رقم الموبيل">
                                                <div class="form-control-feedback-icon">
                                                    <i class="ph-user-circle text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"> عنوان الرساله </label>
                                            <div class="form-control-feedback form-control-feedback-start">
                                                <input type="text" class="form-control" placeholder="عنوان الموضوع">
                                                <div class="form-control-feedback-icon">
                                                    <i class="ph-user-circle text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"> رسالتك </label>
                                            <div class="form-control-feedback form-control-feedback-start">
                                                <textarea name="" col="3" rows='3' class="form-control " id=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body text-end border-top">
                                        <button type="submit" class="btn btn-primary">
                                            ارسال
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="navbar navbar-sm navbar-footer border-top">
                    <div class="container-fluid">
                        <span>&copy; 2024 جميع الحقوق محفوظه </span>                
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
