$(document).ready(function() {
    $(".HelpMd .Faq__q > span").click(function(e) {
		$(".Faq__qa").removeClass("Faq__qa_active");
		$(this).closest(".Faq__qa").addClass("Faq__qa_active");
	});
    $(".modal-window#register [type=submit]").click(function(e) {
        e.preventDefault();
        $(".modal-window#register span.error-text").text("");
        var _token = $(".modal-window#register input[name='_token']").val();
        var username = $(".modal-window#register input[name='username']").val();
        var email = $(".modal-window#register input[name='email']").val();
        var password = $(".modal-window#register input[name='password']").val();
        var password_confirmation = $(
            ".modal-window#register input[name='password_confirmation']"
        ).val();

        $.ajax({
            url: "/register",
            type: "post",
            dataType: "JSON",
            data: {
                csrf_token: $('meta[name="csrf-token"]').attr("content"),
                _token: _token,
                username: username,
                email: email,
                password: password,
                password_confirmation: password_confirmation
            },
            success: function(data) {
                if (!!data.redirectTo) location.href = data.redirectTo;
                else
                    $.each(data, function(key, value) {
                        var spantext = "";
                        if (Array.isArray(value))
                            $.each(value, function(k, v) {
                                spantext += v + " ";
                            });
                        else spantext = value;
                        $(
                            ".modal-window#register .error-text#error-" + key
                        ).text(spantext);
                    });
            },
            error: function(data) {
                if(!!data.responseJSON.errors)
                    $.each(data.responseJSON.errors, function(key, value) {
                        var spantext = "";
                        if (Array.isArray(value))
                            $.each(value, function(k, v) {
                                spantext += v + " ";
                            });
                        else spantext = value;
                        console.log(spantext);
                        $(".modal-window#register .error-text#error-" + key).text(
                            spantext
                        );
                    });
            }
        });
    });

    $(".modal-window#login [type=submit]").click(function(e) {
        e.preventDefault();

        $(".modal-window#login span.error-text").text("");

        var _token = $(".modal-window#login input[name='_token']").val();
        var username = $(".modal-window#login input[name='username']").val();
        var password = $(".modal-window#login input[name='password']").val();

        $.ajax({
            url: "/login",
            type: "post",
            dataType: "JSON",
            data: {
                csrf_token: $('meta[name="csrf-token"]').attr("content"),
                _token: _token,
                username: username,
                password: password
            },
            success: function(data) {
                if (!!data.redirectTo) location.href = data.redirectTo;
                else
                    $.each(data, function(key, value) {
                        var spantext = "";
                        if (Array.isArray(value))
                            $.each(value, function(k, v) {
                                spantext += v + " ";
                            });
                        else spantext = value;
                        $(".modal-window#login .error-text#error-" + key).text(
                            spantext
                        );
                    });
            },
            error: function(data) {
                if(!!data.responseJSON.errors)
                    $.each(data.responseJSON.errors, function(key, value) {
                        var spantext = "";
                        if (Array.isArray(value))
                            $.each(value, function(k, v) {
                                spantext += v + " ";
                            });
                        else spantext = value;
                        console.log(spantext);
                        $(".modal-window#login .error-text#error-" + key).text(
                            spantext
                        );
                    });
            }
        });
    });
});
