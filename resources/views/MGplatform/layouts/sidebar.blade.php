<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        {{--<div class="sidebar-brand-icon">--}}
            {{--<i class="fas fa-laugh-wink"></i>--}}
        {{--</div>--}}
        {{--<div class="sidebar-brand-text mx-3">網路學院</div>--}}
        <img src="/img/frontplatform/logo.png" style="width: 40px;height: 40px">佛陀網路學院後台
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item" name="dashboard_li">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>統計數據</span>
        </a>
    </li>


    <!-- Dashboards Accordion Menu -->
    <li class="nav-item" name="student_li">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#student" aria-expanded="true" aria-controls="student">
            <i class="fas fa-address-card"></i>
            <span>學生管理</span>
        </a>
        <div id="student" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar" name="student">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('data.view')
                    <a class="collapse-item" href="{{ route('data.index') }}">學生資料</a>
                @endcan
                @can('blacklist.view')
                    <a class="collapse-item" href="{{ route('black_list.index') }}">黑名單</a>
                @endcan
                @can('drop.view')
                    <a class="collapse-item" href="{{ route('drop.index') }}">休學/復學</a>
                 @endcan
            </div>
        </div>
    </li>


    <!-- Dashboards Accordion Menu -->
    <li class="nav-item" name="course_li">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#course" aria-expanded="true" aria-controls="course">
            <i class="fas fa-clipboard-list"></i>
            <span>課目學分課程</span>
        </a>
        <div id="course" class="collapse " aria-labelledby="headingOne" data-parent="#accordionSidebar" name="course">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('course.view')
                    <a class="collapse-item" href="{{ route('course.index') }}">學科類別</a>
                @endcan
                @can('course_level.view')
                    <a class="collapse-item" href="{{ route('course_level.index') }}">學科年級</a>
                @endcan
                @can('course_data.view')
                    <a class="collapse-item" href="{{ route('course_data.index') }}">課程影音資料庫</a>
                @endcan
                @can('subject_class.view')
                    <a class="collapse-item" href="{{ route('subject_class.index') }}">科目學分編輯</a>
                @endcan
                @can('sup_elective.view')
                    <a class="collapse-item" href="{{ route('sup_elective.index') }}">選課管理及輔助選課</a>
                @endcan
            </div>
        </div>
    </li>

    {{--<!-- Dashboards Accordion Menu -->--}}
    <li class="nav-item" name="grade_li">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#grade" aria-expanded="true" aria-controls="grade">
            <i class="fas fa-file-alt"></i>
            <span>成績管理</span>
        </a>
        <div id="grade" class="collapse " aria-labelledby="headingOne" data-parent="#accordionSidebar" name="grade">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('work_grade.view')
                <a class="collapse-item" href="{{ route('work_grade.index') }}">課程作業成績</a>
                @endcan
                @can('students_grade.view')
                <a class="collapse-item" href="{{ route('students_grade.index') }}">學生個人成績</a>
                @endcan
{{--                <a class="collapse-item" href="{{ route('de_sing') }}">德行成績</a>--}}
            </div>
        </div>
    </li>

    <!-- Dashboards Accordion Menu -->
    <li class="nav-item" name="lift_li">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#lift" aria-expanded="true" aria-controls="lift">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>升降級管理</span>
        </a>
        <div id="lift" class="collapse " aria-labelledby="headingOne" data-parent="#accordionSidebar" name="lift">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('students_update.view')
                <a class="collapse-item" href="{{ route('students_update.index') }}">學生升級管理</a>
                @endcan

                @can('recode_update.view')
                <a class="collapse-item" href="{{ route('recode_update.index') }}">升級紀錄名單</a>
                @endcan
                {{--<a class="collapse-item" href="">升級贈品管理</a>--}}
            </div>
        </div>
    </li>

    @can('bulletin.view')
    <li class="nav-item" name="announcement_li">
        <a class="nav-link" href="{{ route('bulletin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>公告管理</span>
        </a>
    </li>
    @endcan

    @can('magazine.view')
    <li class="nav-item" name="magazine_li">
        <a class="nav-link" href="{{ route('magazineMG.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>雜誌管理</span>
        </a>
    </li>
    @endcan

    @can('discussion.view')
    <li class="nav-item" name="discussion_li">
        <a class="nav-link" href="{{ route('discussionMG.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>留言版管理</span>
        </a>
    </li>
    @endcan

    <li class="nav-item" name="gift_li">
        <a class="nav-link" data-toggle="collapse" data-target="#gift_config" aria-expanded="true" aria-controls="gift_config">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>禮品管理</span>
        </a>
        <div id="gift_config" class="collapse " aria-labelledby="headingOne" data-parent="#accordionSidebar" name="gift_config">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('gift_item.view')
                <a class="collapse-item" href="{{ route('gift_item.index') }}">禮品項目</a>
                @endcan
                @can('gift_apply.view')
                <a class="collapse-item" href="{{ route('gift_list.index') }}">禮品申請</a>
                @endcan
            </div>
        </div>
    </li>

    {{--<li class="nav-item" name="email_config_li">--}}
        {{--<a class="nav-link" data-toggle="collapse" data-target="#email_config" aria-expanded="true" aria-controls="email_config">--}}
            {{--<i class="fas fa-fw fa-tachometer-alt"></i>--}}
            {{--<span>信件管理</span>--}}
        {{--</a>--}}
        {{--<div id="email_config" class="collapse " aria-labelledby="headingOne" data-parent="#accordionSidebar" name="email_config">--}}
            {{--<div class="bg-white py-2 collapse-inner rounded">--}}
                {{--@can('email_config_drop.view')--}}
                {{--<a class="collapse-item" href="{{ route('email_config_drop') }}">休復學信件</a>--}}
                {{--@endcan--}}
                {{--@can('email_config_update.view')--}}
                {{--<a class="collapse-item" href="{{ route('email_config_update') }}">升級信件</a>--}}
                {{--@endcan--}}
                {{--@can('email_config_enrollment.view')--}}
                {{--<a class="collapse-item" href="{{ route('email_config_enrollment') }}">新生入學信件</a>--}}
                {{--@endcan--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</li>--}}

    <li class="nav-item" name="edit_li">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#edit" aria-expanded="true" aria-controls="edit">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>頁面編輯</span>
        </a>
        <div id="edit" class="collapse " aria-labelledby="headingOne" data-parent="#accordionSidebar" name="edit">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('indexImage.index') }}">首頁輪播圖片</a>
                @can('edit_admission_guidance.view')
                <a class="collapse-item" href="{{ route('edit_admission_guidance') }}">入學指導</a>
                @endcan
                @can('edit_plan.view')
                <a class="collapse-item" href="{{ route('edit_plan') }}">教學計劃</a>
                @endcan
                @can('edit_understanding.view')
                <a class="collapse-item" href="{{ route('edit_understanding') }}">認識學院</a>
                @endcan
                @can('edit_teacher.view')
                <a class="collapse-item" href="{{ route('teacher_introduction.index') }}">導師介紹</a>
                @endcan
                @can('edit_calendar.view')
                <a class="collapse-item" href="{{ route('edit_calendar') }}">年度行事曆</a>
                @endcan
                @can('edit_description.view')
                <a class="collapse-item" href="{{ route('edit_description') }}">說明看板</a>
                @endcan
                @can('edit_announcement.view')
                <a class="collapse-item" href="{{ route('edit_announcement') }}">重要通知</a>
                @endcan
                @can('edit_merit_rule.view')
                <a class="collapse-item" href="{{ route('edit_merit_rule') }}">功過格－修行守則</a>
                @endcan
                @can('edit_merit_explanation.view')
                <a class="collapse-item" href="{{ route('edit_merit_explanation') }}">功過格－使用說明</a>
                @endcan
            </div>
        </div>
    </li>

    <li class="nav-item" name="download_li">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#download" aria-expanded="true" aria-controls="download">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>資源檔案管理</span>
        </a>
        <div id="download" class="collapse " aria-labelledby="headingOne" data-parent="#accordionSidebar" name="download">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('scripture.view')
                <a class="collapse-item" href="{{ route('scripture.index') }}">經本</a>
                @endcan
                @can('teaching_material.view')
                <a class="collapse-item" href="{{ route('teaching_material.index') }}">教材</a>
                @endcan
            </div>
        </div>
    </li>

    <li class="nav-item" name="merit_li">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#merit" aria-expanded="true" aria-controls="merit">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>功過格</span>
        </a>
        <div id="merit" class="collapse " aria-labelledby="headingOne" data-parent="#accordionSidebar" name="merit">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('merit.view')
                <a class="collapse-item" href="{{ route('merit_MG.index') }}">項目</a>
                @endcan
                @can('merit_item.view')
                <a class="collapse-item" href="{{ route('merit_item_MG.index') }}">課題</a>
                @endcan
            </div>
        </div>
    </li>

    <li class="nav-item" name="management_li">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#management" aria-expanded="true" aria-controls="management">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>網路系統管理</span>
        </a>
        <div id="management" class="collapse " aria-labelledby="headingOne" data-parent="#accordionSidebar" name="management">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('features.view')
                <a class="collapse-item" href="{{ route('features.index') }}">功能編輯</a>
                @endcan
                @can('role.view')
                <a class="collapse-item" href="{{ route('role.index') }}">角色權限</a>
                @endcan
                @can('account.view')
                <a class="collapse-item" href="{{ route('account.index') }}">帳號管理</a>
                <a class="collapse-item" href="{{ route('login_history.view') }}">登入歷史</a>
                @endcan

            </div>
        </div>
    </li>

    <li class="nav-item" name="management_li">
        <a class="nav-link" href="{{ route('index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>佛陀網路學院首頁</span>
        </a>
    </li>
</ul>
