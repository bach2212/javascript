/**
 * Write a simple function which makes an ajax call to a php script.
 *
 * The url is the path to the php script.
 * The request should be a GET request.
 *
 * The 1. request should send a GET request to get an email "user1@test.de".
 * The 2. request should send a GET request to get an email "user2@test.de".
 *
 * Use jQuery.
 * DRY
 */

function Task01() {

  function request(email) {

    //########################################
    /** TODO */
    $.ajax({
      url: "http://localhost:63342/BewerberTest_FrontEnd/Task01/index.html?_ijt=8u0d7s5o0g5doo7172du751tc1",
      data: {action:"getUser"},
      type: "GET",
      success: function (data) {
        alert(data);
      }
    });

    //########################################
  }
  $('#firstBtn').click(() => {
    request("user1@test.de");
  });

  $('#secondBtn').click(() => {
    request("user2@test.de");
  });
}

Task01();
