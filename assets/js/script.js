var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;
var timer;

$(document).click(function (click) {
  var target = $(click.target);
  if (!target.hasClass("item") && !target.hasClass("optionsButton")) {
    hideOptionsMenu();
  }
});
$(window).scroll(function () {
  hideOptionsMenu();
});

$(document).on("change", "select.playlist", function () {
  var select = $(this);
  var playlistId = select.val();
  var songId = select.prev(".songId").val();
  $.post("includes/handlers/ajax/addToPlaylist.php", {
    playlistId: playlistId,
    songId: songId,
  }).done(function (error) {
    if (error != "") {
      alert(error);
      return;
    }
    hideOptionsMenu();
    select.val("");
  });
});

function updateEmail(emailClass) {
  var emailValue = $("." + emailClass).val();

  $.post("includes/handlers/ajax/updateEmail.php", {
    email: emailValue,
    username: userLoggedIn,
  }).done(function (response) {
    $("." + emailClass)
      .nextAll(".message")
      .text(response);
  });
}

function updatePassword(
  oldPasswordClass,
  newPasswordClass1,
  newPasswordClass2
) {
  var oldPassword = $("." + oldPasswordClass).val();
  var newPassword1 = $("." + newPasswordClass1).val();
  var newPassword2 = $("." + newPasswordClass2).val();

  $.post("includes/handlers/ajax/updatePassword.php", {
    oldPassword: oldPassword,
    newPassword1: newPassword1,
    newPassword2: newPassword2,
    username: userLoggedIn,
  }).done(function (response) {
    $("." + oldPasswordClass)
      .nextAll(".message")
      .text(response);
  });
}

function logout() {
  $.post("includes/handlers/ajax/logout.php", function () {
    location.reload();
  });
}

function openPage(url) {
  if (timer != null) {
    clearTimeout(timer);
  }

  if (url.indexOf("?") == -1) {
    url = url + "?";
  }

  var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
  console.log(encodedUrl);
  $("#mainContent").load(encodedUrl);
  $("body").scrollTop(0);
  history.pushState(null, null, url);
}

function removeFromPlaylist(button, playlistId) {
  var songId = $(button).prevAll(".songId").val();
  $.post("includes/handlers/ajax/removeFromPlayList.php", {
    playlistId: playlistId,
    songId: songId,
  }).done(function (error) {
    if (error != "") {
      alert(error);
      return;
    }
    // fait qlq chose lorsque AJAX retourne
    openPage("playlist.php?id=" + playlistId);
  });
}

function createPlayList() {
  var popup = prompt("Merci d'indiquer le nom de votre liste de lecture");
  if (popup != null) {
    $.post("includes/handlers/ajax/createPlayList.php", {
      name: popup,
      username: userLoggedIn,
    }).done(function (error) {
      if (error != "") {
        alert(error);
        return;
      }
      // fait qlq chose lorsque AJAX retourne
      openPage("yourMusic.php");
    });
  }
}

function deletePlayList(playlistId) {
  var prompt = confirm(
    "Vous étes sur de bien vouloir supprimer cette liste de lecture?"
  );
  if (prompt == true) {
    $.post("includes/handlers/ajax/deletePlayList.php", {
      playlistId: playlistId,
    }).done(function (error) {
      if (error != "") {
        alert(error);
        return;
      }
      // fait qlq chose lorsque AJAX retourne
      openPage("yourMusic.php");
    });
  }
}

function hideOptionsMenu() {
  var menu = $(".optionsMenu");
  if (menu.css("display") != "none") {
    menu.css("display", "none");
  }
}

function showOptionsMenu(button) {
  var songId = $(button).prevAll(".songId").val();
  var menu = $(".optionsMenu");
  var menuWidth = menu.width();
  menu.find(".songId").val(songId);
  var scrollTop = $(window).scrollTop(); //Distance en entre l'entete du document et le scrom
  var elementOffset = $(button).offset().top; // Distance du boutton par rapport au top de document
  var top = elementOffset - scrollTop;
  var left = $(button).position().left;
  menu.css({
    top: top + "px",
    left: left - menuWidth + "px",
    display: "inline",
  });
}

function formatTime(seconds) {
  var time = Math.round(seconds);
  var minutes = Math.floor(time / 60); //Rounds down
  var seconds = time - minutes * 60;

  var extraZero = seconds < 10 ? "0" : "";

  return minutes + ":" + extraZero + seconds;
}

function updateTimeProgressBar(audio) {
  $(".progressTime.current").text(formatTime(audio.currentTime));
  $(".progressTime.remaining").text(
    formatTime(audio.duration - audio.currentTime)
  );

  var progress = (audio.currentTime / audio.duration) * 100;
  $(".playbackBar .progress").css("width", progress + "%");
}

function updateVolumeProgressBar(audio) {
  var volume = audio.volume * 100;
  $(".volumeBar .progress").css("width", volume + "%");
}
function playFirstSong() {
  setTrack(tempPlaylist[0], tempPlaylist, true);
}

function Audio() {
  this.currentlyPlaying;
  this.audio = document.createElement("audio");

  this.audio.addEventListener("ended", function () {
    nextSong();
  });

  this.audio.addEventListener("canplay", function () {
    //'this' refers to the object that the event was called on
    var duration = formatTime(this.duration);
    $(".progressTime.remaining").text(duration);
  });

  this.audio.addEventListener("timeupdate", function () {
    if (this.duration) {
      updateTimeProgressBar(this);
    }
  });

  this.audio.addEventListener("volumechange", function () {
    updateVolumeProgressBar(this);
  });

  this.setTrack = function (track) {
    this.currentlyPlaying = track;
    this.audio.src = track.path;
  };

  this.play = function () {
    this.audio.play();
  };

  this.pause = function () {
    this.audio.pause();
  };

  this.setTime = function (seconds) {
    this.audio.currentTime = seconds;
  };
}
