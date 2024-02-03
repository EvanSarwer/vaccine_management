  <!-- ======= Header ======= -->



  @php

    $user_id = Auth::user()->id;
    $userData = App\Models\User::find($user_id);

    $unseen_messages = App\Models\Notification::where('user_id',$user_id)->where('type','message')->where('status','unseen')->latest()->get();
    $unseen_messages_count = 0;
    if(count($unseen_messages) > 0){
        foreach($unseen_messages as $mm){
            $mm->deliver_time = Carbon\Carbon::parse($mm->created_at)->diffForHumans();
            // if($mm->message != null){
            //     $mm->message = json_decode($mm->message);
            // }
        }
        $unseen_messages_count = $unseen_messages->count();
    }

  @endphp



  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ $userData->role == 'admin' ? route('admin.index') : ($userData->role == 'center' ? route('center.index') : route('user.index'))}}" class="logo d-flex align-items-center">
        {{-- <img src="{{ asset('admin_assets/assets/img/logo.png') }}" alt=""> --}}
        <span class="d-none d-lg-block">Vaccine Management</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    {{-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div> --}}
    <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
        <!-- End Search Icon-->

        

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">{{ ($unseen_messages_count > 0) ? $unseen_messages_count : ''}}</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
                You have {{ ($unseen_messages_count > 0) ? $unseen_messages_count : 'no' }} new messages
              <a href="{{ route('message.seen') }}"><span class="badge rounded-pill bg-primary p-2 ms-2">Clear all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            @if(count($unseen_messages) > 0)
                @foreach($unseen_messages as $key => $message)
                <li class="message-item">
                    <a href="">
                    <img src="admin_assets/assets/img/messages-1.jpg" alt="" class="rounded-circle">
                    <div>
                        <h4>{{ $message->email ?? 'Email not available' }}</h4>
                        <h6 class="h6 text-muted"><small>{{ $message->Phone ?? 'Phone not available' }}</small></h6>
                        <p>{{ Illuminate\Support\Str::limit($message->message, 50, '...') }}</p>
                        <p>{{ $message->deliver_time }}</p>
                    </div>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                @endforeach

            @else
              <li class="message-item">
                <a href="">
                  <div>
                    <h4>No new message</h4>
                  </div>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
            @endif


            <li class="dropdown-footer">
              @if($userData->role == 'admin')
                <a href="{{ route('admin.message.list') }}">Show all messages</a>
              @elseif ($userData->role == 'center')
              <a href="{{ route('center.message.list') }}">Show all messages</a>
              @else
                <a href="{{ route('user.message.list') }}">Show all messages</a>
              @endif
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ (!empty($userData->photo)) ? url('page_assets/img/'.$userData->photo) : url('upload/No_Image_Available.jpg') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{$userData->username}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{$userData->username}}</h6>
              <span>{{ $userData->role == 'admin' ? "Admin Profile" : ($userData->role == 'center' ? "Center Profile" : "User Profile")}}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ $userData->role == 'admin' ? route('admin.profileInfo') : ($userData->role == 'center' ? route('center.profileInfo') : route('user.profileInfo'))}}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ $userData->role == 'admin' ? route('admin.change.password') : ($userData->role == 'center' ? route('center.change.password') : route('user.change.password'))}}">
                <i class="bi bi-gear"></i>
                <span>Change Password</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

         

            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                this.closest('form').submit();">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </a>
              </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->