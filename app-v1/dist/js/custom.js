/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

// Show Activate User Confirmation Modal
$(document).ready(function () {
  $(".activate_user").click(function (e) {
    e.preventDefault();
    var userID = $(this).attr("user-id");
    var parent = $(this).parent("td").parent("tr");
    bootbox.dialog({
      message:
        "Are you sure you want to activate this user (" +
        "<strong>" +
        $(this).attr("user-name") +
        "</strong>" +
        ")? <br><strong>Note:</strong> The user will be able to login and access the application.",
      title: "<i class='ion-power'></i> Confirm Activation Action!",
      buttons: {
        danger: {
          label: "No",
          className: "btn-danger",
          callback: function () {
            $(".bootbox").modal("hide");
          },
        },
        success: {
          label: "Activate!",
          className: "btn-success",
          callback: function () {
            $.ajax({
              type: "POST",
              url: "activate-user.php",
              data: "userID=" + userID,
            })
              .done(function (response) {
                setTimeout(function () {
                  swal
                    .fire({
                      title: "Success!",
                      text: response,
                      icon: "success",
                      allowOutsideClick: false,
                      allowEscapeKey: false,
                      scrollbarPadding: false,
                      confirmButtonText: "OK",
                    })
                    .then(function (result) {
                      if (result.value) {
                        window.location = "./manage-users";
                      }
                    });
                }, 1000);

                // bootbox.alert(response);
                parent.slideDown("slow");
              })
              .fail(function () {
                bootbox.alert("Error....");
              });
          },
        },
      },
    });
  });
});

// Show De-Activate User Confirmation Modal
$(document).ready(function () {
  $(".deactivate_user").click(function (e) {
    e.preventDefault();
    var userID = $(this).attr("user-id");
    var parent = $(this).parent("td").parent("tr");
    bootbox.dialog({
      message:
        "Are you sure you want to de-activate this user (" +
        "<strong>" +
        $(this).attr("user-name") +
        "</strong>" +
        ")? <br><strong>Note:</strong> The user will not be able to login and cannot access the application.",
      title: "<i class='ion-power'></i> Confirm De-Activation Action!",
      buttons: {
        warning: {
          label: "No",
          className: "btn-warning",
          callback: function () {
            $(".bootbox").modal("hide");
          },
        },
        danger: {
          label: "De-Activate!",
          className: "btn-danger",
          callback: function () {
            $.ajax({
              type: "POST",
              url: "deactivate-user.php",
              data: "userID=" + userID,
            })
              .done(function (response) {
                setTimeout(function () {
                  swal
                    .fire({
                      title: "Success!",
                      text: response,
                      icon: "success",
                      allowOutsideClick: false,
                      allowEscapeKey: false,
                      scrollbarPadding: false,
                      confirmButtonText: "OK",
                    })
                    .then(function (result) {
                      if (result.value) {
                        window.location = "./manage-users";
                      }
                    });
                }, 1000);

                // bootbox.alert(response);
                parent.slideDown("slow");
              })
              .fail(function () {
                bootbox.alert("Error....");
              });
          },
        },
      },
    });
  });
});
