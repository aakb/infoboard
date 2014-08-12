// Use googles feed api.
google.load("feeds", "1");

function initialize() {
  // Fetch feed.
  var feed = new google.feeds.Feed("http://www.rssmix.com/u/4350738/rss.xml");
  // Set number of entries.
  feed.setNumEntries(8);
  feed.load(function(result) {
    if (!result.error) {
      // For each feed entry.
      for (var i = 0; i < result.feed.entries.length; i++) {
        var entry = result.feed.entries[i];
        var source = entry.content.match("<h3>(.*)</h3>");
        document.getElementById("feed").innerHTML += '<li class="list-item odd"><span class="date">' + convertDate(Date.parse(entry.publishedDate)) + '</span><span class="title">' + entry.title + ' (' + source[1] + ')</span></li>';
      }
    }
  });
}
google.setOnLoadCallback(initialize);

// Date converter.
function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/');
}