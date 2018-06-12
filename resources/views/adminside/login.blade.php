@include('../styles')
<div class="ui menu" style ='border-radius:0px'>
  <a class ='right item' href= '/'>
    <i class ='home icon'></i>Home
  </a>
</div>

<div class ='ui attached message ' style ='width:50%;margin:auto;box-shadow: 0px 0px 0px 0px'>
  <div class ='header'>Login</div>
  Enter password to continue
</div>
<div class ='ui form attached segment' style ='width:50%;margin:auto;'>
  <div class ='content'>
    <form class='ui form' method ='post'>
      @csrf
      <div class ='field'>
        <label>Password</label>
        <input name ='password' type ='password' placeholder ='Password'/>
      </div>
      <button class ='ui inverted button fluid' style ='background-color:#4200ff'>Submit</button>
    </form>
  </div>
</div>
@include('../scripts')