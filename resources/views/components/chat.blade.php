<style>
    .chat-text {
        padding: 5px;
        border-width: 1px;
        border-style: solid;
        border-radius: 3px;
    }
    .chat-success {
        border-color: #4b815a;
    }
    .chat-info {
        border-color: #317395;
    }
</style>
<div id="chat-box" style="overflow-y: scroll; overflow-x: hidden; height: 500px; margin: 15px; border: #cccccc solid 1px; border-radius: 5px;">
    <ul id="messages" style="list-style: none;"></ul>
</div>
<div class="row" style="margin-bottom: 10px;">
    <div class="col-lg-12">
        <div class="col-xs-8">
            <input type="text" class="form-control" name="message-text" id="message-text" />
        </div>
        <div class="col-xs-4">
            <button type="button" onclick="sendMessage()" class="btn btn-circle btn-primary"><i class="fa fa-fw fa-arrow-left" style="font-size: 16px;"></i></button>
        </div>
    </div>
</div>
<script>
    var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function(e) {
        // console.log("Connection established!");
        // fading alert "someone joined"
    };

    conn.onmessage = function(e) {
        let receive = JSON.parse(e.data);
        console.log(e.data);
        let user = receive.name;
        let newChild = '' +
            '<li style="padding: 10px;">' +
                '<div class="row">' +
                    '<div class="col-sm-2"><b>'+user+'</b></div>' +
                    '<div class="col-sm-10"><span class="text-success bg-success chat-text chat-success">'+receive.msg+'</span></div>' +
                '</div>' +
            '</li>';
        $("#messages").append(newChild);
        scrollToBottom();
    };

    let input = document.getElementById("message-text");
    input.addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            sendMessage();
        }
    });

    function sendMessage() {
        let message = $("#message-text");
        if (message.val().length > 0) {
            conn.send(message.val());
            let user = "{{auth()->user()->name}}";
            let newChild = '' +
                '<li style="padding: 10px;">' +
                '<div class="row">' +
                '<div class="col-sm-2"><b>' + user + '</b></div>' +
                '<div class="col-sm-10"><span class="text-info bg-info chat-text chat-info">' + message.val() + '</span></div>' +
                '</div>' +
                '</li>';
            $("#messages").append(newChild);
            message.val("").focus();
            scrollToBottom();
        }
    }

    function scrollToBottom() {
        var chatBox = document.getElementById("chat-box");
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>
