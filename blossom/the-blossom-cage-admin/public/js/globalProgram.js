function setUrlWithParameter(url, paramName, paramValue)
{
    //var url = window.location.href;
    if (url.indexOf(paramName + "=") >= 0)
    {
        var prefix = url.substring(0, url.indexOf(paramName));
        var suffix = url.substring(url.indexOf(paramName));
        suffix = suffix.substring(suffix.indexOf("=") + 1);
        suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
        url = prefix + paramName + "=" + paramValue + suffix;
    } else
    {
        if (url.indexOf("?") < 0)
            url += "?" + paramName + "=" + paramValue;
        else
            url += "&" + paramName + "=" + paramValue;
    }
    return url;
}
$("#searchTextBox").keypress(function (event) {
    if (event.which === 13) {//check is enter key pressed
        var url = setUrlWithParameter(window.location.href, 'page', 1);
        window.location.href = setUrlWithParameter(url, 'search', btoa($(this).val()));

    }
});
$("#search").click(function (event) {
    var search_value = btoa($('#searchTextBox').val());
    var url = setUrlWithParameter(window.location.href, 'page', 1);
    window.location.href = setUrlWithParameter(url, 'search', search_value);
});
$("#cancel").click(function (event) {
    $("#searchTextBox").val(" ");
});


