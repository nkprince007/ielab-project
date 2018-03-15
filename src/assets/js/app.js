/*Login or Registration Form Submit*/
$("#login_form, #registration_form").submit(function (e) {
    e.preventDefault();
    var obj = $(this), action = obj.attr('name'); /*Define variables*/
    $.ajax({
        type: "POST",
        url: e.target.action,
        data: obj.serialize() + "&Action=" + action,
        cache: false,
        success: function (data) {
            console.log(data);
            if (data.error != '') {
                $(`#alert_placeholder_${action}`).html(
                    '<div class="alert alert-danger"><span>' + data.error + '</span></div>'
                );
            } else {
                window.location.href = "/files.php";
            }
        },
        error: function (error) {
            console.error(error);
        }
    });
});
