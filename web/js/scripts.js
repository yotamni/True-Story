$(document).ready(function(){});
function login()
{
    $(".incorrectLogInMessage").css("display","none")
  username = $('#username').val().trim();
  password = $('#password').val().trim();

  $.ajax({
  type: "POST",
  url: "login.php",
  data: `username=${username}&password=${password}`,
  success: function(msg){

        console.log("msg:" + msg);
        var obj = jQuery.parseJSON(msg);
        //console.log("obj:" + obj[0].searches[2]);
        if(obj[0])
        {
          sessionStorage.setItem("userId",obj[0]._id.$oid);
          if(obj[0].searches!== 'undefined')
          {
                  sessionStorage.setItem("searches",JSON.stringify(obj[0].searches));
          }

          if(obj[0].username !== 'undefined')
          {
                window.location = `home.php`;
                console.log("oid:" + obj[0]._id.$oid);
          }
        }
        else{
          console.log("password or username is incorrect");
          $(".incorrectLogInMessage").css("display","block")
        }
  },
  error: function(XMLHttpRequest, textStatus, errorThrown) {

  }
});
}

function logout()
{
  console.log("on logout");
  $.ajax({
    type: "POST",
    url: "logout.php",
    success: function(msg){

          console.log("msg:" + msg);
          if(msg==1){
              window.location = `index.html`;
          }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {

    }
  });
}

function signUp()
{
  console.log("in sign up");
  username = $('#signUpUsername').val().trim();
  password = $('#signUpPassword').val().trim();
  email = $('#signUpEmail').val().trim();
  fullName = $('#signUpFullname').val().trim();
  validateSignUp(username,password,email,fullName);
  console.log(`username:${username} password:${password} email:${email} name:${fullName}`);

  $.ajax({
    type: "POST",
    url: "signUp.php",
    data: `username=${username}&password=${password}&email=${email}&fullName=${fullName}`,
    success: function(msg){


          console.log(msg);
          var obj = jQuery.parseJSON(msg);
          if(obj[0].username !== 'undefined')
          {
            $('.signUpForm').find("input[type=text], input[type=password], input[type=email]").val("");
            window.location = `home.php`

          }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      console.log("error signup");
    }
  });

}

function moveToIdolPage()
{
    idolName = $('#searchIdol').val().trim();
    window.location = `idol.php?${idolName}`;
}

function validateSignUp(username,password,email,fullName)
{
  console.log(`in validate - username:${username} password:${password} email:${email} name:${fullName}`);
}

function confirmDelete(idolName,button){
console.log("in confirmDelete()");


}

function removeIdol(idolName,button)
{
  console.log("in remove idol" + idolName);
  if($(button).html()!="Confirm")
  {
      $(button).html("Confirm");
  }
  else
  {
    var searches = jQuery.parseJSON(sessionStorage.getItem('searches'));
    jQuery.each(searches, function(i, val) {
      jQuery.each(val,function(k,v){
        console.log(`iterate: ${v} : ${idolName}`);
        if(v===idolName){
          searches.splice(i, 1);
          sessionStorage.setItem('searches',JSON.stringify(searches));
          $(`.${idolName}`).slideUp("slow");
        }
      })
    });

  var arr = searches;

  if(searches.length===0){
    console.log("length 0:" + searches.length);
    var p ='<h5>No searches found</h5>';
    $(".idolsToInspect").append(p);
  }
  var userId = sessionStorage.getItem('userId');

    $.ajax({
      type: "PUT",
      url: `https://api.mlab.com/api/1/databases/customers/collections/users/${userId}?apiKey=tvG8BMjzxtNwm3fRgQv4LNbcF2IIeWWc`,
      data: JSON.stringify( {   "$set" : { "searches" : arr } } ),
      contentType: "application/json",
      success: function(msg){
        /*$.ajax({
          type: "DELETE",
          url: `https://api.mlab.com/api/1/databases/analysis/collections/users/${idolId}?apiKey=tvG8BMjzxtNwm3fRgQv4LNbcF2IIeWWc`,
          data: JSON.stringify([]),
          contentType: "application/json",
          success: function(msg){
                console.log(msg);
          }
          */
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {

      }
    });
  }
}

function searchResult(){
  $('.sResultContainer').show();
  $('.searchResult').remove();
    $('.searchResultTemplate').show();
  console.log('in search result');
  var idolsList = [$('#searchIdol').val().trim()];
  $.ajax({
  type: "POST",
  url: "https://true-story-web-service.herokuapp.com",
  data: {"request":"getIdol","idolNames":idolsList,"username":0},
  success: function(msg){
    var obj = jQuery.parseJSON(msg);
    jQuery.each(obj.data,function(i, val){
      var temp = $( ".searchResultTemplate" ).clone();
      temp.find('img').attr("src",val.profilePicture);
      temp.find('p').html(val.username);
      temp.find('small').html(val.fullName);
      temp.removeClass('searchResultTemplate').addClass('searchResult');
      temp.attr("href",`idol.php?${val.username}`);
      temp.appendTo(".searchResultContainer");
    });
    //$('.searchResultTemplate p').html('test name');
    $('.searchResultTemplate').hide();
    $('#searchIdol').val('');
  },
  error: function(XMLHttpRequest, textStatus, errorThrown) {

  }
});
}

function getMyIdols(){
  console.log("in getMyIdols()");
  var idolsList = [];
  var selfDetect = [];
  console.log("searches:" + sessionStorage.getItem('searches'));

  if(sessionStorage.getItem('searches')==="undefined" || sessionStorage.getItem('searches').length == 2)
  {
    var p ='<h5>No searches found</h5>';
    $(".idolsToInspect").append(p);
    console.log("no searches");
    $('.loadingSpin').css("display","none");
  }
  else{
    var t = jQuery.parseJSON(sessionStorage.getItem('searches'));
    jQuery.each(t,function(key,value){
      jQuery.each(value,function(k,v){
        console.log(k);
        idolsList.push(v);
        selfDetect.push(k);
      });
    });

    //idolsList = sessionStorage.getItem('searches').split(',');
    $.ajax({
    type: "POST",
    url: "https://true-story-web-service.herokuapp.com",
    data: {"request":"getIdol","idolNames":idolsList},
    success: function(msg){
        var obj = jQuery.parseJSON(msg);
        console.log(obj.data[0]);
        $.each( obj.data, function( key, value ) {
        console.log(selfDetect[key]);
        var temp = $( ".template" ).clone();
        temp.find('img').attr("src",value.profilePicture);
        temp.find('p:nth-of-type(2)').html(value.fullName);
        if(selfDetect[key]=='true'){
            temp.find('p:first').html(value.username + ' <i class="fab fa-android"></i>');
            temp.find('a').attr("href",`iRobot3.php?${value.userID}`);
        }
        else {
            temp.find('p:first').html(value.username + ' <i class="fas fa-chart-pie"></i>');
            temp.find('a').attr("href",`result.php?${value.userID}`);
        }
        temp.find('button').on('click',function(){removeIdol(value.username,this)});
        temp.css("display","block");
        temp.removeClass('template').addClass(`myIdols ${value.username}`);
        temp.appendTo(".idolsToInspect");
      });
      $('.loadingSpin').css("display","none");
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {

    }
  });
  }


}

function IsRobbotButtonBlock()
{
  $('#isRobotButton').attr("disabled", true);
  console.log('in block button');
}

function ExploreButtonBlock()
{
  //$('#exploreButton').css("display","none");
   $('#exploreButton').attr("disabled", true);
   console.log('in block button');
}

function CheckIfIdolInSearchesList(idolUsername)
{
  if(sessionStorage.getItem('searches')!="undefined"){
    var t = jQuery.parseJSON(sessionStorage.getItem('searches'));
    jQuery.each(t,function(key,value){
      jQuery.each(value,function(k,v){
        if(v===idolUsername && k ==='false' ){
          console.log('in list:' + idolUsername);
          ExploreButtonBlock();
        }
        else if(v===idolUsername && k ==='true' ){
          console.log('in list:' + idolUsername);
          IsRobbotButtonBlock();
        }

        //idolsList.push(v);
      });
    });
  //arr = sessionStorage.getItem('searches').split(',');
  //console.log(arr.includes(idolUsername));
  //if(arr.includes(idolUsername))
  //  ExploreButtonBlock();
  }
}

function CheckIfRobot(isSelfFollow)
{
  $("#exampleModalCenter").modal('show');
  console.log("in CheckIfRobot() - ");

  username = sessionStorage.getItem("idolUsername");
  $.ajax({
  type: "POST",
  url: "https://true-story-web-service.herokuapp.com",
  data: `request=insertIdol&username=${username}&selfFollow=${isSelfFollow}`,
  success: function(msg){
        obj = jQuery.parseJSON(msg);
        if(obj.result===0)
        {
          console.log(obj.result);
          $('#exampleModalCenterTitle').attr("src","img/checked.png");
          $('#exampleModalCenter h5:nth-of-type(1)').html('Your request has been received');
            $('#exampleModalCenter h5:nth-of-type(2)').html('Final results will be received in 3 days');
          addIdolToSearchesList(isSelfFollow);
          IsRobbotButtonBlock();
        }
  },
  error: function(XMLHttpRequest, textStatus, errorThrown) {

  }
});


}

function getIdol()
{
    var idolInstagramName = decodeURIComponent(window.location.search.substring(1));
    console.log(`idol name ${idolInstagramName}`);
    CheckIfIdolInSearchesList(idolInstagramName);
    idolsList = [idolInstagramName];
    $.ajax({
    type: "POST",
    url: "https://true-story-web-service.herokuapp.com",
    data: {"request":"getIdol","idolNames":idolsList},
  //  data: `request=getIdol&idolNames=${idolInstagramName}`,
    success: function(msg){

          var obj = jQuery.parseJSON(msg);
          console.log("obj:" + obj.data.length);
          if(obj.data.length!=0)
          {
            sessionStorage.setItem("idolUsername",obj.data[0].username);
            var name = obj.data[0].fullName.toUpperCase();
            console.log(obj.data[0].counts.Followers);
            $('.followers').html(transformNumbers(obj.data[0].counts.Followers));
            $('.following').html(transformNumbers(obj.data[0].counts.Following));
            $('.posts').html(transformNumbers(obj.data[0].counts.Media));
            $('.siteLocation').append(` > ${name}`);
            $('#idolName').html(obj.data[0].username);
            $('.idolProfilePicture').attr("src",obj.data[0].profilePicture);
            sessionStorage.setItem("idolId",obj.data[0].userID);
            sessionStorage.setItem("idolUsername",obj.data[0].username);
          }
          else {
            $('.followers').html('<i class="fas fa-exclamation-circle"></i>');
            $('.following').html('<i class="fas fa-exclamation-circle"></i>');
            $('.posts').html('<i class="fas fa-exclamation-circle"></i>');
            $('.idolProfilePicture').attr("src",'img/logo.png');
            $('#idolName').html('Profile not found');
            $('.exploreGroupBtn').hide();
          }

    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {

    }
  });

}

function transformNumbers(numberToTransform)
{
  if(Number(numberToTransform)>999999)
    return (numberToTransform/1000000).toFixed(1) + 'M';
  if(Number(numberToTransform)>999)
    return (numberToTransform/1000).toFixed(1) + 'K';
  return numberToTransform;
}

function exploreIdol()
{
  $("#exampleModalCenter").modal('show');
  username = sessionStorage.getItem("idolUsername");
  console.log("in exploreIdol");
  $.ajax({
  type: "POST",
  url: "https://true-story-web-service.herokuapp.com",
  data: `request=insertIdol&username=${username}`,
  success: function(msg){
        console.log(msg);
        obj = jQuery.parseJSON(msg);
        if(obj.result===0)
        {
          console.log(obj.result);
          $('#exampleModalCenterTitle').attr("src","img/checked.png");
          $('#exampleModalCenter h5:nth-of-type(1)').html('Your request has been received');
            $('#exampleModalCenter h5:nth-of-type(2)').html('Final results will be received in 3 days');
          addIdolToSearchesList();
          ExploreButtonBlock();
        }
  },
  error: function(XMLHttpRequest, textStatus, errorThrown) {

  }
});


}

function addIdolToSearchesList(isSelfFollow){
  console.log(isSelfFollow);
  var searches;
  if(sessionStorage.getItem('searches')!="undefined"){
    searches = jQuery.parseJSON(sessionStorage.getItem('searches'));
    if(isSelfFollow===true){
      var obj = {true:sessionStorage.getItem('idolUsername')};
      searches.push(obj);
    }
    else{
      var obj = {false:sessionStorage.getItem('idolUsername')};
      searches.push(obj);
    }
  }
  else{
    if(isSelfFollow===true){
      searches = [{true:sessionStorage.getItem('idolUsername')}];
    }
    else{
      searches = [{false:sessionStorage.getItem('idolUsername')}];
    }
  }
  sessionStorage.setItem('searches',JSON.stringify(searches));
/*
  mySearches = sessionStorage.getItem('searches');
  var arr = mySearches.split(',')
  arr.push(sessionStorage.getItem('idolUsername'));
  sessionStorage.setItem('searches',arr);
*/
var arr = searches;
var userId = sessionStorage.getItem('userId');

  $.ajax({
    type: "PUT",
    url: `https://api.mlab.com/api/1/databases/customers/collections/users/${userId}?apiKey=tvG8BMjzxtNwm3fRgQv4LNbcF2IIeWWc`,
    data: JSON.stringify( {   "$set" : { "searches" : arr } } ),
    contentType: "application/json",
    success: function(msg){
          console.log(msg);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {

    }
  });

}


function drowChart(followers,bots){
// based on prepared DOM, initialize echarts instance
        var myChart = echarts.init(document.getElementById('main'));
        option = {
            color:['#1F4063','#f3fafd'],
            series : [
            {
              label: {
                normal: {
                  formatter:'{c}-{b}',
                  padding:[0,0,0,0],
                  show:true,
                  extraCssText: 'box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);',
                  fontWeight:'bolder',
                  fontSize:'20',
                }
              },
              selectedMode: 'single',
              selectedOffset: 30,
              type: 'pie',
              radius : '75%',
              center: ['50%', '60%'],
              data:[{"value":bots, "name":"FAKE"},
                     {"value":followers-bots, "name":"REAL"}
              ],
              itemStyle: {
                emphasis: {
                  shadowBlur: 10,
                  shadowOffsetX: 0,
                  shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
              }
            }
            ]
        };
        myChart.setOption(option);
        /*
        arr = [{"value":relations.botAvg, "name":"FAKE"},
               {"value":100 - relations.botAvg, "name":"REAL"}];
      myChart.setOption({
          series: [{
              // find series by name
              data: arr
          }]
      });
*/
/*
        $.get('data/result.json').done(function (data) {
          //$('#profileImg').attr("src",data.data.profilePicture);
          $('.floatingImg').css({"transform": "none","border-top":"5px solid white"});
        //$('#ResultUsername').html(data.data.username);
          sum = data.data.results.length;
          var fake = data.data.results.filter(function(x) {
            return x.fake;
          }).length;
          jQuery.each(data.data.results,function(key,value){
            console.log("value:" + value.fake);
          });

         real = sum - fake;
         console.log(fake);
         robotsRatio = fake/sum*100;
         robotsRatio = robotsRatio.toFixed(0);
         //$('span').html(robotsRatio+"%");
      // fill in data
      arr = [{"value":fake, "name":"FAKE"},
             {"value":real, "name":"REAL"}];
    myChart.setOption({
        series: [{
            // find series by name
            data: arr
        }]
    });
});
*/
}

function showResult(resulType){
    var idolInstagramName = decodeURIComponent(window.location.search.substring(1));
    //$('#main').attr("width",myChart.getWidth() + "px");
    //myChart.setOption(option);

    $.ajax({
    type: "POST",
    url: "https://true-story-web-service.herokuapp.com",
    data: {"request":"getResults","uid":idolInstagramName},
    success: function(msg){
      if(resulType=="followers"){
        showFollowersResults(msg);
      }
      else if(resulType=="self"){
        showSelfResults(msg);
      }
    },
  error: function(XMLHttpRequest, textStatus, errorThrown) {
   console.log("error ajax in show result");
  }
  });
}

function showSelfResults(msg){
  var resultObj = jQuery.parseJSON(msg);
  $('.siteLocation').append(` > ${resultObj.data.fullName}`);
  $('#ResultUsername').html(resultObj.data.username);
  $('#profileImg').attr("src",resultObj.data.profilePicture);
  $('#irobotCertainty').html(`Results certainty: ${resultObj.data.results.certainty.toFixed(0)}%`);
  if(resultObj.data.results.fake==0){
    $('.robotImg').attr("src","img/noRobot.png").fadeIn("slow");
    $('#isRealUser').html(`${resultObj.data.username} is <span>Real</span>`).slideDown("slow");
  }
  else{
    $('.robotImg').attr("src","img/robot.png").fadeIn("slow");
    $('#isRealUser').html(`${resultObj.data.username} is <span>Fake</span>`).slideDown("slow");
  }
}

function showFollowersResults(msg){
  var resultObj = jQuery.parseJSON(msg);
  if(resultObj.data.username!=null){
    //var relations = calculateRelations(msg);
    roundedResult = resultObj.data.results.fake/(resultObj.data.results.fake+resultObj.data.results.real)*100;
    $('#botsDetails').html(`${resultObj.data.results.fake + resultObj.data.results.real} followers >>> <span>${roundedResult.toFixed(0)}%</span> Fake`);
    $('#profileImg').attr("src",resultObj.data.profilePicture);
    $('#ResultUsername').html(resultObj.data.username);
    $('#idolFollowers').html(`Followers: ${resultObj.data.counts.Followers}`);
    $('#idolFollowing').html(`Following: ${resultObj.data.counts.Following}`);
    $('#idolMedia').html(`Media: ${resultObj.data.counts.Media}`);
    $('#certainty').html(`Results certainty: ${resultObj.data.results.certainty.toFixed(0)}%`);
    $('.siteLocation').append(` > ${resultObj.data.fullName}`);
    if(resultObj.data.final == true)
    {
      $('#isFinalResult').html(`Final results`);
    }
    else{
      $('#isFinalResult').html(`Temporary results`);
    }
    $('#profilesDetect').html(`Checked profiles: ${resultObj.data.results.fake + resultObj.data.results.real} out of ${resultObj.data.counts.Followers}`);
    drowChart(resultObj.data.results.fake + resultObj.data.results.real,resultObj.data.results.fake);
  }
  else {
    $('#botsDetails').html(`result <span>not yet</span> available`);
    $('#profileImg').attr("src","img/TS-logo.jpg");
  }
}

function autoComplete(){
  $("#searchIdol").on('input',function() {
  t = ($(this).val());
  var searchResult = [];
  $.ajax({
    type: "GET",
    url: `https://api.mlab.com/api/1/databases/analysis/collections/users?q={"username":{$regex : ".*${t}.*"}}&apiKey=tvG8BMjzxtNwm3fRgQv4LNbcF2IIeWWc&f={"username":1,"fullName":1,"profilePicture":1}`,
    success: function(msg){
        jQuery.each(msg,function(i, val){
          console.log(msg.length);
          searchResult.push(val.fullName);
          console.log(val.username);
        });
        if(msg[0]){
          console.log("msg:" + msg[0].username);
        }
        else{
          console.log("no matching username");
        }
        $( "#searchIdol" ).autocomplete({
  source: searchResult
});

    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {

    }
  });
  });

}
function calculateRelations(msg){
  obj = jQuery.parseJSON(msg);
  var sumRobot = 0, certainty = 0;
  jQuery.each(obj.data.results,function(i, val) {
    if(val.results.isBot==1)
    {
      sumRobot +=1;
    }
    certainty += val.results.certainty;
  });
  certaintyAvg = certainty/obj.data.results.length;
  botAvg = sumRobot/obj.data.results.length*100;
  relations = {botAvg:botAvg.toFixed(0),certaintyAvg:certaintyAvg.toFixed(0),followers:obj.data.results.length,bots:sumRobot}
  return relations;
}

function closeModal(){
  console.log("in closemodal");
  $.when($('#exampleModalCenter').modal("hide")).done(function(){
    console.log("done");
    window.location = 'home.php';
  });
}
