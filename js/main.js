var urls = {
  0: [
    {"url": "https://itkdesign.geckoboard.com/dashboards/B0DDF77F2C98F67C"}
  ],
  1: [
    {"url": "http://geckoboard.etek.dk/static_pages/information.html"}
  ],
  2: [
    {"url": "http://geckoboard.etek.dk/static_pages/important_dates.html"}
  ],
  3: [
    {"url": "http://geckoboard.etek.dk/static_pages/current_sprint.html"}
  ],
  4: [
    {"url": "http://geckoboard.etek.dk/static_pages/scrum_log.html"}
  ],
  5: [
    {"url": "http://geckoboard.etek.dk/static_pages/burndown_charts.html"}
  ],
  /*
  Discarded URLs
  http://newsmap.jp/#/b,e,m,n,s,t,w/uk,us/search/all/technology
  http://visibletweets.com/#query=drupal%2Cdrupalcon&animation=2
  http://twistori.com/#i_believe
  */
};

var pointer = 0;
var delay = 60000;
//var delay = 10000;

function objectLength(obj) {
  var result = 0;
  for(var prop in obj) {
    if (obj.hasOwnProperty(prop)) {
    // or Object.prototype.hasOwnProperty.call(obj, prop)
      result++;
    }
  }
  return result;
}

function changeUrl() {
  
  var items = objectLength(urls);
  var url = urls[pointer][0].url;
  $('iframe#viewer').attr('src', url);

	// animate the progress bar
	$('#progress').stop(true,true);
	$('#progress').css('width','0px');
  $('#progress').animate({width: '100%'}, delay, 'easeInSine');
  
  pointer++;
  if(pointer >= items) {
    pointer = 0;
  }
  
  setTimeout(function(){
    changeUrl();
  }, delay);
  
}

function checkKey(e) {
  e = e || window.event;

  if (e.keyCode == '39') {
    //Right arrow key pressed.
    changeUrl();
  }
}

$(function(){
  changeUrl();
  document.onkeydown = checkKey;
});




