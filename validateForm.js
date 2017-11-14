function validateForm(){
  var pwd1 = document.forms['register']['pwd'].value;
  var pwd2 = document.forms['register']['pwd2'].value;

  if(pwd1 == pwd2){
    document.forms['register']['submit'].disabled = false;

    document.getElementById('errpwd').innerHTML = "";

  }else{
    document.forms['register']['submit'].disabled = true;

    document.getElementById('errpwd').innerHTML = "Las contraseñas no coinciden";
document
  }

}
