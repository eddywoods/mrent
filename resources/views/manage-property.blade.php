@extends('layouts.app')

@section('content')
<main id="ts-main">

    <!--BREADCRUMB
        =========================================================================================================-->
    <section id="breadcrumb">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Library</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
            </nav>
        </div>
    </section>

    <!--PAGE TITLE
        =========================================================================================================-->
    <section id="page-title">
        <div class="container">
            <div class="row">
                <div class="offset-lg-1 col-lg-10">
                    <div class="ts-title">
                        <h1>Submit</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--SUBMIT FORM
        =========================================================================================================-->
    <section id="submit-form">
        <div class="container">
            <div class="row">

                <div class="offset-lg-1 col-lg-10">

                    <form id="form-submit" class="ts-form">

                        <!--ALERT
                            =====================================================================================-->
                        <section id="alert">
                            <div class="alert alert-primary p-5 d-block d-sm-flex align-items-center mb-5" role="alert" data-bg-color="rgba(230,230,255,.2)">

                                <!--ICON-->
                                <i class="fa fa-exclamation-triangle display-4 font-weight-bold ts-opacity__30 mr-5 py-2"></i>

                                <!--CONTENT-->
                                <aside>
                                    <h5 class="font-weight-normal">Please Login Or Register</h5>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat
                                        tempor sapien.
                                        In lobortis posuere tincidunt. Curabitur malesuada tempus ligula nec
                                    </p>
                                  <a href="{{ url('register') }}" class="btn btn-light btn-xs">Register</a>
                                    <a href="{{ url('login') }}" class="btn btn-light btn-xs">Login</a>
                                </aside>
                            </div>
                            <!--end alert-->

                        </section>

                  

                    </form>
                    <!--end #form-submit-->

                </div>
                <!--end offset-lg-1 col-lg-10-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>

</main>
<!--end #ts-main-->

@endsection