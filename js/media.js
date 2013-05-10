//Functions for Music, Books and Movies
$(document).ready(function(){
$("button").click(function(){
$("#result").empty();
	$.ajax({
	  url: "https://itunes.apple.com/search",
	  type: "get",
	  data: { term : $("#music #Searchbox").val(), entity : "musicTrack" },
	  dataType: "jsonp"
	}).done(function( result ) {
		var records = result.results;
		
		for(i in records){
			$("#music #result").append("<li>"+records[i].artistName + "<br/>" + records[i].trackName + "<br/>" + records[i].collectionName + "<br/>" + "<hr></li>");
		}
	});
});

$("button").click(function(){
$("#result").empty();
	$.ajax({
	  url: "https://itunes.apple.com/search",
	  type: "get",
	  data: { term : $("#movies #Searchbox").val(), entity : "movie" },
	  dataType: "jsonp"
	}).done(function( result ) {
		var records = result.results;
		
		for(i in records){
			$("#movies #result").append("<li>"+records[i].artistName + "<br/>" + records[i].trackName + "<br/>" + records[i].collectionName + "<br/>" + "<hr></li>");
		}
	});
});

$("button").click(function(){
$("#result").empty();
	$.ajax({
	  url: "https://itunes.apple.com/search",
	  type: "get",
	  data: { term : $("#books #Searchbox").val(), entity : "ebook" },
	  dataType: "jsonp"
	}).done(function( result ) {
		var records = result.results;
		
		for(i in records){
			$("#books #result").append("<li>"+records[i].artistName + "<br/>" + records[i].trackName + "<br/>" + records[i].collectionName + "<br/>" + "<hr></li>");
		}
	});
});

});
