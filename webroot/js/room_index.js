$(document).ready(function() {
    // Scroll screen to bottom
    scrollScreenBottom();
    $('#message').focus();

    // Reload message after 500 miliseconds
    autLoadNewMessages(500);
    // Bind submit message action
    $('#frmPost').submit(function() {
        var mess = jQuery.trim($('#message').val());
        var room_id = jQuery.trim($('#room_id').val());
        if (mess.length > 0) {
            postMessage(mess, room_id);
        }
        return false;
    });

});

function scrollScreenBottom() {
    $('#screen').scrollTop($('#screen')[0].scrollHeight);
}

function lockPosting(opt) {
    if (opt === true) {
        $('#frmPost input').prop('disabled', true);
        $('#frmPost button').prop('disabled', true);
    } else {
        $('#frmPost input').prop('disabled', false);
        $('#frmPost button').prop('disabled', false);
    }
}

function postMessage(mess, room_id) {
    var data = 'message=' + mess + '&room_id=' + room_id;
    $.ajax({
        url: Const.SITE_URL + 'message/insert',
        type: "POST",
        data: data,
        dataType: 'json',
        beforeSend: function() {
            lockPosting(true);
        },
        success: function(data) {
            lockPosting(false);
            if (data.status === 'success') {
                $('#frmPost input').val('');
                getMessage();
            } else {
                alert(data.error);
            }
        },
        error: function(xhr, status, error) {
            lockPosting(false);
            alert(error);
        }
    });
}

function autLoadNewMessages(time) {
    setInterval(function() {
        getMessage();
    }, time);
}

function getMessage() {
    var data = 'room_id=' + $('#room_id').val() + '&idafter='+$('#idafter').val() + '&last_update='+$('#last_update').val();
    $.ajax({
        url: Const.SITE_URL + 'message/getMessage',
        data: data,
        type: "POST",
        dataType: 'json',
        beforeSend: function() {
        },
        success: function(response) {
            if (response.status === 'success') {
                if (response.data.new_message_count > 0) {
                    $('#screen').append(response.data.message_list);
                    $('#idafter').val(response.data.idafter);
                    scrollScreenBottom();
                }
                $('#last_update').val(response.data.last_update);
                var update = response.data.update_list;
                for (var i = 0; i < update.length; i++) {
                    var post = update[i].Message;
                    var element = $('.post[data-id=' + post.message_id + ']');
                    if (element.length > 0) {
                        if (post.flag == 2) {
                            element.find('p.message').text('Messsage has been deleted by user!').addClass('deleted');
                            ;
                            element.find('p.meta .time').text('Deleted at: ' + post.update_time_formated);
                            var mod_ele = element.find('p.meta .mod_action');
                            if (mod_ele.length > 0)
                                mod_ele.remove();
                        } else if (post.flag == 1) {
                            element.find('p.message').text(post.message);
                            element.find('p.meta .time').text('Edited at: ' + post.update_time_formated);
                        }
                    }
                }
            } else {
                alert(data.error);
            }
        },
        error: function(xhr, status, error) {
            alert(error);
        }
    });
}

function delete_message(message_id) {
    var data = 'message_id=' + message_id;
    $.ajax({
        url: Const.SITE_URL + 'message/delete',
        type: "POST",
        data: data,
        dataType: 'json',
        beforeSend: function() {
        },
        success: function(response) {
            if (response.status === 'success') {
                getMessage();
            } else {
                alert(data.error);
            }
        },
        error: function(xhr, status, error) {
            alert(error);
        }
    });
}

function show_edit_popup(message_id) {
    var element = $('.post[data-id=' + message_id + ']');
    var message = element.find('p.message').text();
    var html = '<div id="frmEditMessageWraper"><from id="frmEditMessage" onsubmit="return false;">\n\
    <div><textarea id="new_message">' + message + '</textarea></div>\n\
    <div><button type="button" onclick="save(\'' + message_id + '\');">Save</button>\n\
    <button type="button" onclick="$.fancybox.close();">Cancel</button>\n\
    </div></form></div>';
    $.fancybox({
        content: html
    });
}

function save(message_id) {
    var new_message = jQuery.trim($('#new_message').val());
    if (new_message.length == 0) {
        alert('Message cannot be blank, if you want to remove this message, you can delete it.');
        return false;
    }
    return edit_message(message_id, new_message);
}

function edit_message(message_id, new_message) {
    var data = 'message_id=' + message_id + '&message=' + new_message;
    $.ajax({
        url: Const.SITE_URL + 'message/edit',
        type: "POST",
        data: data,
        dataType: 'json',
        beforeSend: function() {
        },
        success: function(response) {
            if (response.status === 'success') {
                $.fancybox.close();
                getMessage();
            } else {
                alert(data.error);
            }
        },
        error: function(xhr, status, error) {
            alert(error);
        }
    });
}