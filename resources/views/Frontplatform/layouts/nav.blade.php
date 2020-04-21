<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#cfcbc6">
    <div class="container">
        <a class="navbar-brand logo" href="{{ route('index') }}">
            <img src="/img/new_frontplatform/Logo.png" style="width: 100%;height: 100%">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="button-item" href=" http://old.amtbcollege.org">學院舊站</a>
                </li>
                <li class="nav-item">
                    <a class="button-item" href="https://ft.amtb.tw">圖文檢索</a>
                </li>
                <li class="nav-item">
                    <a class="button-item" href="{{ route('magazine.index') }}">佛陀教育雜誌</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="button-item " href="#" data-toggle="dropdown">認識學院</a>
                        <div class="dropdown-menu" >
                            <a class="dropdown-item" href="{{ route('introduction') }}">成立緣起</a>
                            <a class="dropdown-item" href="{{ route('teacher_introduction') }}">導師介紹</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="button-item" href="{{ route('news.index') }}">消息公告</a>
                </li>
                <li class="nav-item">
                    <a class="button-item" href="{{ route('MGPlatform.login') }}">校務行政</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        {{--登入後便入學指導--}}
                        <a class="button-item" href="#" data-toggle="dropdown">新生入學</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('guide') }}">入學指導</a>
                            {{--登入後無註冊報名--}}
                            @if(!Auth::check())
                            <a class="dropdown-item" href="{{ route('registration.index') }}">註冊報名</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('course_introduction') }}">課程介紹</a>
                            <a class="dropdown-item" href="{{ route('calendar') }}">年度行事曆</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    @if(Auth::check())
                        <div class="dropdown">
                            <a class="button-item" href="#" data-toggle="dropdown"><i class="fas fa-user"></i>  {{ \Illuminate\Support\Facades\Auth::user()->account }}</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                @can('classroom.view')<a class="dropdown-item" href="{{ route('classroom.index') }}">線上課程</a>@endcan
                                @can('report.view')<a class="dropdown-item" href="{{ route('report.index') }}">提交報告</a>@endcan
                                <a class="dropdown-item" href="{{ route('discussion.index') }}">討論版</a>
                                <a class="dropdown-item" href="{{ route('calendar') }}">年度行事曆</a>
                                <a class="dropdown-item" href="{{ route('material_download.index') }}">教材下載</a>
                                @can('st_merit.view')<a class="dropdown-item" href="{{ route('merit.index') }}">功過格</a>@endcan
                                <a class="dropdown-item" href="{{ route('query_history.index') }}">查詢歷年課程成績</a>
                                <a class="dropdown-item" href="{{ route('drop_school.index') }}">申請{{ \Illuminate\Support\Facades\Auth::user()->data->stay_in_school == 1 ? "休學":"復學"}}</a>
                                @can('elective_course.view')<a class="dropdown-item" href="{{ route('elective_course.index') }}">選課加課</a>@endcan
                                <a class="dropdown-item" href="{{ route('personalInfo.index') }}">個人資料</a>
                                <a class="dropdown-item" href="{{ route('changePassword.index') }}">更改密碼</a>
                                <a class="dropdown-item" href="#logout" data-toggle="modal">登出</a>
                            </div>
                        </div>
                    @else
                        <a class="button-item" href="#login" data-toggle="modal"><i class="fas fa-user"></i>學生登入</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
