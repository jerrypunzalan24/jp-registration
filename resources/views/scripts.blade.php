<script src ='{{asset('js/jquery/jquery-3.2.1.min.js')}}'></script>
<script src ='{{asset('semantic/semantic.min.js')}}'></script>
<script>
  $('select.dropdown').dropdown();
  $('ui.radio.checkbox').checkbox()
  $('ui.checkbox').checkbox()
  $('#proceed').click(function(){
    var next = true
    $('#personal input').each(function(e){
      if($(this).value === undefined){
        next = true
      }
    })
    if(next){
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
        }
      })
    }
  })
  $('#goback').click(function(e){
    e.preventDefault()
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
      }
    })
  })
  $('#others').change(function(){
    $('input[name=others]').attr('disabled', !this.checked)
  })
</script>
<script src ='{{asset('js/live.js')}}'></script>