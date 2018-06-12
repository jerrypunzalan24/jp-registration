  @include('styles')
  <body style ="background-image:url('{{asset('img/bg.jpg')}}');">
    <div class="ui menu" style ='border:radius:none'>
      <a class ='right item'>
        Login
      </a>
    </div>
    <div class ='ui container' >
      <div class ='ui card' style ='width:60%;margin:auto;border-radius:0px;opacity:0.9;overflow:hidden'>
        <div class ='content' style ='padding-top:0px'>
          <form class ='ui form' action ='create' method ='post'>
            @csrf
            <div class ='ui secondary pointing menu' >
              <p id = 'step1' class ='item active' style ='width:50%'>Step 1</p>
              <p id = 'step2' class ='item' style ='width:50%'>Step 2</p>
            </div>
            <h2 style ='margin-top:10px;margin-bottom:5px' id ='title'>Personal Information</h2>
            <p style ='margin-top:5px' id ='desc'>Enter all fields below</p>
            <div class ='ui divider'></div>
            <div id ='personal'>          
              <div class='field'>
                <label>Student Number <sup>*</sup></label>
                <input value ='' type ='number' placeholder ='Student Number' name ='studentnumber' REQUIRED>
              </div>
              <div class ='two fields'>
                <div class ='field'>
                  <label>First Name <sup>*</sup></label>
                  <input value ='' type ='text' placeholder = 'First Name' name ='firstname' REQUIRED>
                </div>
                <div class ='field'>
                  <label>Last Name <sup>*</sup></label>
                  <input value ='' type ='text' placeholder ='Last Name' name ='lastname' REQUIRED>
                </div>
              </div>
              <div class ='two fields'>
                <div class ='field'>
                  <label>Gender <sup>*</sup></label>
                  <select name ='gender' class ='ui fluid dropdown'>
                    <option value ='0'>Male</option>
                    <option value ='1'>Female</option>
                  </select>
                </div>
                <div class ='field'>
                  <label>Course <sup>*</sup></label>
                  <select name ='course' class ='ui fluid dropdown'>
                    <option value ='bsit'>BSIT</option>
                    <option value ='bscs'>BSCS</option>
                    <option value ='bsis'>BSIS</option>
                    <option value ='bsemc'>BSEMC</option>
                  </select>
                </div>
              </div>
              <div class ='field'>
                <label>Mobile Number <sup>*</sup></label>
                <input value ='' type ='number' placeholder ='Mobile Number' name ='mobilenumber' REQUIRED>
              </div>
            </div>
            <div id ='survey' style ='display:none'>
              <h4>1. What is your preferred kind of student activities</h4>
              <div class="field">
                <div class="ui radio checkbox">
                  <input type="radio" name="seminars" checked="" tabindex="0" >
                  <label>Seminars, Workshops, Academic events, etc</label>
                </div>
              </div>
              <div class="field">
                <div class="ui radio checkbox">
                  <input type="radio" name="competitions" tabindex="0" >
                  <label>Singing Competition, Editing competition, etc</label>
                </div>
              </div>
              <h4>2. What topics in ICT are you interested?</h4>
              @foreach($checkboxes as $name => $checkbox)
              <div class ='ui checkbox' style ='margin-bottom:5px'>
                <input type ='checkbox' name ='question2[{{$name}}]' tabindex ='0' >
                <label>{{$checkbox}}</label>
              </div>
              <br/>
              @endforeach
              <div class ='ui checkbox' style ='margin-bottom:5px'>
                <input id = 'others' type ='checkbox'  tabindex ='0'>
                <label>Others</label>
              </div>
              <div class ='ui field'>
                <input type ='text' disabled name ='others' style ='width:50%' value= '' placeholder = 'Please specify'>     
              </div>
            </div>
            <div id ='continue' class ='field' style ='margin-top:20px'>
              <a id ='proceed' class ='ui button fluid inverted' style ='background-color:#4200FF'>Continue</a>
            </div>
            <div id ='submit' style ='display:none;margin-top:20px' align ='center' >
              <button id ='goback' class ='ui button inverted' style ='background-color:#4200FF; width:49%'>Go back</button>
              <button onclick = "$('form').submit()" class ='ui button  inverted'  style ='background-color:#4200FF;width:49%'>Submit</button>
            </div>  
          </form>
        </div>
      </div>
    </div>
  </body>
  @include('scripts')