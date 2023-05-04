@extends('admin.adminMaster')
@section('content')

<body class="hold-transition sidebar-mini dark-mode">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Contact Admin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Contact Admin</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline direct-chat direct-chat-primary">
                                <div class="card-header">
                                    <!-- <h3 class="card-title">Direct Chat</h3> -->

                                    <!-- <div class="card-tools">
                                        <span title="3 New Messages" class="badge bg-primary">3</span>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" title="Contacts"
                                            data-widget="chat-pane-toggle">
                                            <i class="fas fa-comments"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div> -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- Conversations are loaded here -->
                                    <div style="height: 400px;" class="direct-chat-messages">
                                        <!-- Message. Default to the left -->
                                        @foreach($messages as $key=>$message)
                                        @if(Auth::User()->id == $message->recieverid)
                                        <div class="row">
                                            <div class="direct-chat-msg col-6">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-left">{{$message['SenderInfo']['name']}} {{$message['SenderInfo']['lname']}}</span>
                                                    <span class="text-sm text-muted direct-chat-timestamp float-right">{{$message->created_at}}</span>
                                                </div>
                                                <!-- /.direct-chat-infos -->
                                                <img class="direct-chat-img" src="{{(!empty($message['SenderInfo']['profile_photo_path']))? url('uploads/userImages/'.$message['SenderInfo']['profile_photo_path']): url('uploads/userImages/maleDefault.png')}}"
                                                    alt="user Img">
                                                <!-- /.direct-chat-img -->
                                                <div class="direct-chat-text">
                                                    {!! nl2br($message->message)!!}
                                                </div>
                                                <!-- /.direct-chat-text -->
                                            </div>
                                        </div>
                                        @elseif(Auth::User()->id == $message->senderid)
                                        <!-- /.direct-chat-msg -->
                                        <div class="row">
                                            <div class="col-6"></div>
                                            <div class="direct-chat-msg right col-6">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-right">{{$message['SenderInfo']['name']}} {{$message['SenderInfo']['lname']}}</span>
                                                    <span class="text-sm text-muted direct-chat-timestamp float-left">{{$message->created_at}}</span>
                                                </div>
                                                <!-- /.direct-chat-infos -->
                                                <img class="direct-chat-img" src="{{(!empty($message['SenderInfo']['profile_photo_path']))? url('uploads/userImages/'.$message['SenderInfo']['profile_photo_path']): url('uploads/userImages/maleDefault.png')}}"
                                                    alt="user Img">
                                                <!-- /.direct-chat-img -->
                                                <div class="direct-chat-text">
                                                    {!! nl2br($message->message)!!}
                                                </div>
                                                <!-- /.direct-chat-text -->
                                            </div>
                                        </div>
                                        @else
                                        There is some error please check here
                                        @endif
                                        @endforeach
                                        <!-- Message to the right -->

                                        <!-- /.direct-chat-msg -->
                                    </div>
                                    <!--/.direct-chat-messages-->

                                    <!-- Contacts are loaded here -->
                                    <div class="direct-chat-contacts">
                                        <ul class="contacts-list">
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="../dist/img/user1-128x128.jpg"
                                                        alt="User Avatar">

                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            Count Dracula
                                                            <small
                                                                class="contacts-list-date float-right">2/28/2015</small>
                                                        </span>
                                                        <span class="contacts-list-msg">How have you been? I
                                                            was...</span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                        </ul>
                                        <!-- /.contatcts-list -->
                                    </div>
                                    <!-- /.direct-chat-pane -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <form action="{{route('contact.contactadmin.send')}}" method="get">
                                        <div class="input-group">
                                            <textarea rows="2" name="message" placeholder="Type Your Message ..."
                                                class="form-control"></textarea>
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                            <!--/.direct-chat -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
</body>
@endsection
