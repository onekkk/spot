<!DOCTYPE>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    @yield('head') 
</head>
<body>
    <div class="">
        <div class="">
            <header>
                <div id="mobile_nav"> 
                @if ($is_auth)
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <h1 class="" id="tr_h1"> <a href="./">
                                    <img src="img/Logo.png" alt="">
                                </a> </h1> <button class="navbar-toggler collapsed" id="humberger_wrap" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <div id="humberger">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </button>
                        <div class="navbar-collapse collapse" id="navbarSupportedContent" style="">
                            <div class="mx-auto" id="mb_serach"> @yield('serach') </div>
                            <ul class="mr-auto">
                                <li class="nav-item"> <a class="m_nav_drops_item nav-link" href="./add">スポット登録</a> </li>
                                <li class="nav-item"> <a class="m_nav_drops_item nav-link" href="./profile">ユーザー情報</a> </li>
                                <li class="nav-item"> <a class="m_nav_drops_item nav-link" href="./follow_list">フォローリスト</a> </li>
                                <li class="nav-item"> <a class="m_nav_drops_item nav-link" href="./bookmark_list">お気に入りリスト</a> </li>
                                <li class="nav-item"> <a class="m_nav_drops_item nav-link" href="./logout">ログアウト</a> </li>
                            </ul>
                        </div>
                    </nav> 
                    @else
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <h1 class=""> 
                                        <a href="./">
                                            <img src="img/Logo.png" alt="">
                                        </a> 
                                    </h1>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="float-right">
                                        <nav>
                                            <div id="fa_auth"> 
                                                <a href="./register" class="btn btn-primary btn_link" id="regi_bt">新規登録</a> 
                                                <a href="./login" class="btn btn-primary btn_link" id="log_bt">ログイン</a> 
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    @endif 
                </div>
                <div id="desktop_nav">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-9">
                                <div class="row">
                                    <h1 class=""> 
                                        <a href="./">
                                            <img src="img/Logo.png" alt="">
                                        </a> 
                                    </h1>
                                    <div class="col-md-7"> 
                                        @yield('serach') 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 clearfix">
                                <div class="float-right">
                                    <!-- <div class="col-md-6"></div> -->
                                    <div class="">
                                        <nav> 
                                        @if ($is_auth)
                                            <div class="col-md-12" style="padding: 0px;" id="tr_auth"> 
                                                <button class="btn btn-secondary nav_header_hidden" id="nav_header">{{$user_name}}でログイン中 </button>
                                                <ul id="nav_drops" class="nav_drops_hidden">
                                                    <li> <a class="col-md-12" href="./add">スポット登録</a> </li>
                                                    <li> <a class="" href="./profile">ユーザー情報</a> </li>
                                                    <li> <a class="" href="./follow_list">フォローリスト</a> </li>
                                                    <li> <a class="" href="./bookmark_list">お気に入りリスト</a> </li>
                                                    <li> <a class="" href="./logout">ログアウト</a> </li>
                                                </ul>
                                            </div> 
                                        @else
                                            <div id="fa_auth"> <a href="./register" class="btn btn-primary btn_link" id="regi_bt">新規登録</a> <a href="./login" class="btn btn-primary btn_link" id="log_bt">ログイン</a> </div> 
                                        @endif 
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- /header -->
        </div>
    </div>
    @yield('content') 
    @yield('script')
    <script>
        var state = false;
            document.getElementById("nav_header").onclick = function() {
                if(state){
                    document.getElementById("nav_header").className = 'btn btn-secondary col-md-12 nav_header_hidden';
                    document.getElementById("nav_drops").className = 'nav_drops_hidden';
                    state = false;
                }else{
                    document.getElementById("nav_header").className = 'btn btn-secondary col-md-12 nav_header_show';
                    document.getElementById("nav_drops").className = 'nav_drops_show';
                    state = true;
                }
                
            };
        
            var nav_header = document.getElementById("nav_header");
            var nav_drops = document.getElementById("nav_drops");
        
            nav_drops.addEventListener('mouseenter', () => {
        　　  nav_header.className = "btn btn-secondary nav_header_show";
            }, false);
        
            //OUT
            nav_drops.addEventListener('mouseleave', () => {
            　　nav_header.className = "btn btn-secondary nav_header_hidden";
              
            }, false);
    </script>
</body>
</html>