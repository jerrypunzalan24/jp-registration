<script src ='{{asset('js/jquery/jquery-3.2.1.min.js')}}'></script>
<script src ='{{asset('semantic/semantic.min.js')}}'></script>
<script>
 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
 $('input[name=mobilenumber], input[name=studentnumber]').keypress(function () {
    var maxLength = $(this).val().length;
    if (maxLength >= 11)
        return false;
});
 $('.edit').click(function(){
  $.ajax({
    url:'admin/getdata',
    method:"POST",
    data:{
      id: $(this).closest('tr').find('input[name=temp_id]').val()
    },
    success:function(html){
      $('input[name=id]').val(html[0].member_id)
      $('input[name=firstname]').val(html[0].member_firstname)
      $('input[name=studentnumber]').val(html[0].member_studentnumber)
      $('input[name=lastname]').val(html[0].member_lastname)
      $('input[name=mobilenumber]').val(html[0].member_number)
      $('select[name=gender]').html(`
        <option value ='0'>Male</option>
        <option value ='1'>Female</option>`)
      $('select[name=course]').html(`
        <option value = 'bsit'>BSIT</option>
        <option value ='bscs'>BSCS</option>
        <option value ='bsis'>BSIS</option>
        <option value ='bsemc'>BSEMC</option>`)
      $(`option`).attr('selected',false)
      $(`option[value=${html[0].member_gender}]`).attr('selected',true)
      $(`option[value=${html[0].member_course}]`).attr('selected',true)
      $('#edit').modal('show')
    }
  })
})
 $('.delete').click(function(){
  $('input[name=id]').val($(this).closest('tr').find('input[name=temp_id]').val())
  $('#delete').modal('show')
})
 $('input[name=search]').change(function(){
  var inputText = $(this).val().toLowerCase()
  $('tbody tr').each(function(){
    if($(this).html().toLowerCase().indexOf(inputText) < 0)
      $(this).hide()
    else
      $(this).show()
  })
})
 $('.message .close')
 .on('click', function() {
  $(this)
  .closest('.message')
  .transition('fade')
})
 $('select.dropdown').dropdown();
 $('ui.radio.checkbox').checkbox()
 $('ui.checkbox').checkbox()
 $('#proceed').click(function(e){
  e.preventDefault()
  var next = true
  $('#personal input').each(function(e){
    if($(this).val() === ''){
      next = false
    }
  })
  if(next){
    $(this).attr('disabled',true)
    $('#personal').transition({
      animation:'fly right',
      onComplete:function(){          
        $('#survey').show()
        $('#survey').removeClass('hidden')
        $('#continue').hide()
        $('#submit').show()
        $('#step1').removeClass('active')
        $('#step2').addClass('active')
        $('#title').html('Survey')
        $('#desc').html("Complete the survey")
        $('#goback').attr('disabled',false)
      }
    })
  }
})
 $('#goback').click(function(e){
  e.preventDefault()
  $(this).attr('disabled',true)
  $('#survey').transition({
    animation:'fly left',
    onComplete: function(){
      $('#personal').show()
      $('#personal').removeClass('hidden')
      $('#submit').hide()
      $('#continue').show()
      $('#step1').addClass('active')
      $('#step2').removeClass('active')
      $('#title').html("Personal Information")
      $('#desc').html("Enter all fields below")
      $('#proceed').attr('disabled',false)
    }
  })
})
 $('#others').change(function(){
  $('input[name=others]').attr('disabled', !this.checked)
})
</script>
<script src ='{{asset('js/live.js')}}'></script>