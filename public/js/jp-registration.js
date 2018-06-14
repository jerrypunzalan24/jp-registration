 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
 $('#stats').click(function(){
  $.ajax({
    url:'admin/questions',
    method:'POST',
    data:{},
    success:function(response){
      console.log(response)
      var question1 = $('#question1')
      var question2 = $('#question2')
      $('#topiclist').html('')
      response.topic_list.forEach(function(e){
        $('#topiclist').append(`
          <tr>
          <td>${e['question_content']}</td>
          <td>${e['num']}</td>
          </tr>`)
      })
      $('#statistics').modal('show')
      var question1Chart = new Chart(question1, {
        type: 'pie',
        data: {
          labels: ["Seminars", "Competitions"],
          datasets: [{
            label: 'Question #1 (Seminars vs Competitions)',
            data: [response.seminars, response.competitions],
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero:false
              }
            }]
          }
        }
      });
      var question2Chart = new Chart(question2, {
        type: 'pie',
        data:{
          labels:['AI','AR/VR','Esports','Programming Language','Games','Others'],
          datasets: [{
            label:"#Question 2 Chosen topics",
            data:[response.ai,response.ar, response.esports,response.programming,response.games,response.others], 
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
          }]
        },
        options:{
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero:true
              }
            }]
          }
        }
      })  
    }
    ,error:function(response){
      console.log(response)
    }
  })
})
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