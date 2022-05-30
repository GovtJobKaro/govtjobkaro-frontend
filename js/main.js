//signIn signOut api call
function logout() {
  $.ajax({
    type: "POST",
    url: "php/logout.php",
    dataType: "json",
    data: {
      type: "logout",
    },
    success: function (obj) {
      if (obj.status == "success") {
        function delete_cookie(name) {
          document.cookie =
            name +
            "=; Domain=govtjobkaro.com; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
        }
        delete_cookie("token");
        $(".logbtn").html("Login to view courses");
        $(".logbtn").attr("onclick", 'window.location="login-register"');
        window.location = "course-logout";
        // location.reload();
      } else {
        alert("try again");
      }
    },
  });
}

// animation mobile
// $(window).scroll(function () {
//   var sticky = $(".header-mobile"),
//     scroll = $(window).scrollTop();

//   if (scroll >= 100) {
//     sticky.addClass("fixed shadow");
//   } else {
//     sticky.removeClass("fixed shadow");
//   }
// });

//fixed button functionality start
// $(document).scroll(function () {
//   var y = $(this).scrollTop();
//   // console.log(y);
//   // NOTE : 6950 is the windows window.pageYOffset size we change change it according to our need
//   if (y > 6970) {
//     $(".fixed-bottom").css("display", "none");
//   } else {
//     $(".fixed-bottom").css("display", "block");
//   }
// });

$(window).scroll(function () {
  if ($(window).scrollTop() + $(window).height() > $(document).height() - 350) {
    // $(".fixed-bottom").css("display", "none");

    $(".fixed-bottom").fadeOut(300);
  } else {
    $(".fixed-bottom").fadeIn(300);
    // $(".fixed-bottom").css("display", "block");
  }
});
//fixed button functionality end

// mobile-logo
$(".mobile-logo").on("click", () => {
  window.location.href = "/";
});

// loader
function loader() {
  $(".loader-container").addClass("d-none");
}

// onpage-loader
function onpage() {
  $(".onpage-loader").addClass("d-none");
}

// accept cookies setting
const body = document.querySelector("body");
const cookies_btn = document.querySelector(".cookies-btn");
const cookies_container = document.querySelector(".cookies-container");

// disable cookies popup
let check_url = window.location.pathname;
var check_keyword = check_url.split("/");
let check_path = check_keyword[check_keyword.length - 1];
let path_name =
  check_path == "login-register" ||
  check_path == "checkout" ||
  check_path == "notification-page-newuser" ||
  check_path == "notification-page-userexists" ||
  check_path == "partner-login" ||
  check_path == "partner-success" ||
  check_path == "reg-success" ||
  check_path == "404" ||
  check_path == "terms-and-conditions" ||
  check_path == "single-course-page";

if (!path_name) {
  // remove popup
  cookies_btn.addEventListener("click", () => {
    setTimeout(() => {
      $(`.popup_home${popup}`).fadeIn();
    }, 2000);
    body.style.overflowY = "auto";
    cookies_container.classList.remove("cookies-container-show");

    const days = 365;
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    var expires = "; domain=govtjobkaro.com; expires=" + date.toUTCString();

    document.cookie = "cookies_status=accepted;path=/" + expires;
  });

  // read cookies
  const accepted = document.cookie.includes("accepted");

  // add popup
  if (!accepted && navigator.cookieEnabled) {
    body.style.overflowY = "hidden";
    cookies_container.classList.add("cookies-container-show");
  }

  if (!navigator.cookieEnabled) {
    alert('Please "Allow all cookies" in you browser setting.');
  }
}

// Firebase Notifications
function turnOnNotifications() {
  var firebaseConfig = {
    // apiKey: "AIzaSyAJPwJKgoBfCbFn86wrf8Ru2hVXALWMgBE",
    // authDomain: "govtjobkaro-fa2c5.firebaseapp.com",
    // projectId: "govtjobkaro-fa2c5",
    // storageBucket: "govtjobkaro-fa2c5.appspot.com",
    // messagingSenderId: "769620190740",
    // appId: "1:769620190740:web:39d050f58b3f3e0d7e6901",
    // measurementId: "G-SG5JCVGVNS",
    apiKey: "AIzaSyAbYt8HS06GL0PWa3ofs0FbqdhsXzP6aBQ",
    authDomain: "govtjobkaro.firebaseapp.com",
    projectId: "govtjobkaro",
    storageBucket: "govtjobkaro.appspot.com",
    messagingSenderId: "731723132211",
    appId: "1:731723132211:web:fda46f3d0560a87254a246",
    measurementId: "G-X6SEM785DR",
  };

  firebase.initializeApp(firebaseConfig);
  const messaging = firebase.messaging();

  messaging
    .requestPermission()
    .then(function () {
      console.log("Notification Permission");
      return messaging.getToken();
    })
    .then(function (token) {
      console.log("Token: " + token);
      $.ajax({
        type: "POST",
        url: "php/notifications.php",
        dataType: "json",
        async: true,
        data: {
          notifications: token,
        },
        success: function (result) {
          if (result.status == "success") {
            // $('#notiOn').html('Notifications: ON');
            // $('#notiOnMob').html('Notifications: ON');
            // $("#removeClickToTurnOnMob").css('visibility', 'hidden');
            // $("#removeClickToTurnOn").css('visibility', 'hidden');
          } else if (result.status == "failure") {
            alert("Please try again");
          }
        },
        error: function (error) {
          alert("There was an unexpected error");
        },
      });
    })

    .catch(function (reason) {
      console.log(reason);
    });

  messaging.onMessage(function (payload) {
    console.log(payload);
    const notificationOption = {
      body: payload.notification.body,
      icon: payload.notification.icon,
    };
    if (Notification.permission === "granted") {
      var notification = new Notification(
        payload.notification.title,
        notificationOption
      );
      notification.onclick = function (ev) {
        ev.preventDefault();
        window.open(payload.notification.click_action, "_blank");
        notification.close();
      };
    }
  });
  messaging.onTokenRefresh(function () {
    messaging
      .getToken()
      .then(function (newtoken) {
        console.log("New Token: " + newtoken);
        $.ajax({
          type: "POST",
          url: "php/notifications.php",
          dataType: "json",
          async: true,
          data: {
            notifications: newtoken,
          },
          success: function (result) {
            if (result.status == "success") {
              // $('#notiOn').html('Notifications: ON');
              // $('#notiOnMob').html('Notifications: ON');
              // $("#removeClickToTurnOnMob").css('visibility', 'hidden');
              // $("#removeClickToTurnOn").css('visibility', 'hidden');
            } else if (result.status == "failure") {
              alert("Please try again");
            }
          },
          error: function (error) {
            alert("There was an unexpected error");
          },
        });
      })
      .catch(function (reason) {
        console.log(reason);
      });
  });
}
