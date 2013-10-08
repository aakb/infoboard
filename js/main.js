var urls = {
  0: [
    {"url": "https://itkdesign.geckoboard.com/dashboards/B0DDF77F2C98F67C"}
  ],
  1: [
    {"url": "http://geckoboard.etek.dk/static_pages/important_dates.html"}
  ],
  2: [
    {"url": "http://twistori.com/#i_believe"}
  ],
  /*
  Discarded URLs
  http://newsmap.jp/#/b,e,m,n,s,t,w/uk,us/search/all/technology
  http://visibletweets.com/#query=drupal%2Cdrupalcon&animation=2
  */
};

var pointer = 0;
var delay = 100000;
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
  
  items = objectLength(urls);
  url = urls[pointer][0].url;
  $('iframe#viewer').attr('src', url);

	// animate the progress bar
	$('#progress').stop(true,true);
	$('#progress').css('width','0px');
	//$('#progress').delay(1).animate({width: '0%'}, 99, 'swing'); 
  $('#progress').animate({width: '100%'}, delay, 'easeInSine');  
  
  pointer++;
  if(pointer >= items) {
    pointer = 0;
  }
  
  setTimeout(function(){
    changeUrl();
  }, delay);  
  
}

$(function(){
  changeUrl();
});
