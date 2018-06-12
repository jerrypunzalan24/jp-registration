@include('../styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="ui menu" style ='border-radius:0px'>
  <a class ='right item' href= 'admin/logout'>
    <i class ='home icon'></i>Logout
  </a>
</div>
<div class ='ui tiny modal' style ="width:30%" id ='delete'>
  <div class ='header'>Delete</div>
  <div class ='content'>
    <form method ='post' action ='admin/delete' class ='ui form'>
      @csrf
      <input type ='hidden' name ='id' value =''/>
      <p style ='text-align:center;font-size:1.15em'>Are you sure that you want to permanently delete this member?</p>
    </div>
    <div class ='actions'>
      <div class= 'ui blue button' onclick ="$(this).closest('#delete').modal('hide')">
        No
      </div>
      <button class ='ui red button'>
        Yes
      </button>
    </form>
  </div>
</div>
<div class="ui tiny modal" id ='edit'>
  <div class="header">Edit</div>
  <div class="content">
    <form method ='post' action ='admin/edit' class ='ui form'>
      @csrf
      <input type ='hidden' name ='id' value =''/>
      <div class ='field'>
        <label>Student number</label>
        <input type ='number' name ='studentnumber' placeholder = 'Student Number'>
      </div>
      <div class ='two fields'>
        <div class ='field'>
          <label>First name</label>
          <input type ='text' name ='firstname' placeholder ='First name'>
        </div>
        <div class ='field'>
          <label>Last name</label>
          <input type ='text' name ='lastname' placeholder ='Last name'>
        </div>
      </div>
      <div class ='two fields'>
        <div class ='field'>
          <label>Gender</label>
          <select name ='gender' class ='ui fluid dropdown'>
            <option value ='0'>Male</option>
            <option value ='1'>Female</option>
          </select>
        </div>
        <div class ='field'>
          <label>Course</label>
          <select name ='course' class ='ui fluid dropdown'>
            <option value = 'bsit'>BSIT</option>
            <option value ='bscs'>BSCS</option>
            <option value ='bsis'>BSIS</option>
            <option value ='bsemc'>BSEMC</option>
          </select>
        </div>
      </div>

      <div class ='field'>
        <label>Mobile number</label>
        <input type ='number' name ='mobilenumber' placeholder ='Mobile number'>
      </div>
    </div>
    <div class="actions">
      <button class="ui positive button">
        Edit
      </button>
    </form>
  </div>
</div>
<div class ='ui card' style ='width:75%;margin:auto'>
  <div class ='content'>
    @if(session('edit-success')!==null)
    <div class ='ui blue message'><i class ='close icon'></i><div class ='header'>Success</div> {{session('edit-success')}}</div>
    @endif
    <div class ='ui equal width grid'>
      <div class ='column ui form'>
        <div class ='ui icon input'>
          <input type ='text' name ='search' placeholder="Search">
          <i class ='search icon'></i>
        </div>
      </div>
      <div class ='three wide column'><button class ='ui button fluid green'>Print</button></div>
      <div class ='three wide column'><button class ='ui button fluid blue'>Show statistics</button></div>
    </div>
    <table class ='ui striped celled table'>
      <thead>
        <th>Full name</th>
        <th>Student number</th>
        <th>Mobile number</th>
        <th>Course</th>
        <th>Actions</th>
      </thead>
      <tbody>
        @foreach($members as $member)
        <tr>
          <td >
            <img class ='ui avatar image' src ='{{asset("img/{$member->member_gender}.png")}}' style='height:50px;width:50px'/>&nbsp;&nbsp;&nbsp;
            <b id = 'fullname'>{{$member->member_firstname}} {{$member->member_lastname}}</b>
          </td>
          <td id ='studentnumber'>{{$member->member_studentnumber}}</td>
          <td id ='number'>{{$member->member_number}}</td>
          <td id ='course'>{{strtoupper($member->member_course)}}</td>
          <td class ='ui center aligned' >
            <input type ='hidden' name ='temp_id' value ='{{$member->member_id}}'>
            <div class ='ui equal width grid'>
              <div class ='column'>
                <button class ='ui blue fluid left icon button edit' ><i class ='pencil icon'></i> Edit</button> 
              </div>
              <div class ='column'>
                <button class ='ui red button fluid left icon delete' ><i class ='trash icon'></i>Delete</button>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@include('../scripts')