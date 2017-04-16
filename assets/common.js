	
$(function(){
    $("#header-bar").load("header.html", updateMyWatchlistMenu); 
});
	
function updateMyWatchlistMenu() {

    var watchlists = $.cookie("watchlists");
    if (watchlists == undefined) {
        return false;
    }
    
    watchlists = JSON.parse(watchlists);
    
    $("#menu-my-watchlist").html("");
  
    for (var m in watchlists){
        $("#menu-my-watchlist").append("<li><a href='/?" + watchlists[m] + "'>" + m + "</a></li>");
    } 
}


// ======== UTILITY FUNCTIONS ===============

function compareNumbersWithCommas(val1, val2) {

    if (val1 == "" || val1 == "DATE")
        return -1;
    if (val2 == "" || val2 == "DATE")
        return 1;

    var val1_copy = parseFloat(val1.replace(/\,/g, '')).toFixed(2);
    var val2_copy = parseFloat(val2.replace(/\,/g, '')).toFixed(2);
    return val1_copy - val2_copy;
}

function getQueryString() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
};

function formatCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}