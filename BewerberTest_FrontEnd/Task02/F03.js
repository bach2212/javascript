/**
 * 1. Why will the API in https://example.com will never receive the data?
 * 2. What do you have to change to send the data this way?
 */

function calltest() {
  $.ajax({
    type: 'GET',
    url: 'https://example.com/login',
    data: {
      "email":"test@mail.de",
      "password":"passwort1"
    },
    success: function(res) {
      console.log(res)
    }
  })
}
