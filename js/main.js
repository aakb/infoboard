var urls = {
  0: [
    {"url": "http://newsmap.jp/#/b,e,m,n,s,t,w/uk/view/"}
  ],
  1: [
    {"url": "https://itkdesign.geckoboard.com/dashboard/B0DDF77F2C98F67C/"}
  ],
  2: [
    {"url": "http://visibletweets.com/#query=%23drupal%20lang%3Ada&animation=1"}
  ],
  3: [
    {"url": "https://github.com/organizations/aakb"}
  ],
  4: [
    {"url": "http://visibletweets.com/#query=from%3Azorp%20OR%20from%3Amagnify%20OR%20from%3Acableman%20OR%20from%3Afristed&animation=2"}
  ]
};

var pointer = 0;
var delay = 120000;

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
