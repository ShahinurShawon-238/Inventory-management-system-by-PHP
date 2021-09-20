//validation function
(function() {
    'use strict';
    window.addEventListener('load', function() {
      // Get the forms we want to add validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            alert("Please fill up the box");
          }
          
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();

//alert box function Index page
function functionConfirm(msg, myYes, myNo) {
    var confirmBox = $("#confirm");
    confirmBox.find(".message").text(msg);
    confirmBox.find(".yes,.no").unbind().click(function() {
       confirmBox.hide();
    });
    confirmBox.find(".yes").click(myYes);
    confirmBox.find(".no").click(myNo);
    confirmBox.show();
}
// combo box
// $(document).ready(function() {
//   $('.mdb-select').materialSelect();
//   });
// Enter key work
// $("#barcode").keypress(function(event) { 
//   if (event.keyCode === 13) { 
//       $("#Enter_Button").click(); 
//   } 
// }); 

// $("#Enter_Button").click(function() { 
//   alert("Button clicked"); 
// });

//Tooltip
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
