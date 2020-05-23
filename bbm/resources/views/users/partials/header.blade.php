<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
    style="background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-primary opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
                <h1 class="display-2 text-white"></h1>
                @if (isset($title) && $title)
                <h6 class="h2 text-white d-inline-block mb-0">{{$title}}</h6>
                @endif
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                        @if (isset($sub_title) && $sub_title)
                        <li class="breadcrumb-item active" aria-current="page">{{$sub_title}}</li>
                        @endif
                        @if (isset($title) && $title)
                        <li class="breadcrumb-item"><a href="#">{{$title}}</a></li>
                        @endif
                        
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>