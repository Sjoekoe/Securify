<div id="header" class="header-fixed">
    <div class="container-fluid">
        <div class="navbar">
            <div class="navbar-header">
                <div class="navbar-brand">
                    @if (auth()->checkTeam())
                        <span class="text-slogan">
                            {{ auth()->account()->name() }}
                        </span>
                    @else
                        <span class="text-logo">spr</span><span class="text-slogan">flat</span>
                    @endif
                </div>
            </div>
            <nav class="top-nav" role="navigation">
                <ul class="nav navbar-nav pull-left">
                    <li id="toggle-sidebar-li">
                        <a href="#" id="toggle-sidebar"><i class="en-arrow-left2"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="full-screen"><i class="fa-fullscreen"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"><i class="ec-cog"></i><span class="notification">10</span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#"><i class="en-database"></i> Database <span class="notification">3</span></a>
                            </li>
                            <li><a href="#"><i class="st-cube"></i> Packages <span class="notification blue">17</span></a>
                            </li>
                            <li><a href="#"><i class="st-health"></i> Disconnects <span class="notification yellow">1</span></a>
                            </li>
                            <li><a href="#"><i class="im-images"></i> Images <span class="notification teal">320</span></a>
                            </li>
                            <li><a href="#"><i class="st-users"></i> Users <span class="notification orange">2k</span></a>
                            </li>
                            <li><a href="#"><i class="st-meter"></i> Traffic <span class="notification magenta">2tb</span></a>
                            </li>
                            <li><a href="#"><i class="im-coin"></i> Finances <span class="notification pink">+3k</span></a>
                            </li>
                            <li><a href="#"><i class="st-folder"></i> Directories <span class="notification green">17</span></a>
                            </li>
                            <li><a href="#"><i class="st-bag"></i> Orders <span class="notification purple">12</span></a>
                            </li>
                            <li><a href="#"><i class="ec-contract"></i> Contracts <span class="notification dark">7</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"><i class="ec-mail"></i><span class="notification">4</span></a>
                        <ul class="dropdown-menu email" role="menu">
                            <li class="mail-head">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <a href="email-inbox.html"><i class="ec-archive"></i></a>
                                    </div>
                                    <span>Inbox</span>
                                    <div class="pull-right">
                                        <a href="email-inbox.html"><i class="st-pencil"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li class="search-email">
                                <form>
                                    <input type="text" name="search" placeholder="Search for emails">
                                    <button type="submit"><i class="ec-search"></i>
                                    </button>
                                </form>
                            </li>
                            <li class="mail-list clearfix">
                                <a href="#">
                                    <img src="" class="mail-avatar pull-left" alt="avatar">
                                    <p class="name">
                                        <span class="status"><i class="en-dot"></i></span> Jason Rivera
                                        <span class="notification">2</span>
                                        <span class="time">12:30 am</span>
                                    </p>
                                    <p class="msg">
                                        I contact you regarding my account please can you set up my pass ...
                                    </p>
                                </a>
                            </li>
                            <li class="mail-list clearfix">
                                <a href="#">
                                    <img src="" class="mail-avatar pull-left" alt="avatar">
                                    <p class="name">
                                        <span class="status off"><i class="en-dot"></i></span> Steeve Mclark
                                        <span class="notification">6</span>
                                        <span class="time">10:26 am</span>
                                    </p>
                                    <p class="msg">
                                        Good job dude awesome work here, please add theese features ...
                                    </p>
                                </a>
                            </li>
                            <li class="mail-list clearfix">
                                <a href="#">
                                    <img src="" class="mail-avatar pull-left" alt="avatar">
                                    <p class="name">
                                        <span class="status off"><i class="en-dot"></i></span> Fellix Jones
                                        <span class="notification">1</span>
                                        <span class="time">7:15 am</span>
                                    </p>
                                    <p class="msg">
                                        I have some issues when try to reach my product page can you ...
                                    </p>
                                </a>
                            </li>
                            <li class="mail-list clearfix">
                                <a href="#">
                                    <img src="" class="mail-avatar pull-left" alt="avatar">
                                    <p class="name">
                                        <span class="status"><i class="en-dot"></i></span> Tina Dowsen
                                        <span class="notification">5</span>
                                        <span class="time">03:46 am</span>
                                    </p>
                                    <p class="msg">
                                        Hello Sugge, i want to apply for your referal program , please ...
                                    </p>
                                </a>
                            </li>
                            <li class="mail-more">
                                <a href="email-inbox.html">View all <i class="en-arrow-right7"></i></a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"><i class="br-alarm"></i> <span class="notification">5</span></a>
                        <ul class="dropdown-menu notification-menu right" role="menu">
                            <li class="clearfix">
                                <i class="ec-chat"></i>
                                <a href="#" class="notification-user"> Ric Jones </a>
                                <span class="notification-action"> replied to your </span>
                                <a href="#" class="notification-link"> comment</a>
                            </li>
                            <li class="clearfix">
                                <i class="st-pencil"></i>
                                <a href="#" class="notification-user"> SuggeElson </a>
                                <span class="notification-action"> just write a </span>
                                <a href="#" class="notification-link"> post</a>
                            </li>
                            <li class="clearfix">
                                <i class="ec-trashcan"></i>
                                <a href="#" class="notification-user"> SuperAdmin </a>
                                <span class="notification-action"> just remove </span>
                                <a href="#" class="notification-link"> 12 files</a>
                            </li>
                            <li class="clearfix">
                                <i class="st-paperclip"></i>
                                <a href="#" class="notification-user"> C. Wiilde </a>
                                <span class="notification-action"> attach </span>
                                <a href="#" class="notification-link"> 3 files</a>
                            </li>
                            <li class="clearfix">
                                <i class="st-support"></i>
                                <a href="#" class="notification-user"> John Simpson </a>
                                <span class="notification-action"> add support </span>
                                <a href="#" class="notification-link"> ticket</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown">
                            <img class="user-avatar" src="" alt="{{ auth()->user()->name() }}">{{ auth()->user()->name() }}</a>
                        <ul class="dropdown-menu right" role="menu">
                            <li>
                                <a href="{{ route('user.settings') }}"><i class="st-settings"></i> Settings</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"><i class="im-exit"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
