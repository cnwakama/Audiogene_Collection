/*
IE has a BIG problem with console.log. This is a simple fix.


*/

if (typeof console == "undefined") {
    window.console = {
        log: function () {}
    };
}