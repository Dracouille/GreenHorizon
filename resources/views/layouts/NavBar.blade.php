
<img style =" width:30% " class="img-responsive img-center" src="{{asset('img/logo.png')}}" alt="logo">
{{--<div class="brand" style="visibility:hidden">Green Horizon</div>--}}
<h1 style="text-indent: -9999px; font-size: small">Green Horizon</h1>
<!-- <div class="address-bar">Paysagiste</div> -->

<!-- Navigation -->
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
            <a class="navbar-brand" href="index.html">Business Casual</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{route('home')}}">Accueil</a>
                </li>
                <li>
                    <a href="{{route('galerie')}}">Photos</a>
                </li>
                <li>
                    <a href="{{route('contact')}}">Contact</a>
                </li>
                <li>
                    <a href="{{route('avis')}}">Livre d'or</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>