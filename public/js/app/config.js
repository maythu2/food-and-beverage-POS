var Config = function(){
   init = function(){
       check_login();        
       // $('#txtpassword').keypress(function(e) {
       //       if(e.which == 13) {
       //           controls.frmLogin.submit();
       //       }
       // });
       
   },
   check_login = function(){

       // ajax call to jwt auth

       //return true or false
   }

   return{
       init : init,
       apiurl : 'api/',
       siteurl : 'http://127.0.0.1:8000/'
   }

}();

$(document).ready(function(){
   Config.init();
});