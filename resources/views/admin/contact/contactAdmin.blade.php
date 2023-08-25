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
                                            @if($message->message != '' || $message->attachment != '')
                                            <div class="direct-chat-msg col-6">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-left">{{$message['SenderInfo']['name']}} {{$message['SenderInfo']['lname']}}</span>
                                                    <span class="text-sm text-muted direct-chat-timestamp float-right">{{$message->created_at}}</span>
                                                </div>
                                                <!-- /.direct-chat-infos -->
                                                <img class="direct-chat-img" src="{{(!empty($message['SenderInfo']['profile_photo_path']))? url('uploads/userImages/'.$message['SenderInfo']['profile_photo_path']): url('uploads/userImages/maleDefault.png')}}"
                                                    alt="user Img">
                                                <!-- /.direct-chat-img -->
                                                @if($message->message != '')
                                                <div class="direct-chat-text">
                                                    {!! nl2br($message->message)!!}
                                                </div>
                                                @endif
                                                @if($message->attachment != '')
                                                    @foreach(explode('@@', $message->attachment) as $attachment) 
                                                    @if($attachment != '')
                                                    <div class="direct-chat-text">
                                                        <a class="mt-2" download href="{{ URL::to('/uploads/chatAttachments/'.$attachment) }}">
                                                            <i class="fa fa-file text-white"> Download file {{$loop->index}}</i>
                                                        </a>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                @endif
                                                <!-- /.direct-chat-text -->
                                            </div>
                                            @endif
                                        </div>
                                        @elseif(Auth::User()->id == $message->senderid)
                                        <!-- /.direct-chat-msg -->
                                        <div class="row">
                                            <div class="col-6"></div>
                                            @if($message->message != '' || $message->attachment != '') 
                                            <div class="direct-chat-msg right col-6">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-right">{{$message['SenderInfo']['name']}} {{$message['SenderInfo']['lname']}}</span>
                                                    <span class="text-sm text-muted direct-chat-timestamp float-left">{{$message->created_at}}</span>
                                                </div>
                                                <!-- /.direct-chat-infos -->
                                                <img class="direct-chat-img" src="{{(!empty($message['SenderInfo']['profile_photo_path']))? url('uploads/userImages/'.$message['SenderInfo']['profile_photo_path']): url('uploads/userImages/maleDefault.png')}}"
                                                    alt="user Img">
                                                <!-- /.direct-chat-img -->
                                                @if($message->message != '')
                                                <div class="direct-chat-text">
                                                    {!! nl2br($message->message)!!}
                                                </div>
                                                @endif
                                                @if($message->attachment != '')
                                                    @foreach(explode('@@', $message->attachment) as $attachment) 
                                                    @if($attachment != '')
                                                    <div class="direct-chat-text">
                                                        <a class="mt-2" download href="{{ URL::to('/uploads/chatAttachments/'.$attachment) }}">
                                                            <i class="fa fa-file text-white"> Download file {{$loop->index}}</i>
                                                        </a>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                        @else
                                        There is some error please check here
                                        @endif
                                        @endforeach
                                        <!-- Message to the right -->

                                        <!-- /.direct-chat-msg -->
                                    </div>
                                    <!--/.direct-chat-messages-->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="ml-5" id="filesList">
                                        <p id="files-names"></p>
                                    </div>     
                                    <form action="{{route('contact.contactadmin.send')}}" enctype ="multipart/form-data" method = "POST">
                                        @csrf
                                        <div class="input-group">
                                            <textarea rows="2" name="message" placeholder="Type Your Message ..."
                                                class="form-control"></textarea>
                                            <input type="file" multiple name="attachment[]" id="attachment" style="display:none;">
                                            <span class="input-group-append">
                                                <a href="#" class="btn btn-white" onclick="thisFileUpload();"><i class="fa-lg fa fa-paperclip"></i></a>
                                            </span>
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
<script>
    function thisFileUpload() {
        document.getElementById("attachment").click();
    };
</script>
<script> 
    const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file
  
    $("#attachment").on('change', function(e){
        for(var i = 0; i < this.files.length; i++){
            let fileBloc = $('<span/>', {class: 'file-block', style:"width:100%; display: inline-block;"}),
                fileName = $('<span/>', {class: 'name', text: this.files.item(i).name});
            fileBloc.append('<span class="mt-1 file-delete"><i class = "badge badge-danger"><span class="fa fa-times"></span></i></span>')
                .append(fileName);
            $("#filesList > #files-names").append(fileBloc);
        };
        // Ajout des fichiers dans l'objet DataTransfer
        for (let file of this.files) {
            dt.items.add(file);
        }
        // Mise à jour des fichiers de l'input file après ajout
        this.files = dt.files;
  
        // EventListener pour le bouton de suppression créé
        $('span.file-delete').click(function(){
            let name = $(this).next('span.name').text();
            // Supprimer l'affichage du nom de fichier
            $(this).parent().remove();
            for(let i = 0; i < dt.items.length; i++){
                // Correspondance du fichier et du nom
                if(name === dt.items[i].getAsFile().name){
                    // Suppression du fichier dans l'objet DataTransfer
                    dt.items.remove(i);
                    continue;
                }
            }
            // Mise à jour des fichiers de l'input file après suppression
            document.getElementById('attachment').files = dt.files;
        });
    });
</script>
@endsection
