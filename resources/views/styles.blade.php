<link rel ='stylesheet' href ='{{asset('semantic/semantic.min.css')}}'>
<style>
  sup{
    color:red;
  }

@font-face{
  font-family:Roboto;
  src:url({{asset('fonts/Roboto-Regular.ttf')}});
}
body{
  background-image:url('{{asset('img/bg.png')}}');background-size:cover;background-attachment:fixed;
}
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  font-family:Roboto;
}
::-moz-placeholder { /* Firefox 19+ */
 font-family:Roboto;
}
:-ms-input-placeholder { /* IE 10+ */
 font-family:Roboto;
}
:-moz-placeholder { /* Firefox 18- */
 font-family:Roboto;
}
*{
  font-family:Roboto;
}
.ui.button{
  font-family:Roboto;
}
@font-face{
  font-family:Allura;
  src:url({{asset('fonts/Allura-Regular.ttf')}});
}
@font-face{
  font-family:Niconne;
  src:url({{asset('fonts/Niconne-Regular.ttf')}});
}
</style>